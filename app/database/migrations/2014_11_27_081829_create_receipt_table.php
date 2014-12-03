<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('receipts', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('user_id');
			$table->integer('client_id');
			$table->string('receipt_number', 50);
			$table->string('receive_from', 50);
			$table->string('given_to',50);
			$table->text('content_json');
			$table->timestamps();
			$table->softDeletes();

			$table->index('user_id');
			$table->index('client_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('receipts');
	}

}
