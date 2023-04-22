<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotionSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potion_sales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('potion_id')->index();
            $table->foreign('potion_id')->references('id')->on('potions');

            $table->unsignedBigInteger('sale_id')->index();
            $table->foreign('sale_id')->references('id')->on('sales');

            $table->integer('quantity');
            $table->integer('total')->default(0);

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
        Schema::dropIfExists('potion_sales');
    }
}
