<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id('cases_id');
            $table->string('student_id', 11)->nullable();
            $table->foreign('student_id')->references('student_id')->on('student_profilings')->onDelete('cascade');
            $table->string('case_title', 255)->nullable();
            $table->string('case_description', 255);
            $table->string('case_sanction', 255);
            $table->enum('case_status',['Cleared', 'Not Cleared']);
            $table->date('case_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
