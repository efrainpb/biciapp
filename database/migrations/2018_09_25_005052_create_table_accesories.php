<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccesories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bicycle_accessories',function(Blueprint $table) {
            $table->increments('id');
            $table->char('sku', 10)->unique();
            $table->string('description');
            /*Foreign Key*/
            $table->integer('category_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->integer('producer_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('producer_id')->references('id')->on('producers');
        });

        Schema::create('images',function(Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->integer('accessory_id')->unsigned();

            $table->foreign('accessory_id')->references('id')->on('bicycle_accessories');
        });

        Schema::create('pdfs',function(Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->integer('accessory_id')->unsigned();

            $table->foreign('accessory_id')->references('id')->on('bicycle_accessories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('pdfs');
        Schema::dropIfExists('images');
        Schema::dropIfExists('bicycle_accessories');
    }
}
