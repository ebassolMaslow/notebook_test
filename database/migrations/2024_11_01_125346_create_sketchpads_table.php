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
        Schema::create('sketchpads', function (Blueprint $table) {
            $table->id();
            $table->string('FIO', 150);
            $table->string('company', 50);
            $table->string('telephone', 20);
            $table->string('email', 100);
            $table->date('date_of_birth');
            $table->string('photo', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sketchpads');
    }
};
