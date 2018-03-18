<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->string('template_id')->nullable();
            $table->json('meta');
            $table->integer('section_id')->unsigned();
            $table->integer('sort')->unsigned()->nullable();
            $table->timestamps();

            $table->unique(['name', 'section_id']);

            $table->index('section_id');

        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->foreign('section_id')
                ->references('id')->on('sections')
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
        Schema::dropIfExists('lessons');
    }
}
