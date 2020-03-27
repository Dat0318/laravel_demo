<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('categories_id')->unsigned();
            $table->string('name',100);
            $table->string('slug',100);
            $table->integer('unit_price')->unsigned();
            $table->integer('promotion_price')->unsigned();
            $table->string('unit',50);
            $table->text('image');
            $table->text('detail_description');
            $table->text('description');
            $table->boolean('status')->default(false);
            $table->integer('quantity')->unsigned();
            $table->boolean('delete_flag')->default(false);
            $table->timestamp('delete_at')->nullable();
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
        Schema::dropIfExists('products');
    }
}
