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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Store user IDs as numbers            $table->string('type'); // 'car' or 'motor'
            $table->string('status')->default('Pending');
            $table->string('license');
            $table->string('type');
            $table->string('ghana_card');
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->string('plate');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
