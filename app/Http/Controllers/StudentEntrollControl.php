<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentEntrollControl extends Controller
{
    public function index()
    {
        return view('admin.student.student');
    }

    public function addStudent()
    {
        return view('admin.student.enrollstudent');
    }
}
