<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('title');
			$table->longText('description');
			$table->integer('category_id');
			$table->integer('quantity');
			$table->float('price');
			$table->float('tax');
			$table->float('price_after_tax', 191);
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}