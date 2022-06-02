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
        Schema::create('land_installments', function (Blueprint $table) {
            $table->id();
            $table->ForeignIdFor(Land::class, 'land_id');
            $table->integer('duration_type');
            $table->string('duration');
            $table->string('percentage');
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
        Schema::dropIfExists('land_installments');
    }
};
