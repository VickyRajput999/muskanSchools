<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_enrolls', function (Blueprint $table) {
            $table->id();
            $table->string('student_firstName');
            $table->string('student_lastName');
            $table->unsignedBigInteger('adminision_no')->unique();
            $table->unsignedBigInteger('student_roll_no')->unique();
            $table->date('adminision_date');
            $table->string('student_class');
            $table->enum('gender',['Male','Female']);
            $table->date('date_of_birth');
            $table->string('student_caste');
            $table->string('student_religion');
            $table->string('mobile_no');
            $table->string('student_image');
            $table->string('student_blood_group');
            $table->string('student_height');
            $table->string('student_weight');
            $table->string('student_email')->unique();
            $table->string('student_password');
            $table->enum('is_delete',['Yes','No']);
            $table->enum('status',['Active','Inactive']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enrolls');
    }
};
