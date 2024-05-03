<?php

namespace App\Http\Controllers;

use App\Mail\FORGETPASSWORDEMAIL;
use App\Mail\MarkdownExample;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Mail\Markdown;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authLogin(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:6|max:8'
    ]);

    if ($validator->passes()) {
        $remember = !empty($request->remember) ? true : false;

        if (FacadesAuth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = FacadesAuth::user();
            $userRole = $user->role;

            switch ($userRole) {
                case 1:
                    return response()->json([
                        'status' => 'success',
                        'message' => "Admin Login Successfully",
                        'redirect' => route('admin.dashboard')
                    ]);
                    break;
                case 2:
                    return response()->json([
                        'status' => 'success',
                        'message' => "Teacher Login Successfully",
                        'redirect' => route('teacher.dashboard')
                    ]);
                    break;
                case 3:
                    return response()->json([
                        'status' => 'success',
                        'message' => "Student Login Successfully",
                        'redirect' => route('student.dashboard')
                    ]);
                    break;
                case 4:
                    return response()->json([
                        'status' => 'success',
                        'message' => "Parent Login Successfully",
                        'redirect' => route('parents.dashboard')
                    ]);
                    break;
                default:
                        // return view('auth.login');
                    break;
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Invalid email or password."
            ]);
        }
    } else {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()->first()
        ]);
    }
}

    public function forgetPassword()
    {
        return view('auth.forgetpassword');
    }

    public function forget(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email'
        ]);

        if($validator->passes())
        {
            $user = User::where('email', $request->email)->first();
            if($user)
            {
                $user->remember_token = Str::random(30);
                $user->save();
                Mail::to($user->email)->send(new MarkdownExample($user));

                return response()->json([
                    'status' => 'success',
                    'message' => 'Please Check Your Email And Reset Your Password'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found' // Provide a clearer message
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function reset($remember_token)
    {

        $token = User::where('remember_token',$remember_token)->first();
        if(!empty($token))
        {
            return view('auth.reset',compact('token'));
        }else{
            abort(404);
        }

    }
    public function resetPassword(Request $request)
    {
        $remember_token = $request->token;
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:8',
            'cpassword' => 'required|same:password'
        ]);

        if ($validator->passes()) {
            $user = User::where('remember_token', $remember_token)->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found' // or appropriate error message
                ]);
            }

            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password Reset Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }


    public function logout()
    {
        FacadesAuth::logout();
        return redirect()->route('login');
    }

}
