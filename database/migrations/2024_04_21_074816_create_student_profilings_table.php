<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
    /**
     * Run the migrations.
     */
    {
        public function up(): void
        {
            Schema::create('student_profilings', function (Blueprint $table) {
                $table->string('student_id', 11)->primary();
                $table->string('student_lrn')->nullable(false);
                $table->string('first_name')->nullable(false);
                $table->string('last_name')->nullable(false);
                $table->string('middle_name')->nullable(true);
                $table->string('extension')->nullable(true);
                $table->string('email')->nullable(true);
                $table->date('birth_date')->nullable(true);
                $table->string('birth_place')->nullable(true);
                $table->string('civil_status')->nullable(true);
                $table->string('sex_at_birth')->nullable(true);
                $table->string('citizenship')->nullable(true);
                $table->string('religion')->nullable(true);
                $table->string('region')->nullable(true);
                $table->string('province')->nullable(true);
                $table->string('city')->nullable(true);
                $table->string('barangay')->nullable(true);
                $table->string('street')->nullable(true);
                $table->string('zip_code')->nullable(true);
                $table->timestamps();
            });
    
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profilings');
    }
};