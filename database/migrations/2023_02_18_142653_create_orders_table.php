<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
			$table->timestamps();
			$table->string('first_name', 191);
			$table->string('last_name', 191);
			$table->string('company_name', 191);
			$table->integer('governorate_id');
			$table->string('address', 191);
			$table->string('city', 191);
			$table->string('country_state', 191);
			$table->string('post_code', 191);
			$table->string('phone', 191);
			$table->string('email', 191);
			$table->text('notes');
			$table->float('sub_total')->nullable();
			$table->float('total')->nullable();
			$table->integer('client_id');

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
};
