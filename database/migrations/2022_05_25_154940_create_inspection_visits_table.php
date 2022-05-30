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
        Schema::create('inspection_visits', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->string('phone', 20);
            $table->string('email', 500);
            $table->ForeignIdFor(Land::class, 'land_id')->nullable();
            $table->date('inspection_date');
            $table->string('inspection_time');
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
        Schema::dropIfExists('inspection_visits');
    }
};
