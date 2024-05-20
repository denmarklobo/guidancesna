<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ExaminationController extends Controller
{
    public function index()
    {
        $examinations = Examination::all();
        return response()->json(['examinations' => $examinations], 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'exam_title' => 'required|string|max:255',
           
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $now = Carbon::now();
        $requestData = $request->all();
        $requestData['created_at'] = $now;
        $requestData['updated_at'] = $now;

        $examination = Examination::create($requestData);
        return response()->json(['examination' => $examination], 201);
    }

    public function show($id)
    {
        $examination = Examination::findOrFail($id);
        return response()->json(['examination' => $examination], 200);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'exam_title' => 'required|string|max:255',
            
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $now = Carbon::now();
        $requestData = $request->all();
        $requestData['updated_at'] = $now;

        $examination = Examination::findOrFail($id);
        $examination->update($requestData);
        return response()->json(['examination' => $examination], 200);
    }

    public function destroy($id)
    {
        $examination = Examination::findOrFail($id);
        $examination->delete();
        return response()->json(null, 204);
    }
}
