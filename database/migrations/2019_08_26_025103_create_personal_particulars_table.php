<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_particulars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index()->unsigned();
            $table->string('image')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fullname');
            $table->integer('age');
            $table->string('place_birth');
            $table->integer('sex');
            $table->string('religion');
            $table->string('occupation');
            $table->char('address');
            $table->bigInteger('telephone');
            $table->bigInteger('mobilephone')->unique();
            $table->string('email')->unique();
            $table->date('birth');
            $table->string('citizenship');
            $table->string('marital_status');
            $table->string('spouse')->nullable();
            $table->text('names_ages_of_children')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_particulars');
    }
}
