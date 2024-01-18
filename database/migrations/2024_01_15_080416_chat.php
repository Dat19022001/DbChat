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
        Schema::create('Chat', function (Blueprint $table) {
            $table->id();
            $table->string("idChat");
            $table->string("idSent");
            $table->string("idReceived");
            $table->string("content");
            $table->unsignedBigInteger('date_sent')->nullable();
            $table->unsignedBigInteger('date_received')->nullable();
            $table->unsignedBigInteger('date_read')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
