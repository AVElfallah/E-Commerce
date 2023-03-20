<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('name', 191);
			$table->longText('description', 191);
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}