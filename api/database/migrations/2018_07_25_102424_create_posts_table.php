<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('posts', function (Blueprint $table) {
			$table->increments('post_id');
			$table->integer('user_id');
			$table->text('post_text');
			$table->enum('post_type', ['photo', 'video', 'both']);
			$table->string('post_locations');
			$table->string('post_lat');
			$table->string('post_lang');
			$table->integer('post_like_count')->default(0)->unsigned();
			$table->integer('post_comment_count')->default(0)->unsigned();
			$table->enum('post_status', ['active', 'inactive'])->default('active');
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
		Schema::dropIfExists('posts');
	}
}
