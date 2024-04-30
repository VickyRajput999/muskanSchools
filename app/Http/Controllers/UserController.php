<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('profile.changepassword');
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        $user = Auth::user();
        // dd($user);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ]);
        }
        // dd($request->oldpassword, $user->password);
        if (Hash::check($request->oldpassword, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'The current password is incorrect.'
            ]);
        }
    }
}
