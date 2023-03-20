<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
	{
		Schema::create('carts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id');
            $table->integer('product_color_id');
            $table->integer('product_size_id');
			$table->integer('quantity');
			$table->float('price');
			$table->float('sub_total');
			$table->integer('client_id');
		});
	}

	public function down()
	{
		Schema::drop('carts');
	}
};
