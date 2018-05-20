<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->string('slug')->default('');
            $table->string('area')->default('');
            $table->string('size')->default('');
            $table->string('price')->default('');
            $table->string('deadline')->default('');
            $table->string('videoLink')->nullable();
            $table->string('cover')->nullable()->default('');
            $table->text('images')->nullable();
            $table->boolean('isPopular')->default(false);
            $table->boolean('isActive')->default(false);
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
        Schema::dropIfExists('projects');
    }
}
