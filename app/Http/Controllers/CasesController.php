<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CasesController extends Controller
{
    public function index()
    {
        $cases = Cases::with([
            'student'
        ])->get();
        return response()->json(['cases' => $cases], 200);
    }

    public function caseStatusUpdate($id){
        $cases = Cases::find($id);
        $cases->cases_status = $id;
        $cases->save();
        $data = [
            "code" => 200,
            "data" => $cases
        ];
        return response()->json($data, 200);
    }
    

    public function store(Request $request)
    {
        $rules = [
            'case_title' => 'required|string|max:255',
            
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $now = Carbon::now();
        
        $requestData = $request->all();
        $requestData['created_at'] = $now;
        $requestData['updated_at'] = $now;

        $case = Cases::create($requestData);
        return response()->json(['case' => $case], 201);
    }

    public function show($id)
    {
        $case = Cases::findOrFail($id);
        return response()->json(['case' => $case], 200);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'case_title' => 'required|string|max:255',
            
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $now = Carbon::now();
        $requestData = $request->all();
        $requestData['updated_at'] = $now;

        $case = Cases::findOrFail($id);
        $case->update($requestData);
        return response()->json(['case' => $case], 200);
    }

    public function destroy($id)
    {
        $case = Cases::findOrFail($id);
        $case->softDelete();
        return response()->json(null, 204);
    }

    public function archive()
    {
        // $case = new Cases();
        // $cases->cases_id = $id;
        echo($id);
        // $case->softDelete();
        // return response()->json(null, 204);
    }
}
