<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResponseHdrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_response_hdrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->char('name');
            $table->char('email');
            $table->unsignedBigInteger('survey_hdr_id');
            $table->foreign('survey_hdr_id')->references('id')->on('survey_template_hdrs')->onDelete('cascade');
            $table->char('survey_code', 40);
            $table->char('survey_description');
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
        Schema::dropIfExists('survey_response_hdrs');
    }
}
