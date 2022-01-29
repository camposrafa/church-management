<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->index()->nullable();
            $table->date('birth_date')->nullable();
            $table->string('cpf', 13)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('neighborhood', 150)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('number', 5)->nullable();
            $table->string('postal_code', 20);
            $table->string('father_name', 150)->nullable();
            $table->string('mother_name', 150)->nullable();
            $table->string('spouse', 150)->nullable();
            $table->date('wedding_date', 150)->nullable();
            $table->string('qtty_sons', 150)->nullable();
            $table->bigInteger('civil_state_id')->unsigned()->index();
            $table->foreign('civil_state_id')->references('id')->on('civil_states');
            $table->bigInteger('picture_id')->unsigned()->index();
            $table->foreign('picture_id')->references('id')->on('files');
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
        Schema::dropIfExists('members');
    }
}
