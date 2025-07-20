<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $role = Role::where('name', 'doctor')->first();
        //die($role);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'phone' => '1234567890' // Ensure phone is included
        ]);

        $user = User::where('email', $request->email)->first();
        //die($user);
        $user_id = $user->id;

        Doctor::create([
            'name' => $request->name,
            'specialization'=>$request->specialization,
            'user_id'=>$user_id,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctors created successfully.');
        // $doctor = Doctor::create($request->all());
        // return redirect()->route('doctors.index');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $user = User::where('id', $doctor->user_id)->first();
        //die($user);

        return view('doctors.edit', compact('doctor','user'));
    }

    public function update(Request $request, User $doctor, Doctor $doctora)
    {
        // $doctor->update($request->all());
        // return redirect()->route('doctors.index');

        

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$doctor->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $doctor->password,
        ]);

        $doctorid = $doctor->id;
        // Update the user record in the database
        DB::table('doctors')
        ->where('user_id', $doctorid)
        ->update([
            'name' => $request->input('name'),
            'specialization' => $request->input('specialization'),
        ]);

    
        return redirect()->route('doctors.index')->with('success', 'Doctors updated successfully.');
    
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index');
    }
    public function doctorDashboard(Request $request)
    {
        // Get today's date or the selected date
        $selectedDate = $request->input('selected_date', Carbon::today()->format('Y-m-d'));

        // Fetch patients with their appointments for the selected date
        $patients = Patient::with(['appointments' => function ($query) use ($selectedDate) {
            $query->whereDate('appointment_date', $selectedDate);
        }, 'appointments.doctor', 'appointments.service'])->get();

        // Prepare data for the view
        $patientData = [];
        foreach ($patients as $patient) {
            foreach ($patient->appointments as $appointment) {
                $patientData[] = [
                    'patientUniqueID' => $patient->uniquePatientID,
                    'token' => $appointment->token,
                    'patientName' => $patient->name,
                    'visits' => $patient->appointments->count(),
                    'recentVisit' => $appointment->appointment_date,
                    'time' => $appointment->appointment_time,
                    'waitStatus' => $appointment->status,
                    'purpose' => $appointment->purpose,
                ];
            }
        }

        return view('dashboards.doctor-partials.docDashPatientList', compact('patientData', 'selectedDate'));
    }
}

