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
        Schema::create('asign_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('class_models');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->string('created_by');
            $table->enum('status',['Active','Inactive']);
            $table->enum('is_delete',['Yes','No'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asign_subjects');
    }
};
