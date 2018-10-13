<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('username')->nullable();
			$table->string('email')->unique()->nullable();
			$table->text('password')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->enum('status_active', ['active', 'inactive'])->default('active');
			$table->integer('is_private')->default(0);
			$table->integer('is_notify')->default(1);
			$table->integer('post_count')->default(0)->unsigned();
			$table->integer('follower_count')->default(0)->unsigned();
			$table->integer('following_count')->default(0)->unsigned();
			$table->integer('unread_count')->default(0)->unsigned();
			$table->integer('role');
			$table->text('player_id')->nullable();
			$table->string('device_token')->nullable();
			$table->string('device_type')->nullable();
			$table->string('country')->nullable();
			$table->string('state')->nullable();
                        $table->enum('gender', ['male', 'female', 'other']);
			$table->text('description')->nullable();
			$table->date('dob')->nullable();
			$table->string('profile_pic')->nullable();
			$table->enum('language', ['en', 'id', 'ar', 'fr', 'de'])->default('en');
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
		Schema::dropIfExists('users');
	}
}
