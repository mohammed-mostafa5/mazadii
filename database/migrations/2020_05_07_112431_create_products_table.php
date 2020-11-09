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
            $table->bigInteger('category_id')->unsigned();
            $table->integer('admin_id')->unsigned();
            $table->unsignedInteger('regular_price');
            $table->unsignedInteger('sale_price');
            $table->unsignedInteger('offer')->nullable();
            $table->string('photo_1')->nullable();
            $table->string('photo_2')->nullable();
            $table->string('photo_3')->nullable();
            $table->string('sku');
            $table->unsignedTinyInteger('type')->comment('0 => Food, 1 => Accessories');
            $table->string('color_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('style_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('weight_id')->nullable();
            $table->integer('views');

            // $table->string('video')->nullable();
            // $table->string('barcode')->nullable();
            // $table->tinyInteger('is_bundle')
            //     ->default(0)
            //     ->comment('0 => Inactive, 1 => Active');

            $table->unsignedTinyInteger('status')
                ->default(0)
                ->comment('0 => Inactive, 1 => Active');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });



        Schema::create('product_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->longText('description');

            $table->unique(['product_id', 'locale']);
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
        Schema::drop('product_translations');
        Schema::drop('products');
    }
}
