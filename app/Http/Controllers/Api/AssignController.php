<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assign;

class AssignController extends Controller
{
   public function getDriverAssignment(Request $request)
{
    try {
        $driver = $request->user();

        // Check if user exists and meets role/classification requirements
        if (!$driver) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please login again.'
            ], 401);
        }

        if ($driver->role !== 'user' || $driver->classification !== 'employee') {
            return response()->json([
                'status' => false,
                'message' => 'Access denied. You are not authorized to view assignments.'
            ], 403);
        }

        // Fetch latest active assignment (end_datetime = NULL)
        $assignment = Assign::with('vehicle')
            ->where('operator_id', $driver->id)
           
            ->latest()
            ->first();

        // No active assignment found
        if (!$assignment) {
            return response()->json([
                'status' => false,
                'message' => 'No active vehicle assignment found.'
            ], 404);
        }

        // Success response
        return response()->json([
            'status' => true,
            'message' => 'Active vehicle assignment fetched successfully.',
            'data' => [
                'assignment_id'      => $assignment->id,
                'start_datetime'     => $assignment->start_datetime,
                'starting_odometer'  => $assignment->starting_odometer,
                'comment'            => $assignment->comment,
                'vehicle' => [
                    'id'    => $assignment->vehicle->id,
                    'vehicle_no'  => $assignment->vehicle->vin_sn ?? '',
                    'vehicle_name' => $assignment->vehicle->vehicle_name ?? '',
                ]
            ]
        ], 200);

    } catch (\Exception $e) {
        // Catch unexpected errors
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong.',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
