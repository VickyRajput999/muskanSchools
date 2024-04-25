<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('id','DESC')->take(5)->get();
        $data['subjects'] = $subjects;

        // dd($subjects);
        return view('admin.subject.subject',$data);
    }

    public function addSubject()
    {
        return view('admin.subject.addsubject');
    }

    public function  insertSubject(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'subjectname' => 'required|unique:subjects,subject_name',
            'type' => 'required',
            'status' => 'required'
        ]);

        if($validator->passes())
        {
            $subject = new Subject();
            $subject->subject_name = $request->subjectname;
            $subject->type = $request->type;
            $subject->status = $request->status;
            $subject->created_By = Auth::user()->id;
            $subject->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Subject Created Successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $subject = Subject::where('id',$id)->first();

        $data['subject'] = $subject;
        if($subject)
        {
            return view('admin.subject.sbujectupdate',$data);
        }
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $subject = Subject::where('id',$id)->first();

        $validator = Validator::make($request->all(),[
            'subjectname' => 'required|unique:subjects,subject_name',
        ]);

        if($validator->passes()){
            if($subject){
                $subject->subject_name = $request->subjectname;
                $subject->type = $request->type;
                $subject->status = $request->status;
                $subject->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Record Updated Successfully'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'error' => 500
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $subject = Subject::where('id',$id)->first();
        $subject->delete();
        return redirect()->route('admin.subject');
    }
}
