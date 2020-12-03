<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->bigInteger('category_id')->unsigned();
            $table->string('code');
            $table->unsignedInteger('start_bid_price');
            $table->unsignedInteger('min_bid_price');
            $table->unsignedInteger('watched_count');
            $table->timestamp('start_at');

            $table->unsignedTinyInteger('status')
                ->default(0)
                ->comment('0 => Not Approved, 1 => Active, 2 => Pending, 3 => Finished');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });


        Schema::create('product_gallery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('photo');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_gallery');
        Schema::drop('product_translations');
        Schema::drop('products');
    }
}
