<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $userRole = $user->role;

        $data['title'] = 'Dashboard';

        switch ($userRole)
        {
            case 1:
                return view('admin.dashboard',$data);
            break;
            case 2:
                return view('teacher.dashboard',$data);
            break;
            case 3:
                return view('student.dashboard',$data);
            break;
            case 4:
                return view('parents.dashboard',$data);
            default :
                // return view('auth.login');
            break;
        }
    }

    public function list()
    {
        return view('admin.admin.list');
    }
}
