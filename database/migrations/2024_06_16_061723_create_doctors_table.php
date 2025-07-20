<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();  // This is automatically unsigned in Laravel
            $table->string('name');
            $table->string('specialization');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Ensure the `user_id` is referencing a valid users table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}

