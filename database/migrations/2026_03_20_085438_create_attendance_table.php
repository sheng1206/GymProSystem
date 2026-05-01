<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            // Link to members table
            $table->foreignId('member_id')
                ->constrained('members')
                ->cascadeOnDelete();

            // Attendance timestamps
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};