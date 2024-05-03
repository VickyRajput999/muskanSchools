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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('student_lastName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->comment('User role (admin-1, teacher-2, student-3, parents-4)');
            $table->string('adminision_no')->unique();
            $table->string('student_roll_no')->unique();
            $table->date('adminision_date');
            $table->unsignedBigInteger('student_class_id')->constrained('class_models')->onDelete('cascade');
            $table->enum('gender',['Male','Female','Other']);
            $table->date('date_of_birth');
            $table->enum('student_caste',['General','OBC','SC','ST']);
            $table->enum('student_religion',['Hindu','Muslim','Sikh','Other']);
            $table->string('mobile_no');
            $table->string('student_image');
            $table->string('student_blood_group');
            $table->enum('is_delete',['Yes','No']);
            $table->enum('status',['Active','Inactive']);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
