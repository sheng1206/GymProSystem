<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('member_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('trainer_id')->constrained()->onDelete('cascade');
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('bmi')->nullable();
            $table->text('notes')->nullable();
            $table->date('progress_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_progress');
    }
};