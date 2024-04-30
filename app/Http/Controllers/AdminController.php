<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function list()
    {
        $users = User::orderBy('id', 'desc')->take(5)->get();

        return view('admin.admin.list', compact('users'));
    }

    public function addNewUser()
    {
        return view('admin.admin.adduser');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
            'password' => 'required|min:6|max:8'
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->roles;
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(40);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User Created Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $user = User::where('id', $id)->first();

        if(!empty($user))
        {
            return view('admin.admin.update', compact('user'));
        }
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $user = User::where('id',$id)->first();

        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        if($validator->passes())
        {
            if ($user) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role = $request->roles;
                $user->save();

                return response()->json([
                    'status' => 'success',
                ]);
            }else{
                return response()->json([
                    'status' => false
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
        $encpid = Crypt::decrypt($id);
        $user = User::where('id', $encpid)->first();
        $user->is_deleted = 1;
        $user->delete();

        return redirect()->route('admin.list');
    }



}
