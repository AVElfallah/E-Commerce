<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingCostTable extends Migration {

	public function up()
	{
		Schema::create('shipping_cost', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('governorate_id');
			$table->float('cost')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('shipping_cost');
	}
}