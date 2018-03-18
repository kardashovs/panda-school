<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->string('description')->default('');
            $table->string('image')->default('');
            $table->integer('language_id')->unsigned();
            $table->integer('sort')->unsigned()->nullable();
            $table->boolean('paid')->default(false);
            $table->timestamps();

            $table->unique(['name', 'language_id']);


        });

        Schema::table('levels', function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('id')->on('languages')
                ->onDelete('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
}
