<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('appointment_date');
            $table->timestamp('start_time');
            $table->string('status');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('bussiness_id')->constrained('bussinesses');
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('service_id')->constrained('services');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
