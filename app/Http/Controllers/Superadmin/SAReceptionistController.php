<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SAReceptionistController extends Controller
{
    public function index()
    {
        $receptionists = User::where('role_id', Role::where('name', 'receptionist')->first()->id)->get();
        return view('dashboards.superadmin-partials.receptionist', compact('receptionists'));

    }

    public function create()
    {
        return view('superadmin.receptionists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
        ]);

        $role = Role::where('name', 'receptionist')->first();

        $receptionist = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'phone' => $request->phone,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Receptionist created successfully.',
                'receptionist' => $receptionist
            ]);
        }

        return redirect()->route('superadmin.receptionists.index')
            ->with('success', 'Receptionist created successfully.');
    }

    public function update(Request $request, $id)
    {
        $receptionist = User::where('role_id', Role::where('name', 'receptionist')->first()->id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $receptionist->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
        ]);

        $receptionist->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $receptionist->password,
            'phone' => $request->phone,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Receptionist updated successfully.',
                'receptionist' => $receptionist
            ]);
        }

        return redirect()->route('superadmin.receptionists.index')
            ->with('success', 'Receptionist updated successfully.');
    }

    public function show($id)
    {
        $receptionist = User::where('role_id', Role::where('name', 'receptionist')->first()->id)
            ->findOrFail($id);
        return view('receptionists.show', compact('receptionist'));
    }

    public function edit($id)
    {
        $receptionist = User::where('role_id', Role::where('name', 'receptionist')->first()->id)
            ->findOrFail($id);
        return view('receptionists.edit', compact('receptionist'));
    }

    // public function update(Request $request, $id)
    // {
    //     $receptionist = User::where('role_id', Role::where('name', 'receptionist')->first()->id)
    //         ->findOrFail($id);

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $receptionist->id,
    //         'password' => 'nullable|string|min:8|confirmed',
    //         'phone' => 'nullable|string|max:15',
    //     ]);

    //     $receptionist->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password ? Hash::make($request->password) : $receptionist->password,
    //         'phone' => $request->phone,
    //     ]);

    //     return redirect()->route('superadmin.receptionists.index')
    //         ->with('success', 'Receptionist updated successfully.');
    // }

    public function destroy($id)
    {
        $receptionist = User::where('role_id', Role::where('name', 'receptionist')->first()->id)
            ->findOrFail($id);

        $receptionist->delete();

        return redirect()->route('superadmin.receptionists.index')
            ->with('success', 'Receptionist deleted successfully.');
    }
}
