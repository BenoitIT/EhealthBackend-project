<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('test_id')->nullable();
            $table->unsignedBigInteger('medecine_id');
            $table->timestamps();
            $table->foreign('patient_id')->references('id')
            ->on('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('doctor_id')->references('id')
            ->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hospital_id')->references('id')
            ->on('hospitals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('medecine_id')->references('id')
            ->on('medecines')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_reports');
    }
};
