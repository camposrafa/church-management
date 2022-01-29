<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChurchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->string('denomination', 150)->index();
            $table->string('cnpj', 15)->index();
            $table->string('phone', 20)->nullable();
            $table->string('responsible_name', 150)->nullable();
            $table->string('responsible_phone', 20)->nullable();
            $table->string('address', 150)->index();
            $table->string('number', 5)->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('zip_code', 20);
            $table->BigInteger('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->BigInteger('state_id')->unsigned()->index();
            $table->foreign('state_id')->references('id')->on('states');
            $table->BigInteger('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('types');
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
        Schema::dropIfExists('churches');
    }
}
