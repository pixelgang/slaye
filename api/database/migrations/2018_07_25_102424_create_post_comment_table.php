<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('post_comment', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('post_id');
			$table->text('desc');
			$table->enum('comment_status', ['active', 'inactive'])->default('active');
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
		Schema::dropIfExists('post_comment');
	}
}
