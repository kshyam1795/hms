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
        
        Schema::create('services', function (Blueprint $table) {
            $table->id();  // This creates an unsigned BIGINT field as 'id'
            $table->string('name', 200);  // Corresponds to `name` varchar(200) NOT NULL
            $table->integer('price');  // Corresponds to `price` int(11) NOT NULL
            $table->integer('gst')->nullable();  // Corresponds to `gst` int(10) DEFAULT NULL
            $table->string('code', 20)->nullable();  // Corresponds to `code` varchar(20) DEFAULT NULL
            $table->integer('priority')->nullable();  // Corresponds to `priority` int(20) DEFAULT NULL
            $table->string('service_owner', 255)->nullable();  // Corresponds to `service_owner` varchar(255) DEFAULT NULL
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
