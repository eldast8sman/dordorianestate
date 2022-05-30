<?php

use App\Models\Land;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_videos', function (Blueprint $table) {
            $table->id();
            $table->ForeignIdFor(Land::class, 'land_id');
            $table->string('platform', 500);
            $table->string('caption', 255);
            $table->string('link', 1000);
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
        Schema::dropIfExists('land_videos');
    }
};
