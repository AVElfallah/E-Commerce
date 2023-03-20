<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('footer_desc', 191);
			$table->string('fb_link', 191);
			$table->string('insta_link', 191);
			$table->string('tw_link', 191);
			$table->string('you_link', 191);
			$table->string('wha_link', 191);
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}