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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->required();
            $table->tinyInteger('rooms')->required();
            $table->tinyInteger('beds')->required();
            $table->tinyInteger('bathrooms')->required();
            $table->integer('square_meters')->required();
            $table->string('address', 150)->required();
            $table->string('image', 200)->required();
            $table->float('longitude', 4, 2)->required();
            $table->float('latitude', 4, 2)->required();
            $table->tinyInteger('visibility')->required()->default(0);
            $table->string('slug')->required();
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
        Schema::dropIfExists('apartments');
    }
};
