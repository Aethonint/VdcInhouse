<?php

namespace App\Http\Controllers\Api;
use App\Models\Incident;
use App\Models\IncidentDetail;
use App\Models\Assign;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Defect;

class IncidentController extends Controller
{
    public function index()
    {
         $incidents = Incident::with(['details','user','assignment'])->latest()->get();
    return view('admin.incident.index', compact('incidents'));
    }
    
    // public function store(Request $request)
    // {
    //    
    //     $request->validate([
    //         'driver_id' => 'required|integer',
    //         'assignment_id' => 'required|integer',
    //         'vehicle_number' => 'required|string',
    //         'incident_date' => 'required|date',
    //         'details' => 'required|array',
    //         'details.*.field_name' => 'required|string',
    //         'details.*.notes' => 'nullable|string',
    //         'details.*.image' => 'nullable|file|image|max:2048'
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         // ✅ Store main incident
    //         $incident = Incident::create([
    //             'driver_id' => $request->driver_id,
    //             'assignment_id' => $request->assignment_id,
    //             'vehicle_number' => $request->vehicle_number,
    //             'incident_date' => $request->incident_date,
    //             // 'status' => 'pending'
    //         ]);

    //         // ✅ Store details
    //         foreach ($request->details as $index => $detail) {
    //             $imagePath = null;

    //             if (isset($detail['image']) && $detail['image'] instanceof \Illuminate\Http\UploadedFile) {
    //                 $imagePath = $detail['image']->store('incident_images', 'public');
    //             }

    //             IncidentDetail::create([
    //                 'incident_id' => $incident->id,
    //                 'field_name' => $detail['field_name'],
    //                 'notes' => $detail['notes'] ?? null,
    //                 'image_path' => $imagePath
    //             ]);
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'message' => 'Incident report saved successfully',
    //             'incident_id' => $incident->id
    //         ], 201);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

     public function store(Request $request)
    {
       
        $request->validate([
            'assignment_id' => 'required|integer',
            // 'vehicle_number' => 'required|string',
            'incident_date' => 'required|date',
            'details' => 'required|array',
            'details.*.field_name' => 'required|string',
            'details.*.notes' => 'nullable|string',
            'details.*.image' => 'nullable|file|image|max:2048'
        ]);

        
        $assignment = Assign::where('id', $request->assignment_id)
            ->where('operator_id', auth()->id())
            ->first();

        if (!$assignment) {
            return response()->json([
                'status' => false,
                'message' => 'No assignment found for this user.'
            ], 404);
        }

        DB::beginTransaction();
        try {
          
            $incident = Incident::create([
                'driver_id' => auth()->id(), 
                'assignment_id' => $request->assignment_id,
                // 'vehicle_number' => $request->vehicle_number,
                'incident_date' => $request->incident_date,
                // 'status' => 'pending'
            ]);

            
            foreach ($request->details as $index => $detail) {
                $imagePath = null;

                if (isset($detail['image']) && $detail['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $imagePath = $detail['image']->store('incident_images', 'public');
                }

                IncidentDetail::create([
                    'incident_id' => $incident->id,
                    'field_name' => $detail['field_name'],
                    'notes' => $detail['notes'] ?? null,
                    'image_path' => $imagePath
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Incident report saved successfully',
                'incident_id' => $incident->id
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
{
    // Load Incident with related details, driver (user), and assignment
    $incident = Incident::with([
        'details',          // incident_details
        'user',             // driver (from users table)
        'assignment.vehicle' // if you have a vehicle relationship inside Assign
    ])->findOrFail($id);

    return view('admin.incident.show', compact('incident'));
}
public function destroy($id)
{
    $incident = Incident::with('details')->findOrFail($id);

    // Delete related incident details and their images
    foreach ($incident->details as $detail) {
        if (!empty($detail->image_path) && \Storage::exists('public/' . $detail->image_path)) {
            \Storage::delete('public/' . $detail->image_path);
        }
        $detail->delete();
    }

    // Delete the incident itself
    $incident->delete();

    return redirect()->route('incident.index')->with('success', 'Incident deleted successfully.');
}

public function getUserIncidents()
{
    $userId = Auth::id(); // Get the logged-in user's ID

    $incident = Incident::where('driver_id', $userId)
       
        ->get();

    return response()->json([
        'status' => 'success',
        'count'  => $incident->count(),
        'data'   => $incident
    ]);
}


    
}
