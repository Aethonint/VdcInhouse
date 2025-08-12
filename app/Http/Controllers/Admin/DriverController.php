<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Driver;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        return view('admin.driver.index');
    }
    public function create()
    {
        return view('admin.driver.create');
    }
    public function store(Request $request)
    {
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
            'license_class' => 'nullable',
            'license_region' => 'nullable',
            'hourly_rate' => 'required|numeric',
            'address' => 'required',
        ]);

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
            'classification'=> $validated['classification'],
            'job_title' => $validated['job_title'],
            'dob' => $validated['dob'],
            'employee_no' => $validated['employee_no'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'license_number' => $validated['license_number'],
            'hourly_rate' => $validated['hourly_rate'],
            'address' => $validated['address'],
        ]);

        return redirect()->back()->with('success', 'Driver created successfully!');
}
}