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
        //
        Schema::create("RoomChats",function(Blueprint $table){
            $table->id();
            $table->string('idUser');
            $table->string('idFriend');
            $table->timestamps();

            // Đặt các khóa ngoại nếu cần
            $table->foreign('idUser')->references('idUser')->on('Users');
            $table->foreign('idFriend')->references('idUser')->on('Users');
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
