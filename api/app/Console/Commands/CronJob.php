<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Cron : CronJob
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Console\Commands;

use App\Http\Controllers\CommonmailController;
use Illuminate\Console\Command;

class CronJob extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'CronJob:cronjob';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Video conversion';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->commonService = new CommonmailController();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		$getVideos = \DB::table('post_media')->where('media_process', 'progress')->where('media_type', 'video')->get();
		if (count($getVideos) > 0) {
			foreach ($getVideos as $key => $media_value) {
				$explode = explode('.', $media_value->media_name);
				$source = $media_value->media_name;
				$filename = md5(microtime()) . $media_value->media_id;
				$id = $media_value->media_id;
				$user_id = $media_value->user_id;
				if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
					// check if windows
					$ffmpeg_path = base_path() . '\resources\ffmpeg\ffmpeg_win\ffmpeg';
					$source_path = base_path() . '\uploads\images\post\\' . $source;
					$destination_path = base_path() . '\uploads\images\post\\';
					$this->videoConversion($ffmpeg_path, $source_path, $destination_path, $filename);
				} else {
					$ffmpeg_path = base_path() . '/resources/ffmpeg/ffmpeg_lin/ffmpeg.exe';
					$source_path = base_path() . '/uploads/images/post/' . $source;
					$destination_path = base_path() . '/uploads/images/post/';
					$this->videoConversion($ffmpeg_path, $source_path, $destination_path, $filename);
				}
				if ($media_value->media_extension != 'mp4') {
					$values = array('type' => 'video_post', 'name' => 'Your video post is ready', 'sender' => 1, 'receiver' => $user_id, 'object_id' => $id, 'created_at' => date('Y-m-d H:i:s'));
					\DB::table('notification')->insert($values);
					/**Mail Notification STARTS */
					$getUsers = \DB::table('users')->where('id', $user_id)->first();
					$toMail = $getUsers->email;
					$tempname = 'email.post_is_ready';
					$subject = 'Post is ready';
					$getoptionAll = \DB::table('options')->select('*')->get();
					$optionResult = [
						'app_name' => $getoptionAll[0]->option,
						'logo_url' => $getoptionAll[2]->option,
						'email' => $getoptionAll[1]->option,
					];
					$logoImage = "uploads/images/logo/" . $optionResult['logo_url'];
					$data = array('logo' => $logoImage, 'sitename' => $optionResult['app_name'],'username' => $getUsers->username);
					$this->commonService->getMail($optionResult['email'], $toMail, $subject, $data, $tempname);
					/**Mail Notification ENDS */
				}
				$media_file = array('media_process' => 'completed', 'media_name' => $filename . '.mp4');
				\DB::table('post_media')->where('media_id', $id)->update($media_file);
			}
		}
		$this->info('Inserted Successfully!');
	}

	public function videoConversion($ffmpeg_path, $source_path, $destination_path, $destination_filename) {
		$mp4cmd = "$ffmpeg_path -i $source_path -acodec aac -strict experimental -pix_fmt yuv420p $destination_path" . $destination_filename . ".mp4";
		shell_exec($mp4cmd);
	}
}