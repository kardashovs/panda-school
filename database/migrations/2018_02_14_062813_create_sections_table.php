<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->string('hint')->default('');
            $table->integer('level_id')->unsigned();
            $table->integer('sort')->unsigned()->nullable();
            $table->timestamps();

            $table->unique(['name', 'level_id']);
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('level_id')
                ->references('id')->on('levels')
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
        Schema::dropIfExists('sections');
    }
}
