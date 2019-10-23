<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchCreativeWorksScholarProducResearchPostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_creative_works_scholar_produc_research_posters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('nature_of_publication')->nullable();
            $table->date('date_publication')->nullable();
            $table->string('role_comments')->nullable();
            $table->integer('validate')->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('user_id', 'produc_research_posters_user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_creative_works_scholar_produc_research_posters');
    }
}
