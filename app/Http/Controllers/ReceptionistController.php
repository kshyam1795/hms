<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Patient;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\LabTest;
use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Deposit;
use App\Models\Visit;
use Carbon\Carbon;
use Session;
use DB;
USE App\Models\AppointmentService;

class ReceptionistController extends Controller
{
    public function index()
    {
        $receptionists = User::whereHas('role', function($query) {
            $query->where('name', 'receptionist');
        })->get();
        
        $patients = Patient::with('appointments', 'bills')->orderBy('id', 'desc')->get();
        //dd($patients);
        return view('receptionists.index', compact('receptionists','patients' ));
    }

    public function create()
    {
        return view('receptionists.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $role = Role::where('name', 'receptionist')->first();
        //die($role);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'phone' => '1234567890' // Ensure phone is included
        ]);

        return redirect()->route('receptionists.index')->with('success', 'Receptionist created successfully.');
    }

    public function show(User $receptionist)
    {
        return view('receptionists.show', compact('receptionist'));
    }

    public function edit(User $receptionist)
    {
        return view('receptionists.edit', compact('receptionist'));
    }

    public function update(Request $request, User $receptionist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$receptionist->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $receptionist->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $receptionist->password,
        ]);

        return redirect()->route('receptionists.index')->with('success', 'Receptionist updated successfully.');
    }

    public function destroy(User $receptionist)
    {
        $receptionist->delete();

        return redirect()->route('receptionists.index')->with('success', 'Receptionist deleted successfully.');
    }


    // below code for receptionist dashboard
    public function receptionPatientAdd(Request $request)
    {
        $request->validate([
            'honorific' => 'nullable|string',
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'required|string|max:10',
            'address' => 'nullable|string',
            'age2' => 'required|string',
            'age' => 'string',
            'gender' => 'required|integer',
            'city' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:6',
            'existingBidStr' => 'nullable|string|max:15',
            'blood_group' => 'nullable|string|max:5',
            'preferred_language' => 'nullable|string|max:10',
            'careOf' => 'nullable|string|max:255',
            'SecondaryPhone' => 'nullable|string|max:10',
            'occupation' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
            // 'user_id' => 'required|integer|exists:users,id',
        ]);
        $role = Role::where('name', 'patient')->first();
        //die($role);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->phone), //patient password generate automatically as their phone number
            'role_id' => $role->id,
        ]);

        $user = User::where('email', $request->email)->orWhere('phone',$request->phone)->first();
        //die($user);
        $user_id = $user->id;

        $lastPatient = Patient::orderBy('id', 'desc')->first();
        $serialNumber = $lastPatient ? $lastPatient->id + 1 : 1;
        $uniquePatientID = 'SISD' . str_pad($serialNumber, 7, '0', STR_PAD_LEFT);
        
        $patient = Patient::create([
                'uniquePatientID' => $uniquePatientID,
                'honorific' => $request->honorific,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'age' => $request->age2,
                'dob' => $request->age,
                'gender' => $request->gender,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'existingBidStr' => $request->existingBidStr,
                'blood_group' => $request->blood_group,
                'preferred_language' => $request->preferred_language,
                'careOf' => $request->careOf,
                'SecondaryPhone' => $request->SecondaryPhone,
                'occupation' => $request->occupation,
                'tag' => $request->tag,
                'user_id' => $user_id,
            ]);
            if($patient) {

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
            

                $appointments = Appointment::create([
                    'uniquePatientID' => $uniquePatientID, 
                    'doctor_id' => $request->doctorList,  
                    'patient_id' => $patient->id, 
                    'appointment_date' => now(), 
                    'token' => $newToken, 
                    'status' => '1',   
                ]);
                if ($appointments) {
                    // Check if uniquePatientID exists in the session
                    if (Session::has('uniquePatientID')) {
                        // Remove the old value
                        Session::forget('uniquePatientID');
                    }
                    // Set the new value
                    Session::put('uniquePatientID', $uniquePatientID);
                }

            }


        return response()->json(['success' => 'Patient added successfully', 'patient' => $patient, 'appointments'=> $appointments]);
    }

    public function receptionPatientEdit(Request $request, $id)
    {
        $request->validate([
            'honorific' => 'nullable|string',
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'required|string|max:10',
            'address' => 'nullable|string',
            'age2' => 'required|string',
            'age' => 'nullable|string',
            'gender' => 'required|integer',
            'city' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:6',
            'existingBidStr' => 'nullable|string|max:15',
            'blood_group' => 'nullable|string|max:5',
            'preferred_language' => 'nullable|string|max:10',
            'careOf' => 'nullable|string|max:255',
            'SecondaryPhone' => 'nullable|string|max:10',
            'occupation' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
        ]);

        $patient = Patient::findOrFail($id);

        $patient->update([
            'honorific' => $request->honorific,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'age' => $request->age2,
            'dob' => $request->age,
            'gender' => $request->gender,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'existingBidStr' => $request->existingBidStr,
            'blood_group' => $request->blood_group,
            'preferred_language' => $request->preferred_language,
            'careOf' => $request->careOf,
            'SecondaryPhone' => $request->SecondaryPhone,
            'occupation' => $request->occupation,
            'tag' => $request->tag,
        ]);

        return response()->json(['success' => true, 'message' => 'Patient updated successfully!', 'patient' => $patient]);
    }


    public function getPaitent(Request $request)
    {
        // Retrieve input date or use the current date as default
        //$uniquePatientID = $request->uniquePatientID;
        $currentDate = $request->input('date', Carbon::now()->toDateString());
        // Retrieve input status or use 'all' as default
        $status = $request->input('status', 'all');
        // Retrieve input name filter or use empty string as default
        $nameFilter = $request->input('name', '');

        // Fetch all doctors and services
        $doctors = Doctor::all();
        $services = Service::all();
        // Fetch all visits for the current date
        

        // Query patients for the current date
        $patients = Patient::with([
            'appointments' => function ($query) use ($currentDate, $status) {
                $query->whereDate('appointment_date', $currentDate);
                if ($status !== 'all') {
                    $query->where('status', $status); // Apply status filter if provided
                }
            },
            'appointments.doctor',
            'appointments.service',
            'billings',
            'billings.deposits',
            'visits' => function ($query) {
                $query->latest('created_at'); // Fetch latest visit
            }
        ])
        ->whereHas('appointments', function ($query) use ($currentDate, $status) {
            $query->whereDate('appointment_date', $currentDate);
            if ($status !== 'all') {
                $query->where('status', $status); // Apply status filter if provided
            }
        })
        ->when($nameFilter, function ($query, $nameFilter) {
            $query->where('name', 'like', "%$nameFilter%"); // Apply name filter if provided
        })
        ->orderBy('id', 'desc')
        ->get();
        foreach ($patients as $patient) {
            $patient->latest_visit = $patient->visits->first() ?? null;
        }

        if ($patients->isEmpty()) {
        // Fetch all previous appointments before the current date
        $patients = Patient::with([
                        'appointments' => function ($query) use ($currentDate) {
                            $query->whereDate('appointment_date', '<', $currentDate); // Include all previous dates
                        },
                        'appointments.doctor',
                        'appointments.service',
                        'billings',
                        'billings.deposits',
                        'visits' => function ($query) {
                            $query->latest('created_at'); // Fetch latest visit
                        }
                    ])
                    ->whereHas('appointments', function ($query) use ($currentDate) {
                        $query->whereDate('appointment_date', '<', $currentDate); // Filter appointments before current date
                    })
                    ->when($nameFilter, function ($query, $nameFilter) {
                        $query->where('name', 'like', "%$nameFilter%"); // Apply name filter if provided
                    })
                    ->orderBy('id', 'desc')
                    ->get();
                    foreach ($patients as $patient) {
                        $patient->latest_visit = $patient->visits->first() ?? null;
                    }
        }

        return view('dashboards.partials.patient_list', compact('patients', 'doctors', 'services'));
    }

    public function getPatientDetailsForPopUp(Request $request)
    {
        
        $request->validate([
            'uniquePatientID' => 'required|string',
        ]);
        $uniquePatientID = $request->uniquePatientID;
        //dd($uniquePatientID);
        $patient = Patient::where('uniquePatientID', $uniquePatientID)->first();

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found for the provided uniquePatientID.',
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'patient' => $patient,
        ]);
    }

    public function getBillsModal(){
        //$patients = Patient::all();
        $doctors = Doctor::all();
        $services = Service::all();
        $discount = 0;
        return view('dashboards.partials.addBills', compact('services','doctors', 'discount'));
    }
    public function editAppntTab(Request $request){

        $uniquePatientID = $request->query('uniquePatientID');

        $services = Service::all();
        $doctors = Doctor::all();
        $patients = Patient::all();

        $appointments = Appointment::where('uniquePatientID', $uniquePatientID)
            ->with(['doctor', 'patient', 'appointmentServices.service'])
            ->get();

        return view('dashboards.partials.editAppntTab', compact('services', 'doctors', 'patients', 'appointments'));
        // $uniquePatientID = $request->query('uniquePatientID');
        // $services = Service::all();
        // $doctors = Doctor::all();
        // $patients = Patient::all();
        // $appointments = Appointment::where('uniquePatientID', $uniquePatientID)->with('doctor', 'service', 'patient')->get();
        // //dd($appointments->service->name);
        // return view('dashboards.partials.editAppntTab', compact('services', 'doctors', 'patients', 'appointments'));
    }
    public function allBillsTab(Request $request){
        $uniquePatientID = $request->query('uniquePatientID');
        $bills = Billing::where('uniquePatientID', $uniquePatientID)->with('patient')->orderBy('created_at', 'desc')->get();
        //$lastDeposit = $bill->deposits()->latest()->first();

        return view('dashboards.partials.allBillsTab', compact('bills'));
    
    }
    public function paymentsTabs(Request $request){
        //$patients = Patient::all();
        $services = Service::all();
        $uniquePatientID = $request->query('uniquePatientID');
        $payments = Billing::where('uniquePatientID', $uniquePatientID)->with('patient', 'deposits')->orderBy('created_at', 'desc')->get();
        //$lastDeposit = $bill->deposits()->latest()->first();
        $grossBillAmount = $payments->sum('total_amount');
        // $discount = $payments->sum('discount');
        // $tax = $payments->sum('tax');
        // $netAmount = $grossBillAmount - $discount + $tax;
        $collectedAmount = $payments->sum('paid_amount');
        $balanceAmount = $grossBillAmount - $collectedAmount;

        return view('dashboards.partials.paymentsTabs', compact('services','payments', 'grossBillAmount',  'collectedAmount', 'balanceAmount'));
    }
    public function visitsTabs(){
        //$patients = Patient::all();
        $services = Service::all();
        return view('dashboards.partials.visitsTabs', compact('services'));
    }
    public function labReportsTabs(){
        //$patients = Patient::all();
        $services = Service::all();
        return view('dashboards.partials.labReportsTabs', compact('services'));
    }
    public function patientTabs(){
        //$patients = Patient::all();
        $services = Service::all();
        return view('dashboards.partials.patientTabs', compact('services'));
    }
    

    public function getPatientDetails($patientID)
    {
        $patient = Patient::find($patientID);

        if ($patient) {
            return response()->json([
                'status' => 'success',
                'data' => $patient
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ]);
        }
    }
    public function printBill1($orderID)
    {
        $bill = Billing::where('order_id', $orderID)->first();

        if ($bill) {
            return response()->json([
                'status' => 'success',
                'data' => $bill
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Bill not found'
            ]);
        }
        
    }
    public function printBill($billingId, Request $request)
    {
        $printType = $request->query('type', 'single_bill'); // Default to single_bill
        $patientId = $request->query('patientId');
        $token = $request->query('token');
        $roomNumber = $request->query('roomNumber');

         

        if (!$billingId || !$patientId) {
            return abort(404, 'Invalid request parameters');
        }

        // Fetch the billing details or all bills based on type
        if ($printType === 'frontdesk_all_bills') {
            $bills = Billing::where('patient_id', $patientId)->get();
            if ($bills->isEmpty()) {
                return abort(404, 'No bills found for the patient.');
            }
            return view('print.all_bills_print', compact('bills','token', 'roomNumber'));
        } else {
            $billing = Billing::with(['deposits', 'patient'])->find($billingId);
            if (!$billing || $billing->patient_id != $patientId) {
                return abort(404, 'Billing record not found.');
            }
            return view('print.billPrint', compact('billing' ));
        }

        // Return a printable view
        // return view('print.billPrint', $data);
    }

    

    public function saveVitals(Request $request)
    {
        // require Vitals table model and controller
        $vitals = new Vitals();
        $vitals->patient_id = $request->patient_id;
        $vitals->temperature = $request->temperature;
        $vitals->blood_pressure = $request->blood_pressure;
        $vitals->heart_rate = $request->heart_rate;
        $vitals->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Vitals saved successfully'
        ]);
    }
    public function saveTestResult(Request $request)
    {
        $testResult = new LabTest();
        $testResult->patient_id = $request->patient_id;
        $testResult->test_type = $request->test_type;
        $testResult->result = $request->result;
        $testResult->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Test result saved successfully'
        ]);
    }


    public function getPrescription($patientID)
    {
        // First try to find the most recent visit for this patient
        $visit = \App\Models\Visit::where('patient_id', $patientID)
                      ->orderBy('created_at', 'desc')
                      ->first();
                      
        if ($visit) {
            // If we found a visit, get the prescription associated with it
            $prescription = Prescription::where('patient_id', $patientID)->first();
            
            return response()->json([
                'status' => 'success',
                'visit_id' => $visit->id,
                'data' => $prescription ?? null
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No visit found for this patient'
            ]);
        }
    }
    public function saveAttachment(Request $request)
    {
        // require model and tables for attachement.
        
        // $attachment = new Attachment();
        // $attachment->patient_id = $request->patient_id;
        // $attachment->file_path = $request->file('file')->store('attachments');
        // $attachment->save();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Attachment saved successfully'
        // ]);
    }

    public function updateAppointment(Request $request, $appointmentID)
    {
        $appointment = Appointment::find($appointmentID);
        if ($appointment) {
            $appointment->patient_name = $request->patient_name;
            $appointment->doctor_id = $request->doctor_id;
            $appointment->appointment_type = $request->appointment_type;
            $appointment->time = $request->time;
            $appointment->date = $request->date;
            $appointment->amount = $request->amount;
            $appointment->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Appointment updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Appointment not found'
            ]);
        }
    }

    public function forgetSessionData(Request $request)
    {
        // Forget specific session keys related to the patient modal
        if (Session::has('patient_id')) {
            Session::forget('patient_id');
        }
    
        if (Session::has('p_id')) {
            Session::forget('p_id');
        }
    
        if (Session::has('s_id')) {
            Session::forget('s_id');
        }
        // Session::forget(['patient_id', 'p_id', 's_id']); // Add your session keys here

        // Optionally, clear the entire session
        // Session::flush();

        // Return a response
        return response()->json(['success' => true, 'message' => 'Session data forgotten successfully.']);
    }

    
    public function addDeposit(Request $request)
    {
        //dd($request->deposit_mode);
        // Validate the incoming request data
        $validated = $request->validate([
            'uniquePatientID' => 'required',
            'patient_id' => 'required|exists:patients,id',
            'deposit_amount' => 'required|numeric|min:0.01',
            'deposit_mode' => 'required|in:0,1,2,3,4,5', // Assuming these are valid modes
            'totalamount' => 'required|numeric|min:0.01' // Ensure the total amount is a valid number
        ]);

        // Extract validated values
        $patientId = $validated['patient_id'];
        $depositAmount = $validated['deposit_amount'];
        $depositMode = $validated['deposit_mode'];
        $uniquePatientID = $validated['uniquePatientID']; // Corrected spelling
        $totalAmount = $validated['totalamount'];


        //dd($uniquePatientID . '-----asdvgfsgdfsfgdsf');


        DB::beginTransaction();
        try {
            // Check if the patient exists in the appointments table
            $appointmentExists = DB::table('appointments')->where('patient_id', $patientId)->exists();
            $appointments = Appointment::where('patient_id', $patientId)->first();
            if (!$appointmentExists) {
                throw new \Exception('Appointment with the given patient ID does not exist.');
            }

            // Check if there's an existing bill for the patient with an outstanding balance
            $bill = Billing::where('patient_id', $patientId)
                ->where('balance_amount', '>', 0)
                ->first();
                //dd($bill .'----tivktivksjdbshdgsgdstingtong');
            // If no such bill exists, create a new one
            if (!$bill) {
                //dd($bill .'----sjdbshdgsgdstingtong');

                $bill = Billing::create([
                    'uniquePatientID' => $uniquePatientID,
                    'patient_id' => $patientId,
                    'total_amount' => $totalAmount,  // Or any default value or calculation
                    'paid_amount' => 0,               // paid_amount
                    'balance_amount' => $totalAmount, // balance_amount initially set to total_amount
                            
                ]);

                //die($bill);
                //dd($bill .'----sjdbshdgsgds--if');
            }

            // Ensure $bill is not null before accessing its properties
            if (!$bill) {
                throw new \Exception('Failed to retrieve or create a billing record.');
            }

            // Update the bill with the new deposit
            $bill->update([
                'paid_amount' => $bill->paid_amount + $depositAmount,
                'balance_amount' => max($bill->total_amount - ($bill->paid_amount + $depositAmount), 0),
                'updated_at' => now()
            ]);

            //dd($bill .'----sjdbshdgsgds--after--bill');
            // Create the deposit record
            Deposit::create([
                'billing_id' => $bill->id,
                'amount' => $depositAmount,
                'mode' => $depositMode,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            //dd($appointmentExists .'----sjdbshdgsgds--after--appointmentExists');
            $appointmentService = AppointmentService::where('appointment_id', $appointments->id)->first();
            if ($appointmentService) {
                $appointmentService->payment_completed = true;
                $appointmentService->save();
            }
            if (!$appointmentService) {
                throw new \Exception('No appointment service found for this appointment.');
            }

            
            if ($appointments) {
                $appointments->payment_completed = true;
                $appointments->save();
            }
            if (!$appointments) {
                throw new \Exception('No appointment service found for this appointment.');
            }

            DB::commit();
            if (Session::has('uniquePatientID')) {
                // Remove the old value
                Session::forget('uniquePatientID');
            }
            // Return a response with the updated values
            return response()->json([
                'success' => true,
                'message' => 'Payment processed successfully',
                'totalAmount' => $bill->total_amount,
                'paidAmount' => $bill->paid_amount + $depositAmount,
                'balanceAmount' => max($bill->total_amount - ($bill->paid_amount + $depositAmount), 0),
                'depositAmount' => $depositAmount,
                'paymentStatus' => ($bill->paid_amount + $depositAmount >= $bill->total_amount) ? 'completed' : 'partial',
                'bill_id' => $bill->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to add deposit: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function generateBillPdf(Request $request)
    {
        // Fetch bill data from the request or database
        $bill = Billing::with('patient', 'services')->findOrFail($request->billId);
        $lastDeposit = $bill->deposits()->latest()->first();

        // Check if the deposit transaction exists
        if (!$lastDeposit) {
            return response()->json(['success' => false, 'message' => 'No deposit record found'], 404);
        }

        $pdf = Pdf::loadView('pdf.bill_receipt', [
            'bill' => $bill,
            'patient' => $bill->patient,
            'lastDeposit' => $lastDeposit
        ]);

        return $pdf->download('bill_receipt.pdf');
    }
    public function updateAppointments(Request $request){
        
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'doctor-id' => 'required|exists:doctors,id',
            'service-id' => 'required|exists:services,id',
            'appointment-time' => 'required|date_format:H:i',
            'appointment-date' => 'required|date',
            'appnt-status' => 'required|in:0,1,2,3,4,5',
            'appntDuration' => 'required|integer',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // If ID is provided, update the existing appointment, otherwise create a new one
        $appointment = $request->input('appnt-ID-1') 
                        ? Appointment::find($request->input('appnt-ID-1')) 
                        : new Appointment;

        // Fill the appointment data
        $appointment->doctor_id = $request->input('doctor-id');
        $appointment->service_id = $request->input('service-id');
        $appointment->appointment_time = $request->input('appointment-time');
        $appointment->appointment_date = $request->input('appointment-date');
        $appointment->status = $request->input('appnt-status');
        $appointment->duration = $request->input('appntDuration');

        // Save the appointment
        $appointment->save();

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Appointment saved successfully.',
            'appointment' => $appointment
        ]);
    
    }

}

