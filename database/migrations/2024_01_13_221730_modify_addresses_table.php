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
        Schema::table('addresses', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained();
        $table->string('street');
        $table->string('city');
        $table->string('state');
        $table->string('postal_code'); // Changed from 'zip_code' to 'postal_code'
        $table->string('country');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code'); // Changed from 'zip_code' to 'postal_code'
            $table->string('country');
        });
    }
};
