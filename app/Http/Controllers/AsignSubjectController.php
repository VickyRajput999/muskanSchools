<?php

namespace App\Http\Controllers;

use App\Models\AsignSubject;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AsignSubjectController extends Controller
{
    public function index(){
        $allsubjects = AsignSubject::select('asign_subjects.*', 'class_models.className', 'subjects.subject_name', 'users.name')
        ->leftJoin('class_models', 'class_models.id', '=', 'asign_subjects.class_id')
        ->leftJoin('subjects', 'subjects.id', '=', 'asign_subjects.subject_id')
        ->leftJoin('users', 'users.id', '=', 'asign_subjects.created_by')
        ->where('asign_subjects.status', '!=', 'Inactive')
        ->orderBy('asign_subjects.id', 'asc')
        ->get();

        $data['allsubjects'] = $allsubjects;
        return view('admin.AsignSubject.asignsbuject',$data);
    }

    public function addAsignSubject(){
        $classes = ClassModel::select('class_models.id', 'class_models.className', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'class_models.created_by')
            ->where('class_models.status', '=', 'Active')
            ->groupBy('class_models.id', 'users.id','class_models.className', 'users.name')
            ->get();

        $subjects = Subject::select('subjects.id', 'subjects.subject_name', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'subjects.created_By')
            ->where('subjects.status', '=', 'Active')
            ->groupBy('subjects.id', 'subjects.subject_name', 'users.name')
            ->get();

        return view('admin.AsignSubject.addAsignSubject',compact('classes','subjects'));
    }

    public function insert(Request $request)
    {
        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id)
            {
                $newsubject = AsignSubject::where('class_id', $request->class_id)
                    ->where('subject_id', $subject_id)
                    ->first();
                if(!empty($newsubject))
                {
                    $newsubject->status = $request->status;
                    $newsubject->save();
                }else{
                    $asign_subject = new AsignSubject();
                    $asign_subject->class_id = $request->class_id;
                    $asign_subject->subject_id  = $subject_id;
                    $asign_subject->created_by = Auth::user()->id;
                    $asign_subject->status = $request->status;
                    $asign_subject->save();
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Subject Asign to Class Successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => 'Something Went Wrong'
            ]);
        }
    }

    public function edit($id)
    {
        $encript = Crypt::decrypt($id);
        $classe_ids = AsignSubject::where('class_id',$encript)
            ->get();
        // dd($classe_ids);

        $classes = ClassModel::select('class_models.id', 'class_models.className', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'class_models.created_by')
            ->where('class_models.status', '=', 'Active')
            ->groupBy('class_models.id', 'users.id','class_models.className', 'users.name')
            ->get();

        $subjects = Subject::select('subjects.id', 'subjects.subject_name', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'subjects.created_By')
            ->where('subjects.status', '=', 'Active')
            ->groupBy('subjects.id', 'subjects.subject_name', 'users.name')
            ->get();
        return view('admin.AsignSubject.edit',compact('classes','subjects','classe_ids'));
    }


    public function update(Request $request)
    {
        $encript = $request->class_id;
        $classe_ids = AsignSubject::where('class_id',$encript)->delete();

            if(!empty($request->subject_id))
            {
                foreach($request->subject_id as $subject_id)
                {
                    $newsubject = AsignSubject::where('class_id', $request->class_id)
                        ->where('subject_id', $subject_id)
                        ->first();
                    if(!empty($newsubject))
                    {
                        $newsubject->status = $request->status;
                        $newsubject->save();
                    }else{
                        $asign_subject = new AsignSubject();
                        $asign_subject->class_id = $request->class_id;
                        $asign_subject->subject_id  = $subject_id;
                        $asign_subject->created_by = Auth::user()->id;
                        $asign_subject->status = $request->status;
                        $asign_subject->save();
                    }
                }


            }

            return response()->json([
                'status' => 'success',
                'message' => 'Subject Asign to Class Successfully'
            ]);


    }
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $asign_subject = AsignSubject::where('id',$id)
            ->where('status','=','Active')
            ->first();
        if(!empty($asign_subject))
        {
            $asign_subject->delete();

        }
        return redirect()->route('admin.asignSubject')->with('success','Record deleted Successfully');

        // dd($asign_subject);nhibhi
    }

}


