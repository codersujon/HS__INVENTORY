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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name', 100);
            $table->string('contact_person', 60);
            $table->string('mobile_no', 11);
            $table->string('email')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
