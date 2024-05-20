<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StudentProfiling;
use App\Models\User;
use App\Models\Image;
use App\Models\Registrar\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Validator;

class StudentProfilingController extends Controller
{
    public function index() {
        $student = StudentProfiling::with([
            'adviser' => function($query) {
                $query->select('student_id', \DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS full_name"), 'department');
            },
        ])->get();
        $data = [
            'status'=>200,
            'student'=>$student
        ];
        return response()->json($data, 200);

    }

    public function indexId($id) {
        $student = StudentProfiling::find($id);
        $data = [
            'status'=>200,
            'student'=>$student
        ];
        return response()->json($data, 200);

    }


    public function upload(Request $request) {
        $request->merge(['enrollment_status' => 'ENROLLED']);
        $validator = Validator::make($request->all(),[
            'password'=>'required|string|min:6',
            'student_lrn'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'extension'=>'',
            'sex_at_birth'=>'required',
            'birth_date'=>'required|date',
            'region'=>'required',
            'province'=>'required',
            'city'=>'required',
            'barangay'=>'required',
            'street'=>'required',
            'zip_code'=>'required',
            'contact_no'=>'required',
            'year' => 'required',
            'grade_level' => 'required',
            'religion'=>'required',
            'guardian'=>'required',
            'guardian_mobileno'=>'required',
            'strand'=>'required',
            'section'=>'required',
            'adviser_id'=>'required',
        ]);
    
        if ($validator->fails()) {
            $data = [
                "status"=>422,
                "message"=>$validator->messages()
            ];
            return response()->json($data, 422);
        }
    
        $email = $request->student_lrn . '@sna.edu.ph';
    
        // Check if the email already exists
        if (User::where('email', $email)->exists()) {
            $data = [
                "status"=>422,
                "message"=>"The email address already exists."
            ];
            return response()->json($data, 422);
        }
    
        $hashedPassword = Hash::make($request->password);
    
        $user = User::create([
            'name' => $request->first_name,
            'email' => $email,
            'password' => $hashedPassword,
        ]);
    
        $student = new StudentProfiling();
        $image = new Image();
        $student->fill($request->all());


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile', $filename);
            $student->image = $filename;
            $image->image = $filename;
        } else {
            
            $student->image = '';
        }
        
        $image->student_id = $student->student_id = $user->id;
        $student->adviser_id = $request->adviser_id;
        

        $student->save();
        $image->save();
        
        
        $data = [
            "status" => "200",
            "message" => "Student Profile Uploaded Successfully"
        ];
    
        return response()->json($data, 200);
    }
    
    public function edit(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'student_lrn'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'extension'=>'',
            'contact_no'=>'required',
            'email'=>'required|email',
            'birth_date'=>'required|date',
            'birth_place'=>'required',

            'sex_at_birth'=>'required',
            'citizenship'=>'required',
            'religion'=>'required',
            'region'=>'required',
            'province'=>'required',
            'city'=>'required',
            'barangay'=>'required',
            'street'=>'required',
            'zip_code'=>'required'
        ]);

        if($validator->fails()) {

            $data = [
                "status"=>422,
                "message"=>$validator->messages()
            ];

            return response()->json($data,422);
        }

        else {
            $student = StudentProfiling::find($id);
            $student->student_lrn=$request->student_lrn;
            $student->first_name=$request->first_name;
            $student->last_name=$request->last_name;
            $student->middle_name=$request->middle_name;
            $student->extension=$request->extension;
            $student->contact_no=$request->contact_no;
            //$student->email=$request->email;
            $student->birth_date=$request->birth_date;
            $student->civil_status=$request->civil_status;
            $student->sex_at_birth=$request->sex_at_birth;
            $student->citizenship=$request->citizenship;
            $student->religion=$request->sreligion;
            $student->region=$request->region;
            $student->province=$request->province;
            $student->city=$request->city;
            $student->barangay=$request->barangay;
            $student->street=$request->street;
            $student->zip_code=$request->zip_code;

            $student->save();

            $data = [
                "status"=>"200",
                "message"=>"Student Profile Updated Successfully"
            ];

            return response()->json($data,200);
            
        }
    }

    public function delete($id) {
        $student = StudentProfiling::find($id);
        $student->delete();

        $data = [
            "status" => "200",
            "message" => "Student Profile Deleted Successfully"
        ];

        return response()->json($data,200);
    }
}