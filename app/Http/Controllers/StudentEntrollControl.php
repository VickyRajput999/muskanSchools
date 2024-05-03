<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\StudentEnroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class StudentEntrollControl extends Controller
{
    public function index()
    {
        $students = User::latest()->get();
        $classes = ClassModel::where('status', '!=', 'Inactive')->get();
        $data['classes'] = $classes;
        $data['students'] = $students;
        return view('admin.student.student', $data);
    }

    public function addStudent()
    {
        $classes = ClassModel::where('status', '!=', 'Inactive')->get();
        $data['classes'] = $classes;
        return view('admin.student.enrollstudent', $data);
    }

    //Student Login Page//
    public function studentlogin()
    {
        return view('admin.student.studentLogin');
    }

    //Student Login//
    // public function authStudentLogin(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'student_email' => 'required|email',
    //         'student_password' => 'required|min:6|max:8'
    //     ]);

    //     if ($validator->passes()) {

    //         $student = StudentEnroll::where('student_email', $request->student_email)->first();
    //         if ($student )
    //         {
    //             if(Hash::check($request->student_password, $student->student_password))
    //             {
    //                 return response()->json([
    //                     'status'=> 'success',
    //                     'redirect'=> route('student.dashboard'),
    //                     'message' => 'Student Login Successfully'
    //                 ]);
    //             }
    //         } else {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => $validator->errors()
    //             ]);
    //         }
    //     }
    // }

    //Student Enroll//
    public function insertStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'adminision_no' => 'required',
            'roll_no' => 'required',
            'adminssion_date' => 'required',
            'student_class' => 'required',
            'gender' => 'required',
            'student_dob' => 'required',
            'caste' => 'required',
            'Religion' => 'required',
            'student_mobile' => 'required',
            'student_blood_group' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:8',
            'status' => 'required',
            'student_image' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        if ($validator->passes()) {
            if ($request->hasFile('student_image')) {
                $imageName = time() . '_' . $request->file('student_image')->getClientOriginalName();
                $request->file('student_image')->move(public_path('StudentImage'), $imageName);
                $image = '/StudentImage/' . $imageName;
            } else {
                // $image = '/default-image.jpg';
            }

            $student_enroll = new User();
            $student_enroll->name = $request->name;
            $student_enroll->student_lastName = $request->last_name;
            $student_enroll->adminision_no  = $request->adminision_no;
            $student_enroll->student_roll_no  = $request->roll_no;
            $student_enroll->adminision_date  = $request->adminssion_date;
            $student_enroll->student_class_id  = $request->student_class;
            $student_enroll->gender  = $request->gender;
            $student_enroll->date_of_birth  = $request->student_dob;
            $student_enroll->student_caste  = $request->caste;
            $student_enroll->student_religion  = $request->Religion;
            $student_enroll->mobile_no  = $request->student_mobile;
            $student_enroll->student_blood_group  = $request->student_blood_group;
            $student_enroll->email  = $request->email;
            $student_enroll->password   = Hash::make($request->password);
            $student_enroll->status   = $request->status;
            $student_enroll->student_image = $image;
            $student_enroll->role = $request->role;
            $student_enroll->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Student Enroll Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function editStudent($id)
    {
        $id = Crypt::decrypt($id);
        $students = User::where('id', $id)->first();
        if (!empty($students)) {
            $data['students'] = $students;
            return view('admin.student.edit', $data);
        }
    }

    public function updateStudent(Request $request)
    {
        $id = $request->id;
        $student_enroll = User::where('id',$id)->first();
        // dd($student_enroll);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'adminision_no' => 'required',
            'roll_no' => 'required',
            'adminssion_date' => 'required',
            'student_class' => 'required',
            'gender' => 'required',
            'student_dob' => 'required',
            'caste' => 'required',
            'Religion' => 'required',
            'student_mobile' => 'required',
            'student_blood_group' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:8',
            'status' => 'required',
            'student_image' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);


        if ($validator->passes()) {

            $publicpath = public_path('StudentImage');

            if($request->hasFile('student_image'))
            {
                $newImage = $request->file('student_image');
                $newImageName = time().'.'.$newImage->getClientOriginalName();

                if($student_enroll->student_image)
                {
                    $oldImagePath =  $publicpath.'/'.$student_enroll->student_image;

                    if(File::exits($oldImagePath))
                    {
                        File::delete($oldImagePath);
                    }
                }
                $newImage->move($publicpath,$newImageName);
            }

            // $student_enroll = new User();
            $student_enroll->name = $request->name;
            $student_enroll->student_lastName = $request->last_name;
            $student_enroll->adminision_no  = $request->adminision_no;
            $student_enroll->student_roll_no  = $request->roll_no;
            $student_enroll->adminision_date  = $request->adminssion_date;
            $student_enroll->student_class_id  = $request->student_class;
            $student_enroll->gender  = $request->gender;
            $student_enroll->date_of_birth  = $request->student_dob;
            $student_enroll->student_caste  = $request->caste;
            $student_enroll->student_religion  = $request->Religion;
            $student_enroll->mobile_no  = $request->student_mobile;
            $student_enroll->student_blood_group  = $request->student_blood_group;
            $student_enroll->email  = $request->email;
            $student_enroll->password   = Hash::make($request->password);
            $student_enroll->status   = $request->status;
            $student_enroll->student_image = $newImageName;
            $student_enroll->role = $request->role;
            $student_enroll->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Student Enroll Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
