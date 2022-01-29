<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MemberOccupation;

class CreateMemberOccupationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_occupation', function (Blueprint $table) {
            $table->bigInteger('member_id')->unsigned()->index();
            $table->bigInteger('occupation_id')->unsigned()->index();
            $table->unique(['member_id', 'occupation_id']);
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('occupation_id')->references('id')->on('occupations');
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
        Schema::dropIfExists('member_occupation');
    }
}
