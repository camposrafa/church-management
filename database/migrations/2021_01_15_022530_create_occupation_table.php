<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('desc')->nullable();
            $table->date('date_consecration')->nullable();
            $table->string('locale_consecration', 150)->nullable();
            $table->string('consecrated_by', 150)->nullable();
            $table->date('date_conversion')->nullable();
            $table->string('locale_conversion', 150)->nullable();
            $table->date('date_baptism')->nullable();
            $table->string('locale_baptism', 150)->nullable();
            $table->date('date_admission', 150)->nullable();
            $table->string('admission_by', 150)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('occupations');
    }
}
