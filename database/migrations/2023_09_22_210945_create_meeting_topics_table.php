<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meeting_topics', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->unique();
            $table->string('slug')
                ->unique()
                ->index();
            $table->foreignId('updated_by_id')
                ->constrained('users');
            $table->timestamps();
        });
    }
};
