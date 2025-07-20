<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Session;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'age' => 'required|date',
            'gender' => 'required|string',
        ]);
        $role = Role::where('name', 'patient')->first();
        //die($role);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->phone), //patient password generate automatically as their phone number
            'role_id' => $role->id,
        ]);

        $user = User::where('email', $request->email)->first();
        //die($user);
        $user_id = $user->id;

        Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'user_id' =>$user_id,
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients,email,' . $patient->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
        ]);       


        $patient->update($request->all());

        $userid = $patient->user_id;
        // Update the user record in the database
        DB::table('users')
        ->where('id', $userid)
        ->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
    public function visits(Patient $patient)
    {
        $appointments = Appointment::where('patient_id', $patient->id)->with('doctor', 'service')->get();
        return view('patients.visits', compact('patient', 'appointments'));
    }

    public function storePatientId(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'patient_id' => 'required|string'
        ]);

        // Store the patient ID in the session
        
        Session::put('patient_id', $request->input('patient_id'));
        Session::put('p_id', $request->input('p_id'));
        return response()->json([
            'success' => true,
            'message' => 'Patient ID stored in session successfully.',
            'patient_id' => Session::get('patient_id'),
            'p_id' => Session::get('p_id')
        ]);
    }

}
