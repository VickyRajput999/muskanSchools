<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:8'
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();   
                $userRole = $user->role;             
                $token = $user->createToken('API Token')->plainTextToken;
                
                switch($userRole){
                    case 1:
                        return response()->json([
                            'status' => 'success',
                            'message' => 'User Login Successfully',
                            'token' => $token,
                            'user' => [
                                'id' => $user->id,
                                'email' => $user->email,
                                'role' => $userRole
                            ],
                        ]);
                    break;    
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid email or password.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
    }
    
}
