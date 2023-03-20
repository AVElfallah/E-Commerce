<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderItemTable extends Migration {

	public function up()
	{
		Schema::create('order_item', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('product_id');
            $table->integer('product_color_id');
            $table->integer('product_size_id');
			$table->integer('quantity');
			$table->float('price');
			$table->float('sub_total');
			$table->timestamps();
			
		});
	}

	public function down()
	{
		Schema::drop('order_item');
	}
}