<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEnroll extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static function check()
    {
        $student = self::where('student_email',request()->student_email)->first();
        return $student;
    }
}
