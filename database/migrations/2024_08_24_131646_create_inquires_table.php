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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('contact_number');
            $table->string('patient_name');
            $table->date('date');
            $table->text('inquiry');
            $table->string('payment_method')->nullable(); // Nullable field
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquires');
    }
};
