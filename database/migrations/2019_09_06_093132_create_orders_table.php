<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customers_id')->unsigned()->nullable();
            $table->string('customers_name',100);
            $table->integer('customers_gender');
            $table->string('customers_address',255);
            $table->string('customers_phone',50);
            $table->string('customers_email',100);
            $table->integer('amount')->unsigned();
            $table->string('payment',50);
            $table->text('note');
            $table->boolean('status')->default(false);
            $table->date('date_order');
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
        Schema::dropIfExists('orders');
    }
}
