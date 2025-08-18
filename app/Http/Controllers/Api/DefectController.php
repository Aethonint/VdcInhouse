<?php

namespace App\Http\Controllers\Api;
use App\Models\Assign;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Defect;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use App\Models\DefectDetail;
class DefectController extends Controller
{
//    public function storeDefects(Request $request)
// {
//     $request->validate([
//         'vehicle_id' => 'required|integer',
//         'details' => 'required|array|min:7|max:7',
//         'details.*.step_no' => 'required|integer',
//         'details.*.is_defect' => 'required|in:yes,no',
//         'details.*.note' => 'nullable|string',
//         'details.*.image' => 'nullable|file|mimes:jpg,jpeg,png'
//     ]);

//     DB::beginTransaction();

//     try {
//         // Create main defect record
//         $defect = Defect::create([
//             'user_id' => $request->user()->id,
//             'vehicle_id' => $request->vehicle_id
//         ]);

//         // Save each step detail
//         foreach ($request->details as $detail) {
//             $imagePath = null;
//             if (isset($detail['image'])) {
//                 $imagePath = $detail['image']->store('defects', 'public');
//             }

//             DefectDetail::create([
//                 'defect_id' => $defect->id,
//                 'step_no' => $detail['step_no'],
//                 'is_defect' => $detail['is_defect'],
//                 'note' => $detail['note'] ?? '',
//                 'image_path' => $imagePath
//             ]);
//         }

//         DB::commit();

//         return response()->json(['status' => true, 'message' => 'Defects saved successfully.'], 200);
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return response()->json(['status' => false, 'message' => 'Error: '.$e->getMessage()], 500);
//     }
// }
public function index()
{
     $defects = Defect::with(['assignment', 'user'])->latest()->get();

    return view('admin.defect.index', compact('defects'));
}
public function show($id)
{
    $defect = Defect::with('details')->findOrFail($id);

   return view('admin.defect.show', compact('defect'));

    
}



// public function storeDefects(Request $request)
// {
//     $request->validate([
//         'assignment_id' => 'required|integer',
       
     
//         'details.*.is_defect' => 'nullable|string', // yes/no/text
//         'details.*.note' => 'nullable|string',
//         'details.*.image' => 'required|file|mimes:jpg,jpeg,png|max:2048'
//     ]);

// $assignment = Assign::where('id', $request->assignment_id)
//     ->where('operator_id', auth()->id()) // ✅ Correct column check if assingme_id related to specifc users or not
//     ->first();

// if (!$assignment) {
//     return response()->json([
//         'status' => false,
//         'message' => 'No assignment found for this user.'
//     ], 404);
// }
//     DB::beginTransaction();

//     try {
//         // Create defect entry linked to assignment
        
//         $defect = Defect::create([
//             'assignment_id' => $request->assignment_id,
//             "user_id" => auth()->id(), 
//         ]);

//         // Save each step detail
//         foreach ($request->details as $detail) {
//             $imagePath = null;
//             if (isset($detail['image'])) {
//                 $imagePath = $detail['image']->store('defects', 'public');
//             }

//             DefectDetail::create([
//                 'defect_id' => $defect->id,
              
//                 'is_defect' => $detail['is_defect'] ?? null,
//                 'note' => $detail['note'] ?? '',
//                 'image_path' => $imagePath
//             ]);
//         }

//         DB::commit();

//         return response()->json(['status' => true, 'message' => 'Defects saved successfully.'], 200);
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return response()->json(['status' => false, 'message' => 'Error: '.$e->getMessage()], 500);
//     }
// }
// public function storeDefects(Request $request)
// {
//     $request->validate([
//         'assignment_id' => 'required|integer',
//         'details' => 'required',
//     ]);

//     // ✅ Validate assignment ownership
//     $assignment = Assign::where('id', $request->assignment_id)
//         ->where('operator_id', auth()->id())
//         ->first();

//     if (!$assignment) {
//         return response()->json([
//             'status' => false,
//             'message' => 'No assignment found for this user.'
//         ], 404);
//     }

//     // ✅ Decode details
//     $details = json_decode($request->details, true);
//     if (!is_array($details)) {
//         return response()->json([
//             'status' => false,
//             'message' => 'Invalid details format. Must be JSON array.'
//         ], 422);
//     }

//     DB::beginTransaction();
//     try {
//         $defect = Defect::create([
//             'assignment_id' => $request->assignment_id,
//             'user_id' => auth()->id(),
//         ]);

//         foreach ($details as $index => $detail) {
//             $imagePath = null;
//             if ($request->hasFile("image.$index")) {
//                 $imagePath = $request->file("image.$index")->store('defects', 'public');
//             }

//             DefectDetail::create([
//                 'defect_id' => $defect->id,
//                 'is_defect' => $detail['is_defect'] ?? null,
//                 'note' => $detail['note'] ?? '',
//                 'image_path' => $imagePath
//             ]);
//         }

//         DB::commit();
//         return response()->json([
//             'status' => true,
//             'message' => 'Defects saved successfully.'
//         ], 200);

//     } catch (\Exception $e) {
//         DB::rollBack();
//         return response()->json([
//             'status' => false,
//             'message' => 'Error: ' . $e->getMessage()
//         ], 500);
//     }
// }


public function storeDefects(Request $request)
{
    $request->validate([
        'assignment_id' => 'required|integer',
        'images' => 'nullable|array',
        'images.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        'notes' => 'nullable|array',
        'defectives' => 'nullable|array'
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
        $defect = Defect::create([
            'assignment_id' => $request->assignment_id,
            'user_id' => auth()->id(),
        ]);

        $images = $request->file('images') ?? [];
        $notes = $request->input('notes', []);
        $defectives = $request->input('defectives', []);
$defectives = $request->defectives ?? [];
$notes = $request->notes ?? [];
$images = $request->file('images') ?? [];

$max = count($defectives); // All arrays must have same length

for ($i = 0; $i < $max; $i++) {
    $defectiveValue = $defectives[$i] ?? null;
    $noteValue = ($notes[$i] ?? '') == '0000' ? '' : ($notes[$i] ?? '');
    $imagePath = null;

    if ($request->hasFile("images.$i")) {
        $imagePath = $request->file("images.$i")->store('defects', 'public');
    }

    DefectDetail::create([
        'defect_id' => $defect->id,
        'is_defect' => $defectiveValue,
        'note' => $noteValue,
        'image_path' => $imagePath
    ]);
}



        DB::commit();
        return response()->json([
            'status' => true,
            'message' => 'Defects saved successfully.'
        ], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}





public function destroy($id)
{
    DB::beginTransaction();

    try {
        $defect = Defect::with('details')->findOrFail($id);

        // Delete images and details
        foreach ($defect->details as $detail) {
            if (!empty($detail->image_path)) {
                Storage::disk('public')->delete($detail->image_path);
            }
            $detail->delete();
        }

        // Delete defect record
        $defect->delete();

        DB::commit();

        return redirect()->back()->with('success', 'Defect deleted successfully.');
    } catch (\Throwable $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Delete failed: '.$e->getMessage());
    }
}


}
