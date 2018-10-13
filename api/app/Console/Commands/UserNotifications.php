<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Cron : UserNotifications
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Console\Commands;

use App\Http\Controllers\CommonmailController;
use Illuminate\Console\Command;

class UserNotifications extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'UserNotifications:notifications';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'User Notifications';

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
		$getNotificatin = \DB::table('notification')
			->select('notification.*', 'users.id AS user_id', 'users.username AS username', 'users.email AS email', 'users.device_token', 'users.device_type', 'users.player_id', 'users.unread_count')
			->join('users', 'users.id', '=', 'notification.receiver')
			->where('users.is_notify', 1)
			->where('notification.push_status', 0)
			->orderBy('notification.id', 'ASC')
			->get();
		if (count($getNotificatin) > 0) {
			foreach ($getNotificatin as $nKey => $rows) {
				$notification_id = $rows->id;
				$eddate = date("Y-m-d H:i:s");
				$user_details[] = array(
					'ID' => $rows->user_id,
					'user_image' => '',
					'Name' => $rows->username,
				);
				$senderInfo = \DB::table('users')->where('id', $rows->sender)->first();
				if ($rows->type == 'comment') {
					$title = 'Post Comment';
					$message = $senderInfo->username . ' commented on your post';
				} else if ($rows->type == 'request_sent') {
					$title = 'Send a Request';
					$message = $senderInfo->username . ' send a follow request to you';
				} else if ($rows->type == 'follow') {
					$title = 'Following you';
					$message = $senderInfo->username . ' started following you';
				} else if ($rows->type == 'request_accept') {
					$title = 'Request Accepted';
					$message = $senderInfo->username . ' accpeted your follow request';
				} else if ($rows->type == 'like') {
					$title = 'Post Like';
					$message = $senderInfo->username . ' liked your post';
				} else if ($rows->type == 'video_post') {
					$title = 'Video Post';
					$message = 'Your video post is ready';
				}
				$playerId = $rows->player_id;
				if ($playerId) {
					$unread_count = $rows->unread_count;
					$msg = array(
						'title' => $title,
						'message' => $message,
						'push_notification_id' => $notification_id,
						'type' => $rows->type,
						'ID' => $rows->receiver,
						'sender_user_id' => $rows->sender,
						'sender_user_name' => $senderInfo->username,
						'object_id' => $rows->object_id ? $rows->object_id : 0,
						'user_details' => $user_details,
						'vibrate' => 1,
						'sound' => 1,
						'batch_count' => (int) $unread_count,
						'ios_badgeType' => 'SetTo',
						'ios_badgeCount' => (int) $unread_count,
						'largeIcon' => 'large_icon',
						'smallIcon' => 'small_icon',
					);
					$this->info(json_encode($msg));
					$response = \OneSignalServiceHelpers::sendPushNotification(array($playerId), $msg);
					$this->info($response);
				}
				$this->updateNotificationStatus($notification_id);
				\DB::table('users')->where('id', $rows->receiver)->increment('unread_count');
				$this->info($message);
				$getoptionAll = \DB::table('options')->select('*')->get();
				$optionResult = [
					'app_name' => $getoptionAll[0]->option,
					'logo_url' => $getoptionAll[2]->option,
					'email' => $getoptionAll[1]->option,
				];
				$logoImage = "uploads/images/logo/" . $optionResult['logo_url'];
				$this->commonService->getMail($optionResult['email'], $rows->email, $title, ['logo' => $logoImage, 'sitename' => $optionResult['app_name'], 'username' => $rows->username, 'messages' => $message], 'email.common_post');
			}
			$this->info('Notification has been sent Successfully!');
		} else {
			$this->info('No more You Notifications!');
		}
		$this->sendPostNotification();
	}
	/**
	 * This function is for Updating Notification status
	 */
	public function updateNotificationStatus($notification_id) {
		\DB::table('notification')
			->where('id', $notification_id)
			->update(array(
				'push_status' => '1',
				'updated_at' => date('Y-m-d H:i:s'),
			));
	}
	/**
	 * This function is for sending One to many / Bulk push notification to receivers
	 * Notifications - for followers while posting post
	 */
	public function sendPostNotification() {
		$getNotificatin = \DB::table('notification')
			->where('type', 'post_added')
			->where('push_status', '0')
			->where('receiver', '0')
			->orderBy('id', 'ASC')
			->get();
		if (count($getNotificatin) > 0) {
			foreach ($getNotificatin as $nKey => $rows) {
				$notification_id = $rows->id;
				$senderId = $rows->sender;
				$senderInfo = \DB::table('users')->where('id', $rows->sender)->first();
				$user_details[] = array(
					'ID' => $senderInfo->id,
					'user_image' => '',
					'Name' => $senderInfo->username,
				);
				$my_user = \DB::table('user_connection')
					->where('user_connection.friend_id', $senderId)
					->where('user_connection.follow', '1')
					->where('user_connection.status', '1')
					->pluck('user_connection.user_id');
				$userRow = \DB::table('users')
					->where('player_id', '!=', '')
					->WhereIn('id', $my_user)
					->pluck('player_id');
				if (!empty($userRow)) {
					if ($userRow) {
						$title = 'New Post';
						$message = $senderInfo->username . ' added new post';
						$msg = array(
							'title' => $title,
							'message' => $message,
							'push_notification_id' => $notification_id,
							'type' => $rows->type,
							'ID' => $rows->receiver,
							'sender_user_id' => $rows->sender,
							'sender_user_name' => $senderInfo->username,
							'object_id' => $rows->object_id ? $rows->object_id : 0,
							'user_details' => $user_details,
							'batch_count' => 0,
							'vibrate' => 1,
							'sound' => 1,
							'largeIcon' => 'large_icon',
							'smallIcon' => 'small_icon',
						);
						$response = \OneSignalServiceHelpers::sendPushNotification($userRow, $msg);
						$this->info($response);
					}
					$this->info(json_encode($userRow));
				}
				$this->updateNotificationStatus($notification_id);
			}
		}
	}
}