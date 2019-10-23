<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommExtServiceExtServiceManWorkPrivatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comm_ext_service_ext_service_man_work_privates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->year('inclusive_years_from')->nullable();
            $table->year('inclusive_years_to')->nullable();
            $table->string('title')->nullable();
            $table->string('position')->nullable();
            $table->integer('validate')->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('user_id', 'man_work_privates_user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comm_ext_service_ext_service_man_work_privates');
    }
}
