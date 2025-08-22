<?php

namespace App\Http\Controllers\Api;
use App\Models\Assign;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Defect;
use Illuminate\Support\Facades\Auth;
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
//     ->where('operator_id', auth()->id()) 
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

//   
//     $assignment = Assign::where('id', $request->assignment_id)
//         ->where('operator_id', auth()->id())
//         ->first();

//     if (!$assignment) {
//         return response()->json([
//             'status' => false,
//             'message' => 'No assignment found for this user.'
//         ], 404);
//     }

//    
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
           $defectives = $request->input('defectives', []);
           // Count how many defects are "yes" (1)
        $totalDefects = collect($defectives)->filter(function($val) {
            return $val == 'yes'; // or 'yes' if your array uses string
        })->count();

        $defect = Defect::create([
            'assignment_id' => $request->assignment_id,
            'user_id' => auth()->id(),
               'status' => "Created",
                'total_defects' => $totalDefects, 
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

       //Delte previous records if matches any 
        $defect->delete();

        DB::commit();

        return redirect()->back()->with('success', 'Defect deleted successfully.');
    } catch (\Throwable $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Delete failed: '.$e->getMessage());
    }
}



public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|in:Created,In Progress,Clear',
    ]);

    $defect = Defect::findOrFail($id);

    //Only Admin can  update this status 
    

    $defect->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Status updated successfully');
}


public function getUserDefects()
{
    $userId = Auth::id(); // Get the logged-in user's ID

    $defects = Defect::where('user_id', $userId)
       
        ->get();

    return response()->json([
        'status' => 'success',
        'count'  => $defects->count(),
        'data'   => $defects
    ]);
}




public function edit($id)
{
    $defect = Defect::with('details')->findOrFail($id);
    return view('admin.defect.edit', compact('defect'));
}
// Update funtiocn corresponding ot  add new details 
public function update(Request $request, $id)
{
    $request->validate([
        'detail_ids'    => 'nullable|array',
        'defectives'    => 'required|array',
        'notes'         => 'nullable|array',
        'images'        => 'nullable|array',
        'images.*'      => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
          'total_defects' => 'required|integer|min:0',

    ]);

       $defect = Defect::findOrFail($id);
    $defect->total_defects = $request->total_defects;
    $defect->save();


    $detailIds  = $request->detail_ids ?? [];
    $defectives = $request->defectives;
    $notes      = $request->notes ?? [];
    $images     = $request->file('images') ?? [];

    foreach ($defectives as $index => $isDefect) {
        $note = $notes[$index] ?? '';
        $image = $images[$index] ?? null;

        // Check if this is an existing detail or a new one
        if (isset($detailIds[$index])) {
            $detail = \App\Models\DefectDetail::find($detailIds[$index]);

            if (!$detail) {
                continue;
            }

            $data = [
                'is_defect' => $isDefect,
                'note'      => $note,
            ];

            if ($image) {
                if ($detail->image_path) {
                    \Storage::disk('public')->delete($detail->image_path);
                }
                $data['image_path'] = $image->store('defects', 'public');
            }

            $detail->update($data);
        } else {
            // Create new defect detail
            $data = [
                'defect_id' => $id,
                'is_defect' => $isDefect,
                'note'      => $note,
            ];

            if ($image) {
                $data['image_path'] = $image->store('defects', 'public');
            }

            \App\Models\DefectDetail::create($data);
        }
    }

    return redirect()->route('defect.index')->with('success', 'Defect details updated successfully!');
}




}
