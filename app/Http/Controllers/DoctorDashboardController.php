<?php


namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\complaint;
use App\Models\Diagnosis;
use App\Models\Test;
use App\Models\Medicine;
use App\Models\MedicineMaster;
use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Support\Facades\Storage;
use PDF;

class DoctorDashboardController extends Controller
{
    
    public function index(Request $request)
    {
        $selectedDate = $request->input('selected_date', Carbon::today()->format('Y-m-d'));
        $doctorUserId = auth()->user()->id;

        $doctor = Doctor::where('user_id', $doctorUserId)->firstOrFail();

        $patients = Patient::whereHas('appointments', function ($query) use ($selectedDate, $doctor) {
            $query->where('doctor_id', $doctor->id)
                ->whereDate('appointment_date', $selectedDate)
                ->whereNotNull('token');
        })
        ->with(['appointments' => function ($query) use ($selectedDate, $doctor) {
            $query->where('doctor_id', $doctor->id)
                ->whereDate('appointment_date', $selectedDate);
        }])
        ->get();

        if ($patients->isEmpty()) {
            return response()->json([
                'message' => 'No patients found for the selected date.',
                'selectedDate' => $selectedDate
            ]);
        }

        $todaySerials = 1;
        $patientData = $patients->map(function ($patient) {
            $appointment = $patient->appointments->first();
            return [
                'patientId' => $patient->id,
                'uniquePatientID' => $patient->uniquePatientID,
                'token' => $appointment->token,
                'patientName' => $patient->name,
                'visits' => $patient->appointments->count(),
                'recentVisit' => Carbon::parse($appointment->appointment_date)->format('jS M, Y'),
                'time' => $appointment->appointment_time,
                'waitStatus' => $appointment->status==0 ? 'Waiting' : 'Completed',
                'purpose' => $appointment->purpose ?? 'NA',
            ];
        });

        return response()->json([
            'patientData' => $patientData,
            'selectedDate' => $selectedDate
        ]);
    }
    
    public function visitPad($patientId){

        // Fetch the patient details
        $patient = Patient::where('id', $patientId)->firstOrFail();

        // Fetch the latest visit
        $visit = Visit::where('patient_id', $patient->id)->orderBy('created_at', 'desc')->first();
        
        // Fetch all past visits for the patient, including related medicines and doctor
        $pastVisits = Visit::where('patient_id', $patient->id)
                            ->orderBy('created_at', 'desc')
                            ->with(['medicines', 'doctor'])  // Eager load medicines and doctor relationships
                            ->get();

        // Fetch all available medicines from the master table
        $medicineMasters = MedicineMaster::all();
        $doctors = Doctor::all();
        $doctorUserId = auth()->user()->id;
        $doctor = Doctor::where('user_id', $doctorUserId)->firstOrFail();
        $currentDate = Carbon::now()->toDateString();
        $appointment = Appointment::where('patient_id', $patientId)
                            ->whereDate('appointment_date', $currentDate) // Assuming the appointment date is stored in a 'appointment_date' column
                            ->first();
        $appointment->status = '3'; //arrived=1,booked=2,On-going=3,Reviewed=4
        $appointment->save();

        // Fetch medicines related to the current visit or set to an empty collection if no visit or medicines exist
        $medicines = collect();
        if ($visit) {
            $medicines = Medicine::where('visit_id', $visit->id)->get();
        }

        return view('dashboards.doctor-partials.visitPad', compact('patient', 'visit', 'medicines', 'medicineMasters', 'pastVisits','doctors','doctor'));
    }

    public function visitPaidOLD($patientId)
    {
        // Fetch the patient details
        $patient = Patient::where('id', $patientId)->firstOrFail();
    
        // Fetch today's visit (if any) for the patient
        $todayVisit = Visit::where('patient_id', $patient->id)
                           ->whereDate('created_at', '=', now()->toDateString()) // today's date
                           ->first();
    
        // Fetch all past visits for the patient
        $pastVisits = Visit::where('patient_id', $patient->id)
                           ->orderBy('created_at', 'desc')
                           ->with(['medicines', 'doctor']) // Eager load medicines and doctor relationships
                           ->get();
    
        // Fetch all available medicines from the master table
        $medicineMasters = MedicineMaster::all();
        $doctors = Doctor::all();
    
        // Check if today's visit is available or not
        $medicines = collect();
        if ($todayVisit) {
            $medicines = Medicine::where('visit_id', $todayVisit->id)->get();
        }
    
        // Determine the status of the current visit
        $visitStatus = $todayVisit ? 'Completed' : 'Pending';
    
        // Pass the variables to the view
        return view('dashboards.doctor-partials.visitPad', compact(
            'patient', 
            'todayVisit', 
            'medicines', 
            'medicineMasters', 
            'pastVisits', 
            'doctors', 
            'visitStatus'
        ));
    }
    

    
    public function saveVisit(Request $request, $patientId)
    {
        
        $visit = Visit::updateOrCreate(
            ['patient_id' => $patientId],
            $request->only(['complaints', 'diagnosis', 'advice'])
        );

        // Save medicines (simplified version, assuming form data has medicine details)
        foreach ($request->medicines as $medicineData) {
            Medicine::create([
                'visit_id' => $visit->id,
                'name' => $medicineData['name'],
                'dosage' => $medicineData['dosage'],
                'when' => $medicineData['when'],
                'where' => $medicineData['where'],
                'frequency' => $medicineData['frequency'],
                'duration' => $medicineData['duration'],
                'notes' => $medicineData['notes'],
            ]);
        }

        return redirect()->route('visit.pad', ['patientId' => $patientId])->with('success', 'Visit saved successfully.');
    }

