<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardsTable extends Migration {

	public function up()
	{
		Schema::create('cards', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('title', 191);
			$table->longText('description', 191);
		});
	}

	public function down()
	{
		Schema::drop('cards');
	}
}