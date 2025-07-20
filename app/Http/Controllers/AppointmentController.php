<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\AppointmentService;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient', 'service'])->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $services = Service::all();
        return view('appointments.create', compact('patients', 'doctors', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $services = Service::all();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    public function generatePDF(Appointment $appointment)
    {
        $pdf = PDF::loadView('appointments.pdf', compact('appointment'));
        return $pdf->download('prescription.pdf');
    }

   

    public function getAvailableTimeSlots(Request $request)
    {
        try {
            Log::info('getAvailableTimeSlots called', $request->all());
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'date' => 'required|date',
            ]);

            $doctor_id = $request->input('doctor_id');
            $date = $request->input('date');

            // Fetch existing appointments for the doctor on the specified date
            $appointments = Appointment::where('doctor_id', $doctor_id)
                                        ->whereDate('appointment_date', $date)
                                        ->get();
            // die($appointments);

            // Define the available time slots (for example, every 30 minutes from 9 AM to 5 PM)
            $startTime = new \DateTime("$date 09:00");
            $endTime = new \DateTime("$date 17:00");
            $interval = new \DateInterval('PT30M');
            $timeSlots = [];

            while ($startTime < $endTime) {
                $timeSlots[] = $startTime->format('Y-m-d H:i:s');
                $startTime->add($interval);
            }

            // Remove the time slots that are already booked
            foreach ($appointments as $appointment) {
                $appointmentTime = (new \DateTime($appointment->appointment_date))->format('Y-m-d H:i:s');
                if (($key = array_search($appointmentTime, $timeSlots)) !== false) {
                    unset($timeSlots[$key]);
                }
            }
            // die($timeSlots);
            return response()->json(array_values($timeSlots));
        } catch (\Exception $e) {
            Log::error('Error fetching time slots', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while fetching time slots.'], 500);
        }
    }
    public function addAppointmentBackup_20072025(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'uniquePatientID'=> 'required',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id'=> 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'service_ids'=> 'required|array',
            'service_ids.*' => 'required|exists:services,id',
            'duration' => 'required',
        ]);
        $currentDate = Carbon::now()->toDateString(); // Get the current date
        $appointment = Appointment::where('uniquePatientID', $validatedData['uniquePatientID'])
                          ->whereDate('appointment_date', $currentDate) // Assuming the appointment date is stored in a 'appointment_date' column
                          ->first();
        if(!$appointment){
            $appointment_date = Carbon::createFromFormat('d-M-Y', $validatedData['appointment_date'])->format('Y-m-d');
            // Create an appointment
            $appointment = Appointment::create([
                'uniquePatientID'=> $validatedData['uniquePatientID'],
                'doctor_id' => $validatedData['doctor_id'],
                'patient_id'=> $validatedData['patient_id'],
                'appointment_date' => $appointment_date,
                'appointment_time' => $validatedData['appointment_time'],
                'service_id'=> $validatedData['service_id'],
                'duration' => $validatedData['duration'],
                'status'=> '2',  //arrived=1,booked=2,On-going=3,Reviewed=4
            ]);
        }else{
            
            // Get the current date
            $currentDate = Carbon::now()->toDateString();

            // Find the last token for today in the appointments table
            $lastToken = Appointment::whereDate('appointment_date', $currentDate)
                                    ->orderBy('token', 'desc')
                                    ->value('token');

            // If there's no token for today, start from 1
            if($lastToken==''){
                $newToken = 1;
            }else{
                $newToken = $lastToken + 1;
            }
            

            $appointment_date = Carbon::createFromFormat('d-M-Y', $validatedData['appointment_date'])->format('Y-m-d');
            
            $appointment->doctor_id = $request->doctor_id;
            // $appointment->patient_id = $request->patient_id;
            // $appointment->appointment_type = $request->appointment_type;
            $appointment->appointment_date = $appointment_date;
            $appointment->token=$newToken;
            $appointment->appointment_time = $request->appointment_time;
            $appointment->service_id = $request->service_id;
            $appointment->duration = $request->service_id;
            $appointment->status = '2';

            $appointment->save();
        }
        

        return response()->json([
            'success' => true,
            'appointment' => $appointment,
        ]);
    }

    
    public function addAppointment(Request $request)
    {
        $validatedData = $request->validate([
            'uniquePatientID' => 'required',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required',
            'appointment_date' => 'required|date_format:d-M-Y',
            'appointment_time' => 'required',
            'service_ids' => 'required|array',
            'service_ids.*' => 'required|exists:services,id',
            'duration' => 'required',
        ]);

        $appointment_date = Carbon::createFromFormat('d-M-Y', $validatedData['appointment_date'])->format('Y-m-d');
        $currentDate = Carbon::now()->toDateString();

        // Check if an appointment already exists for the patient today
        $appointment = Appointment::where('uniquePatientID', $validatedData['uniquePatientID'])
            ->whereDate('appointment_date', $currentDate)
            ->first();

        if (!$appointment) {
            // Generate token
            $lastToken = Appointment::whereDate('appointment_date', $currentDate)
                ->orderBy('token', 'desc')
                ->value('token');

            $newToken = $lastToken ? $lastToken + 1 : 1;

            // Create new appointment with the first service as reference
            $appointment = Appointment::create([
                'uniquePatientID' => $validatedData['uniquePatientID'],
                'doctor_id' => $validatedData['doctor_id'],
                'patient_id' => $validatedData['patient_id'],
                'appointment_date' => $appointment_date,
                'appointment_time' => $validatedData['appointment_time'],
                'service_id' => $validatedData['service_ids'][0], // only used as reference
                'duration' => $validatedData['duration'],
                'token' => $newToken,
                'status' => '2', // booked
            ]);
        } else {
            // Appointment already exists, update token and other fields
            $lastToken = Appointment::whereDate('appointment_date', $currentDate)
                ->orderBy('token', 'desc')
                ->value('token');

            $newToken = $lastToken ? $lastToken + 1 : 1;

            $appointment->doctor_id = $validatedData['doctor_id'];
            $appointment->appointment_date = $appointment_date;
            $appointment->appointment_time = $validatedData['appointment_time'];
            $appointment->token = $newToken;
            $appointment->service_id = $validatedData['service_ids'][0];
            $appointment->duration = $validatedData['duration'];
            $appointment->status = '2';
            $appointment->save();
        }

        // Attach all services
        foreach ($validatedData['service_ids'] as $serviceId) {
            AppointmentService::create([
                'appointment_id' => $appointment->id,
                'service_id' => $serviceId,
            ]);
        }

        return response()->json([
            'success' => true,
            'token' => $appointment->token,
            'appointment' => $appointment,
        ]);
    }


}
