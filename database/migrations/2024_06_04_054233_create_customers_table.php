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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("customer_name", 100)->nullable();
            $table->string("c_image")->nullable();
            $table->string("c_phone")->nullable();
            $table->string("c_email")->nullable();
            $table->string("c_gender")->nullable();
            $table->string("c_dob")->nullable();
            $table->string("address")->nullable();
            $table->tinyInteger("status")->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
