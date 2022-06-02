<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 500);
            $table->string('state', 500);
            $table->string('lga', 500);
            $table->string('area', 500);
            $table->longText('description');
            $table->text('facilities');
            $table->string('size');
            $table->integer('available_plots');
            $table->double('price');
            $table->string('filepath', 255);
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
        Schema::dropIfExists('lands');
    }
};
