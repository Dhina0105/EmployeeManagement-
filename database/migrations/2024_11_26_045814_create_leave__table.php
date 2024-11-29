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
        Schema::create('leave_', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // Foreign key
                $table->date('start_date'); // Leave start date
                $table->date('end_date'); // Leave end date
                $table->enum('leave_type', ['casual leave', 'loss of pay', 'medical leave']);
                $table->text('reason')->nullable(); // Reason for leave
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_');
    }
};
