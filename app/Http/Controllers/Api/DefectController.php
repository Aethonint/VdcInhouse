<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Defect;
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


public function storeDefects(Request $request)
{
    $request->validate([
        'assignment_id' => 'required|integer|exists:assigns,id',
       
     
        'details.*.is_defect' => 'nullable|string', // yes/no/text
        'details.*.note' => 'nullable|string',
        'details.*.image' => 'required|file|mimes:jpg,jpeg,png|max:2048'
    ]);

    DB::beginTransaction();

    try {
        // Create defect entry linked to assignment
        
        $defect = Defect::create([
            'assignment_id' => $request->assignment_id,
            "user_id" => auth()->id(), 
        ]);

        // Save each step detail
        foreach ($request->details as $detail) {
            $imagePath = null;
            if (isset($detail['image'])) {
                $imagePath = $detail['image']->store('defects', 'public');
            }

            DefectDetail::create([
                'defect_id' => $defect->id,
              
                'is_defect' => $detail['is_defect'] ?? null,
                'note' => $detail['note'] ?? '',
                'image_path' => $imagePath
            ]);
        }

        DB::commit();

        return response()->json(['status' => true, 'message' => 'Defects saved successfully.'], 200);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['status' => false, 'message' => 'Error: '.$e->getMessage()], 500);
    }
}

}
