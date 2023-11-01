<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->bigInteger('elexio_id')->after('ends_at')->nullable();
            $table->string('elexio_batch_id')->index()->after('elexio_id')->nullable();
            $table->datetime('elexio_updated_at')->after('elexio_batch_id')->nullable();
        });
    }
};
