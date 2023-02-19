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
        Schema::create('apartment_promotion', function (Blueprint $table) {
            $table->id('ponte_promotion_id');

            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments');

            $table->unsignedBigInteger('promotion_id');
            $table->foreign('promotion_id')->references('id')->on('promotions');

            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_promotion');
    }
};
