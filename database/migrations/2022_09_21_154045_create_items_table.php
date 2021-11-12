<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("year");
            $table->string("description");
            $table->integer("price");
//            $table->string("option");
//            $table->string("rental_option")->nullable();
            $table->unsignedBigInteger('option_id');
            $table->foreign('option_id')->references("id")->on('options');
            $table->unsignedBigInteger('rent_id');
            $table->foreign('rent_id')->references("id")->on('rents');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references("id")->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
//            $table->bigInteger('srok');
            $table->dateTime('srok');
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
        Schema::dropIfExists('items');
    }
}
