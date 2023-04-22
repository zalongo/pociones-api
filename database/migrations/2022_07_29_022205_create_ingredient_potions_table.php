<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientPotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_potions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('potion_id')->index();
            $table->foreign('potion_id')->references('id')->on('potions');

            $table->unsignedBigInteger('ingredient_id')->index();
            $table->foreign('ingredient_id')->references('id')->on('ingredients');

            $table->float('quantity')->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_potions');
    }
}
