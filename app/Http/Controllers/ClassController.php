<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::orderBy('id','desc')->take(5)->get();
        return view('admin.class.class',compact('classes'));
    }

    public function addClass()
    {
        return view('admin.class.addClass');
    }

    public function insertClass(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'class' => 'required|unique:class_models,className',
            'status' => 'required'
        ]);

        if($validator->passes())
        {
            $class = new ClassModel();
            $class->className = $request->class;
            $class->status = $request->status;
            $class->created_by = Auth::user()->id;
            $class->save();

            return response()->json([
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function edit($id, Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $class = ClassModel::where('id',$id)->first();

        $data['class'] = $class;

        if(!empty($class)){
            return view('admin.class.classupdate',$data);
        }
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $class = ClassModel::where('id',$id)->first();

        if($class)
        {
            $class->className = $request->classname;
            $class->status = $request->status;
            $class->save();

            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $class = ClassModel::where('id',$id)->first();
        $class->delete();

        return redirect()->route('admin.class');

    }
}
