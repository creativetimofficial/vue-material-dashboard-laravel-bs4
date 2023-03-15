<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandPriceLinkProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_price_link_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('brands_id');
            $table->unsignedInteger('products_id');
            $table->float('price');
            $table->string('product_url');
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
        Schema::dropIfExists('brand_price_link_product');
    }
}
