<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;

use App\Models\User;
use App\Models\Assign;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignVehicleController extends Controller
{
    public function index()
    {
          // Fetch vehicles (with vin_sn)
  
$assignments = Assign::with(['vehicle', 'operator'])
            ->latest()
            ->get();
    
       
        return view('admin.assignvehicle.index',compact('assignments'));
    }
public function create()
{
    // Fetch vehicles with their VIN/SN
    $vehicles = Vehicle::select('id', 'vin_sn', 'vehicle_name', 'type')
                       ->orderBy('vin_sn', 'asc')
                       ->get();

    // Fetch drivers with classification = employee
    $drivers = User::where('role', 'user')
                   ->where('classification', 'employee')
                   ->select('id', 'first_name')
                   ->orderBy('first_name', 'asc')
                   ->get();

    return view('admin.assignvehicle.create', compact('vehicles', 'drivers'));
}
     public function store(Request $request)
    {
        $validated = $request->validate([
            'assigned_vehicle'   => 'required|exists:vehicles,id',
            'operator'           => 'required|exists:users,id',
            'start_date'         => 'nullable|date',
            'start_time'         => 'nullable',
            'end_date'           => 'nullable|date',
            'end_time'           => 'nullable',
            'starting_odometer'  => 'nullable|integer|min:0',
            'ending_odometer'    => 'nullable|integer|min:0',
            'optional_comment'   => 'nullable|string',
        ]);

        $start = ($request->start_date && $request->start_time)
            ? $request->start_date.' '.$request->start_time
            : ($request->start_date ?: null);

        $end = ($request->end_date && $request->end_time)
            ? $request->end_date.' '.$request->end_time
            : ($request->end_date ?: null);

        Assign::create([
            'vehicle_id'        => $validated['assigned_vehicle'],
            'operator_id'       => $validated['operator'],
            'start_datetime'    => $start,
            'end_datetime'      => $end,
            'starting_odometer' => $request->starting_odometer,
            'ending_odometer'   => $request->ending_odometer,
            'comment'           => $request->optional_comment,
        ]);

        return redirect()
            ->route('assign_vehicle.index')
            ->with('success', 'Assignment added successfully.');
    }

    public function show( $id)
    {
         
        return view('vehicle.show',);
    }

    public function edit( $id)
    {
        $assignment = Assign::find($id);
          $vehicles = Vehicle::select('id', 'vin_sn', 'vehicle_name', 'type')
                       ->orderBy('vin_sn', 'asc')
                       ->get();

    // Fetch drivers with classification = employee
    $drivers = User::where('role', 'user')
                   ->where('classification', 'employee')
                   ->select('id', 'first_name')
                   ->orderBy('first_name', 'asc')
                   ->get();
        return view('admin.assignvehicle.edit', compact('vehicles', 'drivers','assignment'));
    }

    public function update(Request $request,  $id)
    {
        $assignment = Assign::find($id);

        $validated = $request->validate([
            'assigned_vehicle'   => 'required|exists:vehicles,id',
            'operator'           => 'required|exists:users,id',
            'start_date'         => 'nullable|date',
            'start_time'         => 'nullable',
            'end_date'           => 'nullable|date',
            'end_time'           => 'nullable',
            'starting_odometer'  => 'nullable|integer|min:0',
            'ending_odometer'    => 'nullable|integer|min:0',
            'optional_comment'   => 'nullable|string',
        ]);

        $start = ($request->start_date && $request->start_time)
            ? $request->start_date.' '.$request->start_time
            : ($request->start_date ?: null);

        $end = ($request->end_date && $request->end_time)
            ? $request->end_date.' '.$request->end_time
            : ($request->end_date ?: null);

        $assignment->update([
            'vehicle_id'        => $validated['assigned_vehicle'],
            'operator_id'       => $validated['operator'],
            'start_datetime'    => $start,
            'end_datetime'      => $end,
            'starting_odometer' => $request->starting_odometer,
            'ending_odometer'   => $request->ending_odometer,
            'comment'           => $request->optional_comment,
        ]);

        return redirect()
            ->route('assign_vehicle.index')
            ->with('success', 'Assignment updated.');
    }

   public function destroy($id)
{
    $assignVehicle = Assign::findOrFail($id); 
    $assignVehicle->delete(); // Delete the record

    return redirect()
        ->route('assign_vehicle.index')
        ->with('success', 'Assignment deleted successfully.');
}

}
