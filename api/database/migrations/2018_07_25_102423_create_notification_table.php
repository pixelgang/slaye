<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('notification', function (Blueprint $table) {
			$table->increments('id');
			$table->string('type');
			$table->string('name');
			$table->integer('sender');
			$table->integer('receiver');
			$table->string('object_id');
			$table->integer('status')->default(0);
			$table->integer('push_status')->default(0);
			$table->timestamp('updated_at')->useCurrent();
			$table->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('notification');
	}
}
