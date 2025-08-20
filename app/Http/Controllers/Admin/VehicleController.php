<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles=Vehicle::latest()->get();
        return view('admin.vehicle.index',compact('vehicles'));
    }
    public function create()
    {
        return view('admin.vehicle.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'vin_sn'       => 'required|string|max:255',
            'vehicle_name' => 'required|string|max:255',
            'type'         => 'required|string',
            'status'       => 'required|string',
            'ownership'    => 'required|string',
            'pictures.*'   => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pictures' => 'required|array|max:3',  
            'note'         => 'nullable|string',
        ]);

        $images = [];
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('vehicles', $filename, 'public');
                $images[] = $filename;
            }
        }

        Vehicle::create([
            'vin_sn'       => $request->vin_sn,
            'vehicle_name' => $request->vehicle_name,
            'type'         => $request->type,
            'status'       => $request->status,
            'ownership'    => $request->ownership,
            'pictures'     => $images,
            'note'         => $request->note,
        ]);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully!');
    }

    public function show( $id)
    {
         $vehicle=Vehicle::find($id);
        return view('admin.vehicle.show', compact('vehicle'));
    }

    public function edit( $id)
    {
        $vehicle=Vehicle::find($id);
        return view('admin.vehicle.edit', compact('vehicle'));
    }

  public function update(Request $request, $id)
{
    $vehicle = Vehicle::findOrFail($id);

    $request->validate([
        'vin_sn'       => 'required|string|max:255',
        'vehicle_name' => 'required|string|max:255',
        'type'         => 'required|string',
        'status'       => 'required|string',
        'ownership'    => 'required|string',
        'pictures.*'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'pictures'     => 'nullable|array|max:3',
        'remove_pictures' => 'nullable|array',
        'remove_pictures.*' => 'string',
        'note'         => 'nullable|string',
    ]);

    // Decode current pictures
    $existingImages = is_array($vehicle->pictures) 
                      ? $vehicle->pictures 
                      : json_decode($vehicle->pictures, true) ?? [];

    // Remove pictures user marked for deletion
    if ($request->has('remove_pictures')) {
        foreach ($request->remove_pictures as $removePic) {
            // Remove file from storage
            \Storage::disk('public')->delete('vehicles/' . $removePic);

            // Remove from array
            if (($key = array_search($removePic, $existingImages)) !== false) {
                unset($existingImages[$key]);
            }
        }
        // Re-index array to keep it sequential
        $existingImages = array_values($existingImages);
    }

    // Handle new uploaded pictures
    if ($request->hasFile('pictures')) {
        foreach ($request->file('pictures') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('vehicles', $filename, 'public');
            $existingImages[] = $filename;
        }
    }

    // Update vehicle record
    $vehicle->update([
        'vin_sn'       => $request->vin_sn,
        'vehicle_name' => $request->vehicle_name,
        'type'         => $request->type,
        'status'       => $request->status,
        'ownership'    => $request->ownership,
        'pictures'     => json_encode($existingImages),
        'note'         => $request->note,
    ]);

    return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully!');
}


    public function destroy($id)
{
    $vehicle = Vehicle::findOrFail($id);

    // Decode pictures JSON to array
    $pictures = is_array($vehicle->pictures) ? $vehicle->pictures : json_decode($vehicle->pictures, true) ?? [];

    // Delete each picture file from storage
    foreach ($pictures as $pic) {
        \Storage::disk('public')->delete('vehicles/' . $pic);
    }

    // Delete the vehicle record
    $vehicle->delete();

    return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully!');
}

}
