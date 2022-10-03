<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->id();
            $table->datetime('seen_since')->nullable();
            $table->date('expiration');
            $table->text('additional_instructions')->nullable();
            $table->boolean('concluded');
            $table->bigInteger('document_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('instruction_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('instruction_id')->references('id')->on('instructions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turns');
    }
}
