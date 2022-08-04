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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('province');
            $table->string('district');
            $table->string('Gender');
            $table->date('BirthDate');
            $table->integer('Telephone');
            $table->unsignedBigInteger('assigned_doctor');
            $table->unsignedBigInteger('hospital_id');
            $table->foreign('assigned_doctor')->references('id')->on('doctors');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
