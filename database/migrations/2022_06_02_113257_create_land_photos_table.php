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
        Schema::create('land_photos', function (Blueprint $table) {
            $table->id();
            $table->ForeignIdFor(Land::class, 'land_id');
            $table->string('caption', 255)->nullable();
            $table->string('filepath', 255);
            $table->string('compressed', 255);
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
        Schema::dropIfExists('land_photos');
    }
};