    public function saveVisits(Request $request)
    {
        
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'history' => 'nullable|string',
            'complaints' => 'required|array', // Expecting array for multiple complaints
            'diagnosis' => 'required|array',  // Expecting array for multiple diagnoses
            'tests' => 'nullable|array',      // Expecting array for multiple tests
            'medicines' => 'array',           // Medicines are also an array
            'advice' => 'nullable|string',
        ]);

        $complaints = implode(', ', $request->complaints); // Join with commas
        $diagnosis = implode(', ', $request->diagnosis);   // Join with commas
        $tests = $request->tests ? implode(', ', $request->tests) : null;

        // Save the visit
        $visit = Visit::create([
            'patient_id' => $request->patient_id,
            'complaints' => $complaints,
            'history' => $request->genetic_history,
            'diagnosis' => $diagnosis,
            'advice' => $request->advice,
            'tests' => $tests,
            'doctor_id' => $request->doctor_id,
            'next_visit' => $request->nextVisit,

        ]);
        if($visit){
            $currentDate = Carbon::now()->toDateString();
            $appointment = Appointment::where('patient_id', $request->patient_id)
                            ->whereDate('appointment_date', $currentDate) // Assuming the appointment date is stored in a 'appointment_date' column
                            ->first();
            $appointment->status = '4'; //arrived=1,booked=2,On-going=3,Reviewed=4
            $appointment->save();

        }else{

            return redirect()->route('visit.pad', ['patientId' => $request->patient_id])->with('failed', 'Visit saved unsuccessfully.');

        }
        

        // Save the medicines
        foreach ($request->medicines as $medicineData) {
            Medicine::create([
                'visit_id' => $visit->id,
                'name' => $medicineData['name'],
                'dosage' => $medicineData['dosage'],
                'when' => $medicineData['when'],
                // 'where' => $medicineData['where'],
                'frequency' => $medicineData['frequency'],
                'duration' => $medicineData['duration'],
                'notes' => $medicineData['notes'],
            ]);
        }
        return redirect()->route('visit.pad', ['patientId' => $request->patient_id])->with('success', 'Visit saved successfully.');
        //return redirect()->back()->with('success', 'Visit saved successfully.');
    }

    // Fetch complaints suggestions
    public function getComplaintsSuggestions(Request $request)
    {
        $query = $request->input('query');
        $complaints = complaint::where('name', 'LIKE', "%$query%")->pluck('name');
        return response()->json($complaints);
    }

    public function getDiagnosisSuggestions(Request $request)
    {
        $query = $request->input('query');
        $diagnosis = Diagnosis::where('name', 'LIKE', "%$query%")->pluck('name');
        return response()->json($diagnosis);
    }

    public function getTestSuggestions(Request $request)
    {
        $query = $request->input('query');
        $tests = Test::where('name', 'LIKE', "%$query%")->pluck('name');
        return response()->json($tests);
    }

    // Fetch medicines list
    public function getMedicineSuggestions(Request $request)
    {
        // $medicines = MedicineMaster::all();
        // return response()->json($medicines);
        
        $query = $request->get('term', '');
        $data = Medicine::where('name', 'LIKE', "%$query%")
            ->pluck('name')
            ->take(10);

        return response()->json($data);
    }
    public function medicineStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $medicine = MedicineMaster::firstOrCreate(['name' => $request->name]);

        return response()->json(['success' => true, 'id' => $medicine->id]);
    }
    public function printPrescription($visitId)
    {
        $visit = Visit::with('medicines')->findOrFail($visitId); // Fetch visit details with medicines
        return view('print.prescription', compact('visit')); // Pass data to the Blade template
    }

    public function fetchPatientData()
    {
        $patients = Patient::all(); // or your specific logic to get the patient data

        // Return as JSON for AJAX
        return response()->json([
            'patientData' => $patients
        ]);
    }

    public function getDoctorDetails(Request $request)
    {
        $doctorName = $request->input('name');

        // Find the doctor by name
        $doctor = Doctor::where('name', 'LIKE', '%' . $doctorName . '%')->first();
        //dd($doctor);
        // Check if doctor exists
        if ($doctor) {
            // Fetch the user details using the user_id stored in the doctor table
            $user = $doctor->user;
            //dd($user);
            // Return the doctor and user details as JSON
            return response()->json([
                'success' => true,
                'specialty' => $doctor->specialization,
                'phoneCode' => '+91', // You can modify this if phone code is stored elsewhere
                'phoneNo' => $user ? $user->phone : '',
                'email' => $user ? $user->email : ''
            ]);
        } else {
            // If doctor not found, return false
            return response()->json(['success' => false]);
        }
    }

    public function saveNewMasterItem(Request $request)
    {
        $type = $request->input('type');
        $value = trim($request->input('value'));

        $model = match ($type) {
            'complaint' => complaint::class,
            'diagnosis' => Diagnosis::class,
            'test' => Test::class,
            // 'genetic_history' => GeneticHistory::class,
            default => null,
        };

        if (!$model || empty($value)) {
            return response()->json(['success' => false, 'message' => 'Invalid type or value']);
        }

        $exists = $model::where('name', $value)->exists();
        if (!$exists) {
            $model::create(['name' => $value]);
        }

        return response()->json(['success' => true]);
    }

    public function getPdfUrl($id)
    {
        $visit = Visit::with('patient', 'medicines', 'doctor')->findOrFail($id);

        $pdf = PDF::loadView('print.prescription', compact('visit'));

        // Save the PDF in storage/public/prescriptions
        $fileName = 'prescription_' . $visit->id . '.pdf';
        Storage::disk('public')->put("prescriptions/{$fileName}", $pdf->output());

        // Return the public URL
        return response()->json([
            'success' => true,
            'url' => asset("storage/prescriptions/{$fileName}")
        ]);
    }
    
}
