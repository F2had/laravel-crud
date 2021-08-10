<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyTemplateDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_template_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hdr_id');
            $table->foreign('hdr_id')->references('id')->on('survey_template_hdrs')->onDelete('cascade');
            $table->unsignedBigInteger('sequence');
            $table->text('question');
            $table->unsignedBigInteger('answer_type');
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
        Schema::dropIfExists('survey_template_dtls');
    }
}
