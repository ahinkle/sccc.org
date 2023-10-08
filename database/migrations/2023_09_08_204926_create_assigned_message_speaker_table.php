<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assigned_message_speaker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained();
            $table->foreignId('speaker_id')->constrained('people');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assigned_message_speaker');
    }
};
