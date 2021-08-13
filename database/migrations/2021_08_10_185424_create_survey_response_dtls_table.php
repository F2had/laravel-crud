<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResponseDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_response_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hdr_id');
            $table->foreign('hdr_id')->references('id')->on('survey_response_hdrs')->onDelete('cascade');
            $table->unsignedBigInteger('survey_dtl_id');
            $table->foreign('survey_dtl_id')->references('id')->on('survey_template_dtls')->onDelete('cascade');
            $table->text('question');
            $table->unsignedBigInteger('answer_type');
            $table->unsignedBigInteger('response')->nullable()->change();
            $table->text('response_detail')->nullable()->change();
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
        Schema::dropIfExists('survey_response_dtls');
    }
}
