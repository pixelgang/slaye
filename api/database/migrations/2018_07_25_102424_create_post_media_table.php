<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMediaTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('post_media', function (Blueprint $table) {
			$table->increments('media_id');
			$table->integer('user_id');
			$table->integer('post_id');
			$table->string('media_name');
			$table->string('media_image');
			$table->string('media_size');
			$table->string('media_dimension');
			$table->string('media_mime_type');
			$table->string('media_extension');
			$table->enum('media_type', ['photo', 'video']);
			$table->enum('media_process', ['progress', 'completed'])->default('progress');
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
		Schema::dropIfExists('post_media');
	}
}
