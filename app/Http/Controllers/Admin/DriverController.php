<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = User::where('role', 'user')
    ->with('driver')
    ->latest()
    ->get();


        return view('admin.driver.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function store(Request $request)
    {
        $authUser = Auth::user();

        if (!$authUser || $authUser->role !== 'admin') {
            return redirect()
                ->route('driver.index')
                ->with('error', 'You are not authorized to create a driver.');
        }

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|min:6',
            'job_title' => 'required',
            'dob' => 'required|date',
            'classification' => 'required|in:operator,employee,technician',
            'employee_no' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'license_number' => 'nullable',
           
            'hourly_rate' => 'required|numeric',
            'address' => 'required',
        ]);

        $validated['phone'] = str_replace(' ', '', $validated['phone']);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'user'
        ]);

        Driver::create([
            'user_id' => $user->id,
            'classification' => $validated['classification'],
            'job_title' => $validated['job_title'],
            'dob' => $validated['dob'],
            'employee_no' => $validated['employee_no'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'license_number' => $validated['license_number'],
    
            'hourly_rate' => $validated['hourly_rate'],
            'address' => $validated['address'],
        ]);

        return redirect()
            ->route('driver.index')
            ->with('success', 'Driver created successfully!');
    }

    public function show($id)
    {
        $driver = User::with('driver')->findOrFail($id);
        return view('admin.driver.show', compact('driver'));
    }

    public function edit($id)
    {
        $driver = User::with('driver')->findOrFail($id);
        return view('admin.driver.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
       
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required',
            'password' => 'nullable|min:6',
            'job_title' => 'required',
            'dob' => 'required|date',
            'classification' => 'required|in:operator,employee,technician',
            'employee_no' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'license_number' => 'nullable',
          
            'hourly_rate' => 'required|numeric',
            'address' => 'required',
        ]);

        $validated['phone'] = str_replace(' ', '', $validated['phone']);

        $user = User::findOrFail($id);
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
        ]);

        $user->driver()->update([
            'classification' => $validated['classification'],
            'job_title' => $validated['job_title'],
            'dob' => $validated['dob'],
            'employee_no' => $validated['employee_no'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'license_number' => $validated['license_number'],
           
            'hourly_rate' => $validated['hourly_rate'],
            'address' => $validated['address'],
        ]);

        return redirect()
            ->route('driver.index')
            ->with('success', 'Driver updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete driver details first
        $user->driver()->delete();

        // Then delete user
        $user->delete();

        return redirect()
            ->route('driver.index')
            ->with('success', 'Driver deleted successfully!');
    }
}
