<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserConnectionTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('user_connection', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('friend_id');
			$table->integer('status');
			$table->integer('follow')->default('1');
			$table->integer('blocked_by')->nullable();
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
		Schema::dropIfExists('user_connection');
	}
}
