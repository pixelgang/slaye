<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Controller : Users
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Models;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Users extends Model {

	public function __construct() {
	}

	/*
		     * This is the function for getting Following List.
		     * It will be called while user viewing following list from mobile application.
	*/

	public function myfollowings($request, $iPerPage) {
		$user_id = 0;
		if ($request['username']) {
			$member_id = \DB::table('users')->where('username', $request['username'])->first();
			if ($member_id) {
				$user_id = $member_id->id;
			}
		} else if ($request['member_id']) {
			$user_id = $request['member_id'];
		} else {
			$user_id = $request['user_id'];
		}
		$no_page = 0;
		$page = $request['page_no'];
		$page = (int) $page;
		$start = $page == 1 ? 0 : 10 * ($page - 1);
		$my_rs = \DB::table('user_connection')
			->select('user_connection.*')
			->where('user_connection.user_id', $user_id)
			->where('user_connection.status', 1)
			->skip($start)->take(10)
			->get();
		$count = \DB::table('user_connection')
			->where('user_connection.user_id', $user_id)
			->where('user_connection.status', 1)
			->count();
		$result = array();
		if (count($my_rs) > 0) {
			foreach ($my_rs as $key => $b_value) {
				$user_rs = \DB::table('users')
					->select('users.*')
					->where('users.id', '=', $b_value->friend_id)
					->get();
				// added is_private & and following status
				//find friend_id is follow the user_id - Start
				$loginId = $request['user_id'];
				$friendId = $b_value->friend_id;
				$checkFollowing = \DB::table('user_connection')
					->select('user_connection.id')
					->where('user_connection.user_id', $loginId)
					->where('user_connection.friend_id', $friendId)
					->where('user_connection.status', 1)
					->get();
				$checkrequest = \DB::table('user_connection')
					->select('user_connection.id')
					->where('user_connection.user_id', $loginId)
					->where('user_connection.friend_id', $friendId)
					->where('user_connection.status', 3)
					->get();
				$following = 1;
				$following = count($checkFollowing) == 0 ? 0 : 1;
				if (count($checkrequest)) {
					$following = 2;
				}
				//find friend_id is follow the user_id - End
				$profile_pic = \bsetecHelpers::getProfilePicture($user_rs[0]->id, $user_rs[0]);
				$result[] = array(
					'user_id' => $b_value->friend_id,
					'name' => $user_rs[0]->username,
					'profile_pic' => $profile_pic,
					'follower_status' => $b_value->status,
					'is_private' => $user_rs[0]->is_private,
					'user_follow_status' => $following,
				);
			}
			$no_page = ceil($count / $iPerPage);
		}
		return array('my_followings' => $result, 'count' => $count, 'no_page' => $no_page);
	}

	/*
		     * This is the function for getting Follower List
		     * It will be called while user viewing Follower list from mobile application.
	*/

	public function myfollowers($request, $iPerPage) {
		$user_id = 0;
		if ($request['username']) {
			$member_id = \DB::table('users')->where('username', $request['username'])->first();
			if ($member_id) {
				$user_id = $member_id->id;
			}
		} else if ($request['member_id']) {
			$user_id = $request['member_id'];
		} else {
			$user_id = $request['user_id'];
		}
		$count = 0;
		$no_page = 0;
		if ($request['record'] == "all") {
			$my_rs = \DB::table('user_connection')
				->select('user_connection.*')
				->where('user_connection.friend_id', $user_id)
				->where('user_connection.status', 1)
				->get();
		} else {
			$page = $request['page_no'];
			$start = !empty($page) && $page > 1 ? 10 * ($page - 1) : 0;

			$my_rs = \DB::table('user_connection')
				->select('user_connection.*')
				->where('user_connection.friend_id', $user_id)
				->where('user_connection.status', 1)
				->skip($start)->take(10)
				->get();
			$count = \DB::table('user_connection')
				->where('user_connection.friend_id', $user_id)
				->where('user_connection.status', 1)
				->count();
		}

		$result = array();
		if (count($my_rs) > 0) {
			foreach ($my_rs as $key => $b_value) {
				$user_rs = \DB::table('users')
					->select('users.*')
					->where('users.id', '=', $b_value->user_id)
					->get();
				if ($request['record'] == "all") {
					$result[] = array(
						'user_id' => $b_value->user_id,
						'name' => $user_rs[0]->username,
					);
				} else {
					// added is_private & and following status
					//find friend_id is follow the user_id - Start
					$loginId = $request['user_id'];
					$friendId = $b_value->user_id;
					$checkFollowing = \DB::table('user_connection')
						->select('user_connection.id')
						->where('user_connection.user_id', $loginId)
						->where('user_connection.friend_id', $friendId)
						->where('user_connection.status', 1)
						->get();
					$checkrequest = \DB::table('user_connection')
						->select('user_connection.id')
						->where('user_connection.user_id', $loginId)
						->where('user_connection.friend_id', $friendId)
						->where('user_connection.status', 3)
						->get();
					$following = count($checkFollowing) == 0 ? 0 : 1;
					if (count($checkrequest)) {
						$following = 2;
					}
					//find friend_id is follow the user_id - End
					$profile_pic = \bsetecHelpers::getProfilePicture($user_rs[0]->id, $user_rs[0]);
					$result[] = array(
						'user_id' => $b_value->user_id,
						'name' => $user_rs[0]->username,
						'profile_pic' => $profile_pic,
						'follower_status' => $b_value->status,
						'is_private' => $user_rs[0]->is_private,
						'user_follow_status' => $following,
					);
				}
				$no_page = ceil($count / $iPerPage);
			}
		}
		if ($request['record'] == "all") {
			return array('my_followers' => $result);
		} else {
			return array('my_followers' => $result, 'count' => $count, 'no_page' => $no_page);
		}
	}

	/*
		     * This is the function for Delete user.
	*/

	public function deleteUser($request) {
		$u_id = $request['u_id'];
		/* Decrease following count and update - start */
		$users_list = \DB::table('user_connection')
			->select('user_id')
			->where('friend_id', $u_id)
			->where('status', 1)
			->get();
		if (count($users_list) > 0) {
			foreach ($users_list as $userId) {
				$getFollowingCount = \DB::table('users')->select('following_count')->where('id', '=', $userId->user_id)->get();
				if ($getFollowingCount[0]->following_count != 0) {
					$following_update['following_count'] = $getFollowingCount[0]->following_count - 1;
					\DB::table('users')->where('id', $userId->user_id)->update($following_update);
				}
			}
		}
		/* Decrease following count and update - end */
		/* Decrease follower count and update - start */
		$users_follower_list = \DB::table('user_connection')
			->select('friend_id')
			->where('user_id', $u_id)
			->where('status', 1)
			->get();
		if (count($users_follower_list) > 0) {
			foreach ($users_follower_list as $userFollowerId) {
				$getFollowerCount = \DB::table('users')->select('follower_count')->where('id', '=', $userFollowerId->friend_id)->get();
				if ($getFollowerCount[0]->follower_count != 0) {
					$follower_update['follower_count'] = $getFollowerCount[0]->follower_count - 1;
					\DB::table('users')->where('id', $userFollowerId->friend_id)->update($follower_update);
				}
			}
		}
		/* Decrease follower count and update - end */
		\DB::table('user_connection')->where('user_id', $u_id)->delete();
		\DB::table('user_connection')->where('friend_id', $u_id)->delete();
		\DB::table('notification')->where('sender', $u_id)->delete();
		\DB::table('notification')->where('receiver', $u_id)->delete();
		\DB::table('posts')->where('user_id', $u_id)->delete();
		/** Decrease Post comment count - start */
		$commentsList = \DB::table('post_comment')
			->select('post_id')
			->where('user_id', $u_id)
			->get();
		if (count($commentsList) > 0) {
			foreach ($commentsList as $aRow) {
				$getCommentCount = \DB::table('posts')->select('post_comment_count')
					->where('post_id', '=', $aRow->post_id)->get();
				if (count($getCommentCount) > 0) {
					if ($getCommentCount[0]->post_comment_count != 0) {
						$postUpdate['post_comment_count'] = $getCommentCount[0]->post_comment_count - 1;
						\DB::table('posts')->where('post_id', $aRow->post_id)->update($postUpdate);
					}
				}
			}
		}
		\DB::table('post_comment')->where('user_id', $u_id)->delete();
		/** Decrease Post comment count - end */
		/** Decrease Post likes count - start */
		$likesList = \DB::table('post_like')
			->select('post_id')
			->where('user_id', $u_id)
			->get();
		if (count($likesList) > 0) {
			foreach ($likesList as $aRow) {
				$getLikeCount = \DB::table('posts')->select('post_like_count')
					->where('post_id', '=', $aRow->post_id)->get();
				if (count($getLikeCount) > 0) {
					if ($getLikeCount[0]->post_like_count != 0) {
						$postUpdate['post_like_count'] = $getLikeCount[0]->post_like_count - 1;
						\DB::table('posts')->where('post_id', $aRow->post_id)->update($postUpdate);
					}
				}
			}
		}
		\DB::table('post_like')->where('user_id', $u_id)->delete();
		/** Decrease Post likes count - end */
		\DB::table('post_media')->where('user_id', $u_id)->delete();
		\DB::table('post_report')->where('user_id', $u_id)->delete();
		\DB::table('user_social')->where('user_id', $u_id)->delete();
		\DB::table('users')->where('id', $u_id)->delete();
		return true;
	}

	/*
		     * This is the function for getting Notifications.
		     * It will be triggered while viewing You and following notifications from mobile application.
	*/

	public function getNotifications($request) {
		$user_id = $request['user_id'];
		$page_no = $request['page_no'];
		$start = 0;
		$iPerPage = 10;
		if (!empty($page_no) && $page_no > 1) {
			$start = $page_no * $iPerPage;
		}

		$my_user = \DB::table('user_connection')
			->select('user_connection.*')
			->where('user_connection.user_id', $user_id)
			->get();
		$my_followers = \DB::table('user_connection')
			->select('user_connection.*')
			->where('user_connection.friend_id', $user_id)
			->get();

		$is_block = \DB::table('user_connection')
			->select('user_connection.*')
			->where('user_connection.friend_id', $user_id)
			->get();
		$usr_result = array();
		$followers_result = array();
		$unfollow_usr = array();
		if ($my_user) {
			foreach ($my_user as $key => $usr_value) {
				$user_var = \DB::table('users')
					->select('users.*')
					->where('users.id', '=', $usr_value->friend_id)
					->get();

				$usr_result[] = array(
					'name' => $user_var[0]->username . ' is following you',
				);
			}
		}
		if ($my_followers) {

			foreach ($my_followers as $key => $followers_value) {
				$followe_rs = \DB::table('users')
					->select('users.*')
					->where('users.id', '=', $followers_value->user_id)
					->get();

				$followers_result[] = array(
					'name' => $followe_rs[0]->username . ' is your follower',
				);
			}
		}
		if ($is_block) {

			foreach ($is_block as $key => $unfollow_value) {
				if ($unfollow_value->status == 2) {
					$datas = array();
					$datas['status'] = 3;
					$assas = \DB::table('user_connection')->where('friend_id', $unfollow_value->friend_id)->update($datas);
				}
				$un_follwrs = \DB::table('users')
					->select('users.*')
					->where('users.id', '=', $unfollow_value->user_id)
					->get();

				$blocked[] = array(
					'name' => $un_follwrs[0]->username . ' has successfully blocked ',
				);
			}
		}
		$aVars = array(
			'following' => $usr_result,
			'followers' => $followers_result,
			'block' => $blocked,
		);
		return $aVars;
	}

	/* This is the function for Admin previlege to add/edit/view user details.  */

	public function admingetuserdetail($request) {

		if ($request['action_type'] == 1) {
			$userDetail = \DB::table('users')->where('id', $request->id)->get();
			if (count($userDetail) > 0) {
				$data = $userDetail;
			} else {
				$data = [];
			}
		} else if ($request['action_type'] == 2) {
			$email_exist = Users::where('email', $request->email)->where('id', '!=', $request->id)->first();
			$user_exist = Users::where('username', $request->username)->where('id', '!=', $request->id)->first();
			if (isset($user_exist->id)) {
				$data = [
					'message' => 'error',
					'status_message' => 'Username already exist',
				];
			} else if (isset($email_exist->id)) {
				$data = [
					'message' => 'error',
					'status_message' => 'Email already exist',
				];
			} else {
				$update['first_name'] = $request->first_name;
				$update['last_name'] = $request->last_name;
				$update['email'] = $request->email;
				$update['role'] = $request->role;
				$update['username'] = $request->username;
				$update['state'] = $request->state;
				$update['country'] = $request->country;
				$update['status_active'] = $request->status_active;
				$update['profile_pic'] = $request->profile_pic;
				$update['updated_at'] = \DB::raw('CURRENT_TIMESTAMP');
				if (isset($request->password) && $request->password != "") {
					$update['password'] = app('hash')->make($request->password);
				}
				\DB::table('users')->where('id', $request->id)->update($update);

				$data = ['message' => 'updated'];
			}
		} else if ($request['action_type'] == 3) {
			$email_exist = Users::where('email', $request->email)->first();
			$user_exist = Users::where('username', $request->username)->first();
			if (isset($user_exist->id)) {
				$data = [
					'message' => 'error',
					'status_message' => 'Username already exist',
				];
			} else if (isset($email_exist->id)) {
				$data = [
					'message' => 'error',
					'status_message' => 'Email already exist',
				];
			} else {
				$insert['first_name'] = $request->first_name;
				$insert['last_name'] = $request->last_name;
				$insert['username'] = $request->username;
				$insert['email'] = $request->email;
				$insert['password'] = app('hash')->make($request->password);
				$insert['state'] = $request->state;
				$insert['country'] = $request->country;
				$insert['role'] = $request->role;
				$insert['status_active'] = $request->status_active;
				if ($request->profile_pic != "") {
					$insert['profile_pic'] = $request->profile_pic;
				} else {
					$insert['profile_pic'] = '';
				}
				$insert['updated_at'] = \DB::raw('CURRENT_TIMESTAMP');
				$insert['created_at'] = \DB::raw('CURRENT_TIMESTAMP');
				$user_id = \DB::table('users')->insertGetId($insert);
				$insert['profile_pic'] = \bsetecHelpers::getProfilePicture($request->id, $request);
				if ($user_id) {
					$data = ['message' => 'success'];
				} else {
					$data = [];
				}
			}
		}
		return $data;
	}

	/*
		     * This is the function for getting follower request list.
		     * It will be called while user viewing Follower request list from mobile application.
	*/

	public function getfollowerrequest($request) {
		$userId = $request->user_id;
		$iPerPage = 10;
		$result = [];

		$page = (int) $request['page_no'];
		$start = $page == 1 ? 0 : 10 * ($page - 1);

		$no_page = 0;

		$total_userLists = \DB::table('user_connection')
			->select('user_id', 'id')
			->where('friend_id', $userId)
			->where('status', 3)
			->count();

		if ($total_userLists != 0) {
			$userLists = \DB::table('user_connection')
				->select('user_id', 'id')
				->where('friend_id', $userId)
				->where('status', 3)
				->skip($start)->take($iPerPage)->get();
			foreach ($userLists as $key => $user) {
				$userDetail = \DB::table('users')
					->select('users.*')
					->where('users.id', '=', $user->user_id)
					->get();

				$profile_pic = \bsetecHelpers::getProfilePicture($userDetail[0]->id, $userDetail[0]);

				$result[] = array(
					'connect_id' => $user->id,
					'id' => $userDetail[0]->id,
					'name' => $userDetail[0]->username,
					'profile_pic' => $profile_pic,
				);
			}
			$no_page = ceil($total_userLists / $iPerPage);
		}
		$result['request_list'] = $result;
		$result['total_count'] = $total_userLists;
		$result['no_page'] = $no_page;
		return $result;
	}

	/*
		     * This is the function for follower request response ( accept or decline )
		     * It will be triggered while accepting or declining user follow request from mobile application.
	*/

	public function postresponsestatus($request) {
		$result = [];
		$connect_id = $request->connect_id;
		$status = $request->status;
		$whoID = $request->userid;
		$followerID = $request->follower_id != "" ? $request->follower_id : "";

		if ($status) {
			//update user_connection table
			$con_update['status'] = 1;
			\DB::table('user_connection')->where('id', $connect_id)->update($con_update);

			//update user table
			/* increase follower count */
			$getFollowerCount = \DB::table('users')->select('follower_count')->where('id', '=', $whoID)->get();
			$follower_update['follower_count'] = $getFollowerCount[0]->follower_count + 1;
			\DB::table('users')->where('id', $whoID)->update($follower_update);

			/* increase following count */
			$getFollowingCount = \DB::table('users')->select('following_count')->where('id', '=', $followerID)->get();
			$following_update['following_count'] = $getFollowingCount[0]->following_count + 1;
			\DB::table('users')->where('id', $followerID)->update($following_update);
			$this->pushupdate($whoID, $followerID, 'request_accept', 'Request accept');
			$result = ['message' => "accept"];
		} else {
			\DB::table('user_connection')->where('id', $connect_id)->delete();
			$result = ['message' => "decline"];
		}
		return $result;
	}

	/**
	 * This is the function for push notification update.
	 * It will be called while doing actions like, comment, post_added, follow, follow request send, accept and decline.
	 */
	public function pushupdate($sender, $receiver, $type, $msg = '', $object_id = '') {
		if ($sender && $type) {
			$values = array('type' => $type, 'name' => $msg, 'sender' => $sender, 'receiver' => $receiver, 'object_id' => $object_id, 'created_at' => date('Y-m-d H:i:s'));
			\DB::table('notification')->insert($values);
		}
		return true;
	}

	/*
		     * This is the function for Update user as Demo Account
	*/

	public function isdemouserupdate($request) {
		$update_isdemo['is_demo'] = 1;
		\DB::table('users')->where('id', $request->user_id)->update($update_isdemo);
		return true;
	}

	/* This is the function for getting member follower list for admin user profile page */

	public function memberfollowers($request, $iPerPage) {
		$user_id = 0;
		if ($request['username']) {
			$member_id = \DB::table('users')->where('username', $request['username'])->first();
			if ($member_id) {
				$user_id = $member_id->id;
			}
		} else if ($request['member_id']) {
			$user_id = $request['member_id'];
		} else {
			$user_id = $request['user_id'];
		}
		$count = 0;
		$no_page = 0;
		if ($request['record'] == "all") {
			$my_rs = \DB::table('user_connection')
				->select('user_connection.*')
				->where('user_connection.friend_id', $user_id)
				->where('user_connection.status', 1)
				->get();
		} else {
			$page = $request['page_no'];
			$start = !empty($page) && $page > 1 ? 5 * ($page - 1) : 0;

			$my_rs = \DB::table('user_connection')
				->select('user_connection.*')
				->where('user_connection.friend_id', $user_id)
				->where('user_connection.status', 1)
				->skip($start)->take(5)
				->get();
			$count = \DB::table('user_connection')
				->where('user_connection.friend_id', $user_id)
				->where('user_connection.status', 1)
				->count();
		}

		$result = array();
		if (count($my_rs) > 0) {
			foreach ($my_rs as $key => $b_value) {
				$user_rs = \DB::table('users')
					->select('users.*')
					->where('users.id', '=', $b_value->user_id)
					->get();
				if ($request['record'] == "all") {
					$result[] = array(
						'user_id' => $b_value->user_id,
						'name' => $user_rs[0]->username,
					);
				} else {
					// added is_private & and following status
					//find friend_id is follow the user_id - Start
					$loginId = $request['user_id'];
					$friendId = $b_value->user_id;
					$checkFollowing = \DB::table('user_connection')
						->select('user_connection.id')
						->where('user_connection.user_id', $loginId)
						->where('user_connection.friend_id', $friendId)
						->where('user_connection.status', 1)
						->get();
					$checkrequest = \DB::table('user_connection')
						->select('user_connection.id')
						->where('user_connection.user_id', $loginId)
						->where('user_connection.friend_id', $friendId)
						->where('user_connection.status', 3)
						->get();
					$following = count($checkFollowing) == 0 ? 0 : 1;
					if (count($checkrequest)) {
						$following = 2;
					}
					//find friend_id is follow the user_id - End
					$profile_pic = \bsetecHelpers::getProfilePicture($user_rs[0]->id, $user_rs[0]);
					$now = Carbon::now();
					$startTime = Carbon::parse($now);
					$finishTime = Carbon::parse($b_value->updated_at);
					$time = $finishTime->diffForHumans($startTime, true);
					$result[] = array(
						'user_id' => $b_value->user_id,
						'name' => $user_rs[0]->username,
						'profile_pic' => $profile_pic,
						'follower_status' => $b_value->status,
						'is_private' => $user_rs[0]->is_private,
						'user_follow_status' => $following,
						'follower_from' => $time . ' ago',
					);
				}
				$no_page = ceil($count / $iPerPage);
			}
		}
		if ($request['record'] == "all") {
			return array('my_followers' => $result);
		} else {
			return array('my_followers' => $result, 'count' => $count, 'no_page' => $no_page);
		}
	}

	/* This is the function for getting member following list for admin user profile page */

	public function memberfollowings($request, $iPerPage) {
		$user_id = 0;
		if ($request['username']) {
			$member_id = \DB::table('users')->where('username', $request['username'])->first();
			if ($member_id) {
				$user_id = $member_id->id;
			}
		} else if ($request['member_id']) {
			$user_id = $request['member_id'];
		} else {
			$user_id = $request['user_id'];
		}
		$no_page = 0;
		$page = $request['page_no'];
		$page = (int) $page;
		$start = $page == 1 ? 0 : 5 * ($page - 1);
		$my_rs = \DB::table('user_connection')
			->select('user_connection.*')
			->where('user_connection.user_id', $user_id)
			->where('user_connection.status', 1)
			->skip($start)->take(5)
			->get();
		$count = \DB::table('user_connection')
			->where('user_connection.user_id', $user_id)
			->where('user_connection.status', 1)
			->count();
		$result = array();
		if (count($my_rs) > 0) {
			foreach ($my_rs as $key => $b_value) {
				$user_rs = \DB::table('users')
					->select('users.*')
					->where('users.id', '=', $b_value->friend_id)
					->get();
				// added is_private & and following status
				//find friend_id is follow the user_id - Start
				$loginId = $request['user_id'];
				$friendId = $b_value->friend_id;
				$checkFollowing = \DB::table('user_connection')
					->select('user_connection.id')
					->where('user_connection.user_id', $loginId)
					->where('user_connection.friend_id', $friendId)
					->where('user_connection.status', 1)
					->get();
				$checkrequest = \DB::table('user_connection')
					->select('user_connection.id')
					->where('user_connection.user_id', $loginId)
					->where('user_connection.friend_id', $friendId)
					->where('user_connection.status', 3)
					->get();
				$following = 1;
				$following = count($checkFollowing) == 0 ? 0 : 1;
				if (count($checkrequest)) {
					$following = 2;
				}
				//find friend_id is follow the user_id - End
				$profile_pic = \bsetecHelpers::getProfilePicture($user_rs[0]->id, $user_rs[0]);
				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($b_value->updated_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$result[] = array(
					'user_id' => $b_value->friend_id,
					'name' => $user_rs[0]->username,
					'profile_pic' => $profile_pic,
					'follower_status' => $b_value->status,
					'is_private' => $user_rs[0]->is_private,
					'user_follow_status' => $following,
					'following_from' => $time . ' ago',
				);
			}
			$no_page = ceil($count / $iPerPage);
		}
		return array('my_followings' => $result, 'count' => $count, 'no_page' => $no_page);
	}
	/**
	 * This is the function for updating user status as active/inactive
	 */
	public function updateUserStatus($user_info) {
		$member_id = $user_info['member_id'];
		$data = array();
		$data['status_active'] = $user_info['status'];
		\DB::table('users')->where('id', $member_id)->update($data);
		return true;
	}
	/**
	 * This is the function for updating Site settings values from Admin panel.
	 */
	public function actiongeneral($request) {
		$multipleRow = [
			['key' => 'app_name', 'option' => $request->app_name],
			['key' => 'email', 'option' => $request->email],
			['key' => 'front_logo', 'option' => $request->front_logo],
			['key' => 'fav_icon', 'option' => $request->fav_icon],
			['key' => 'notification_flush', 'option' => $request->notification_flush],
			['key' => 'onesignal_appid', 'option' => $request->onesignal_appid],
			['key' => 'onesignal_appkey', 'option' => $request->onesignal_appkey],
		];

		foreach ($multipleRow as $row) {
			$returnValue[] = \DB::table('options')->where('option_key', '=', $row['key'])->update(['option' => $row['option']]);
		}
		return array('status' => 'success');
	}
	/**
	 * This is the function for mail settings which is used by Admin panel.
	 */
	public function actionmailsetting($request) {
		$multipleRow = [
			['key' => 'smtp_host', 'option' => $request->smtp_host],
			['key' => 'smtp_port', 'option' => $request->smtp_port],
			['key' => 'smtp_username', 'option' => $request->smtp_username],
			['key' => 'smtp_password', 'option' => $request->smtp_password],
			['key' => 'smtp_secure', 'option' => $request->smtp_secure],
		];

		$env_data = array();
		$env_data['MAIL_DRIVER'] = 'smtp';
		$env_data['MAIL_HOST'] = $request->smtp_host;
		$env_data['MAIL_PORT'] = $request->smtp_port;
		$env_data['MAIL_USERNAME'] = $request->smtp_username;
		$env_data['MAIL_PASSWORD'] = $request->smtp_password;
		$env_data['MAIL_ENCRYPTION'] = $request->smtp_secure;

		// $this->changeEnv($env_data);
		foreach ($multipleRow as $row) {
			$returnValue[] = \DB::table('options')->where('option_key', '=', $row['key'])->update(['option' => $row['option']]);
		}
		return array('status' => 'success');
	}

	// This is the function for Change env file dynamically which is used by Admin panel.
	function changeEnv($data) {
		if (count($data) > 0) {
			// read .env-file
			$env = file_get_contents(base_path() . '/.env');
			// split env file string convert to array format
			$env = preg_split('/\s+/', $env);
			// Loop through given data
			foreach ((array) $data as $key => $value) {
				// loop old env key
				foreach ($env as $env_key => $env_value) {
					// split env key in array
					$entry = explode("=", $env_value, 2);
					// check old env key equal($entry[0]) to new env key ($key)
					if ($entry[0] == $key) {
						// If yes, overwrite it with the new one
						$env[$env_key] = $key . "=" . $value;
					} else {
						// If not, keep the old one
						$env[$env_key] = $env_value;
					}
				}
			}
			// Turn the array back to an String
			$env = implode("\n", $env);
			// And overwrite the .env with the new data
			file_put_contents(base_path() . '/.env', $env);
			return true;
		} else {
			return false;
		}
	}

	/*
		     * This is the function for getting Notification feeds.
		     *  1 => You, 2=> following It will be called from mobile application.
	*/

	public function getNotificationsFeed($request) {
		$user_id = $request['user_id'];
		$type = $request['type'];
		$page_no = (int) $request['page_no'];
		$start = 0;
		$iPerPage = 10;
		$start = $page_no == 1 ? 0 : 10 * ($page_no - 1);
		$uRec = \DB::table('users')
			->select('unread_count')
			->where('id', $user_id)
			->first();
		$unread_count = ($uRec->unread_count) ? $uRec->unread_count : 0;
		$youFeeds = array();
		$followingFeeds = array();
		if ($type == 1) {
			$youFeeds = $this->getYouNotifications($request, $user_id, $start, $iPerPage);
		} else if ($type == 2) {
			$followingFeeds = $this->getFollowingNotifications($request, $user_id, $start, $iPerPage);
		} else {
			return array('status' => false, 'status_msg' => 'Invalid type');
		}
		if (empty($youFeeds) && empty($followingFeeds)) {
			$statusMsg = 'No more notifications';
		} else {
			$statusMsg = 'Notifications listed Successfully.';
		}
		return array(
			'status' => true,
			'status_msg' => $statusMsg,
			'you_feeds' => $youFeeds,
			'follow_feeds' => $followingFeeds,
			'unread_count' => (int) $unread_count,
		);
	}

	/*
		     * This is the function for getting You Notifications feed.
	*/

	function getYouNotifications($request, $userId, $start = 0, $perPage = 10) {
		$result = array();
		$data = \DB::table('notification')
			->select('notification.*', 'users.profile_pic', 'users.gender', 'users.username', 'users.first_name', 'users.last_name')
			->join('users', 'users.id', '=', 'notification.sender')
			->where('notification.receiver', $userId)
			->where('notification.sender', '<>', $userId)
			->where('notification.push_status', 1)
			->orderBy('id', 'desc')
			->skip($start)->take($perPage)->get();
		if (count($data) > 0) {
			foreach ($data as $key => $b_value) {
				$message = $title = '';
				$individualmessage = "";
				$notifyUser = $b_value->first_name . ' ' . $b_value->last_name;
				if ($b_value->type == 'request_sent') {
					$title = 'Send a Follower Request';
					$message = $notifyUser . ' send a follow request to you';
					$individualmessage = "send a follow request to you";
				} else if ($b_value->type == 'follow') {
					$title = 'Following you';
					$message = $notifyUser . ' started following you';
					$individualmessage = "started following you";
				} else if ($b_value->type == 'request_accept') {
					$title = 'Request Accepted';
					$message = $notifyUser . ' accepted your follow request';
					$individualmessage = "accepted your follow request";
				} else if ($b_value->type == 'comment') {
					$title = 'Post Comment';
					$message = $notifyUser . ' commented on your post';
					$individualmessage = "Someone commented on your post";
				} else if ($b_value->type == 'like') {
					$title = 'Post Like';
					$message = $notifyUser . ' liked your post';
					$individualmessage = "Someone liked your post";
				} else if ($b_value->type == 'video_post') {
					$title = 'Video Post';
					$message = 'Your video post is ready';
					$individualmessage = 'Your video post is ready';
				}
				$profile_pic = \bsetecHelpers::getProfilePicture($b_value->sender, $b_value);
				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($b_value->created_at);
				$time = $finishTime->diffForHumans($startTime, true, true);
				$result[] = array(
					'notification_id' => $b_value->id,
					'title' => $title,
					'type' => $b_value->type,
					'object_id' => $b_value->object_id,
					'message' => $message,
					'individualmessage' => $individualmessage,
					'sender_id' => $b_value->sender,
					'author_name' => $notifyUser,
					'profile_pic' => $profile_pic,
					'status' => $b_value->status,
					'created_at_ago' => $time,
					'created_at' => $b_value->created_at,
				);
			}
		}
		return $result;
	}

	/*
		     * This is the function for getting Following Notifications feed.
	*/

	function getFollowingNotifications($request, $userId, $start = 0, $perPage = 10) {
		$result = array();
		$my_user = \DB::table('user_connection')
			->where('user_connection.user_id', $userId)
			->where('user_connection.follow', '1')
			->where('user_connection.status', '1')
			->pluck('user_connection.friend_id');
		if (!empty($my_user)) {
			/* Restrict Grouping for follow feeds */
			$bQuery = \DB::table('notification')
				->select('notification.type AS action', 'notification.sender', 'notification.receiver', \DB::raw('1 as "action_count"'), 'notification.object_id', 'notification.receiver AS recerverIds', 'notification.created_at', 'users.profile_pic', 'users.username', 'users.first_name', 'users.last_name', 'users.gender')
				->join('users', 'users.id', '=', 'notification.sender')
				->WhereIn('notification.sender', $my_user)
				->where('notification.receiver', '<>', $userId)
				->WhereIn('notification.type', array('follow', 'request_accept'))
				->where('notification.push_status', 1);
			/* Other feeds will group */
			$aQuery = \DB::table('notification')
				->select('notification.type AS action', 'notification.sender', 'notification.receiver', \DB::raw('COUNT(*) as "action_count"'), \DB::raw('GROUP_CONCAT(DISTINCT(notification.object_id)) AS object_id'), \DB::raw('GROUP_CONCAT(DISTINCT(notification.receiver)) AS recerverIds'), 'notification.created_at', 'users.profile_pic', 'users.username', 'users.first_name', 'users.last_name', 'users.gender')
				->join('users', 'users.id', '=', 'notification.sender')
				->WhereIn('notification.sender', $my_user)
				->where('notification.receiver', '<>', $userId)
				->WhereIn('notification.type', array('like', 'comment', 'post_added'))
				->where('notification.push_status', 1)
				->groupBy('notification.type', 'notification.sender', \DB::raw('Date(notification.created_at)'));
			$final = $bQuery->union($aQuery);
			$querySql = $final->toSql();
			$all_content_query = \DB::table(\DB::raw("($querySql) as tCollect"))->mergeBindings($final);
			$cData = $all_content_query->orderBy('created_at', 'desc')
				->skip($start)->take($perPage)->get();
			$result = $this->followingFeedsResponse($request, $userId, $cData);
		}
		return $result;
	}

	/*
		     * This is the function for Formation of following notification grouping feeds structure.
	*/

	function followingFeedsResponse($request, $userId, $iData) {
		$rData = array();
		if (!empty($iData)) {
			foreach ($iData as $ikey => $ivalue) {
				switch (true) {
				case ($ivalue->action == 'like'):
					$rData[] = $this->constructPostRelatedFeeds($request, $userId, $ivalue, 'liked');
					break;
				case ($ivalue->action == 'comment'):
					$rData[] = $this->constructPostRelatedFeeds($request, $userId, $ivalue, 'commented');
					break;
				case ($ivalue->action == 'post_added'):
					$rData[] = $this->constructPostRelatedFeeds($request, $userId, $ivalue, 'added');
					break;
				case ($ivalue->action == 'follow' || $ivalue->action == 'request_accept'):
					$rData[] = $this->constructProfileFollowFeeds($request, $userId, $ivalue);
					break;
				default:
					break;
				}
			}
		}
		return $rData;
	}

	/*
		     * This is the function for Construct Profile related feeds response structure.
	*/

	function constructProfileFollowFeeds($request, $userId, $ivalue) {
		if (!empty($ivalue)) {
			$notifyUser = $ivalue->first_name . ' ' . $ivalue->last_name;
			$profile_pic = \bsetecHelpers::getProfilePicture($ivalue->sender, $ivalue);
			if (!empty($ivalue->recerverIds)) {
				$allObjectId = explode(',', $ivalue->recerverIds);
				$userCount = count($allObjectId);
				$usrData = array();
				$i = 0;
				if ($userCount) {
					$userRecords = \DB::table('users')
						->select('*')
						->WhereIn('id', $allObjectId)
						->get();
					foreach ($userRecords as $uKey => $uRow) {
						$uId = $uRow->id;
						$uName = $uRow->first_name . ' ' . $uRow->last_name;
						$uImg = \bsetecHelpers::getProfilePicture($uRow->id, $uRow);
						$usrData[] = array(
							'user_id' => $uId,
							'user_name' => $uName,
							'user_image' => $uImg,
						);
						if ($i == 9) {
							break;
						}

						$i++;
					}
					$data = array(
						'users' => $usrData,
						'action_count' => $userCount,
						'posts' => array(),
					);
					$now = Carbon::now();
					$startTime = Carbon::parse($now);
					$finishTime = Carbon::parse($ivalue->created_at);
					$time = $finishTime->diffForHumans($startTime, true, true);
					return array(
						'type' => ($userCount > 1) ? 'group' : 'single',
						'action' => 'follow',
						'text' => $this->returnFollowingText($userId, $ivalue, $userCount, $userRecords),
						'profile_pic' => $profile_pic,
						'profile_id' => $ivalue->sender,
						'profile_name' => $notifyUser,
						'created_at_ago' => $time,
						'created_at' => $ivalue->created_at,
						'data' => $data,
					);
				}
			}
		}
	}

	/*
		     * This is the function for Return Following notification grouping text.
		     * xxx started following yyy
		     * xxx started following yyy and zzz
		     * xxx started following yyy, zzz and 3 others
	*/

	function returnFollowingText($userId, $ivalue, $userCount, $userRecords) {
		$user_name = $user_join_link = '';
		$notifyUser = $ivalue->first_name . ' ' . $ivalue->last_name;
		$feed_text = '';
		$firstActioner = $userRecords[0];
		if ($userCount > 2) {
			$secondActioner = $userRecords[1];
			$thirdActioner = $userRecords[2];
			$other_id = $userCount - 2;
			$third_name = $other_id . ' ' . 'others';
			$feed_text = $notifyUser . ' ' . 'started following' . ' ' . $firstActioner->first_name . ' ' . $firstActioner->last_name . ',' . $secondActioner->first_name . ' ' . $secondActioner->last_name . ' and  ' . $third_name;
		} else if ($userCount > 1) {
			$secondActioner = $userRecords[1];
			$feed_text = $notifyUser . ' ' . 'started following' . ' ' . $firstActioner->first_name . ' ' . $firstActioner->last_name . ' and ' . $secondActioner->first_name . ' ' . $secondActioner->last_name;
		} else if ($userCount == 1) {
			$feed_text = $notifyUser . ' ' . 'started following' . ' ' . $firstActioner->first_name . ' ' . $firstActioner->last_name;
		}
		return $feed_text;
	}

	/*
		     * This is the function for Construct Post related feeds response structure.
	*/

	function constructPostRelatedFeeds($request, $userId, $ivalue, $dname = 'liked') {
		if (!empty($ivalue)) {
			$notifyUser = $ivalue->first_name . ' ' . $ivalue->last_name;
			$profile_pic = \bsetecHelpers::getProfilePicture($ivalue->sender, $ivalue);
			$usrData = array();
			if (!empty($ivalue->object_id)) {
				$allObjectId = explode(',', $ivalue->object_id);
				$postCount = count($allObjectId);
				if ($postCount > 1) {
					//group - xxx liked 4 Posts
					$aType = 'group';
					$activity_text = $notifyUser . ' ' . $dname . ' ' . $postCount . ' posts ';
					$usrData[0] = array('user_id' => $ivalue->sender, 'user_name' => $notifyUser);
				} else {
					//Single - xxxx liked yyy's Post
					$aType = 'single';
					if ($ivalue->receiver) {
						if ($ivalue->sender == $ivalue->receiver) {
							if ($ivalue->gender == 'male') {
								$pronoun = 'his';
							} elseif ($ivalue->gender == 'female') {
								$pronoun = 'her';
							} else {
								$pronoun = 'their';
							}

							$activity_text = $notifyUser . ' ' . $dname . ' ' . $pronoun . ' post ';
							$usrData[0] = array('user_id' => $ivalue->sender, 'user_name' => $notifyUser);
							$usrData[1] = array('user_id' => $ivalue->sender, 'user_name' => $notifyUser);
						} else {
							$receiverInfo = \DB::table('users')->where('id', $ivalue->receiver)->first();
							$rUser = $receiverInfo->first_name . ' ' . $receiverInfo->last_name;
							$activity_text = $notifyUser . ' ' . $dname . ' ' . $rUser . '\'s post ';
							$usrData[0] = array('user_id' => $ivalue->sender, 'user_name' => $notifyUser);
							$usrData[1] = array('user_id' => $ivalue->receiver, 'user_name' => $rUser);
						}
					} elseif ($ivalue->action == 'post_added') {
						$activity_text = $notifyUser . ' added a new post ';
						$usrData[0] = array('user_id' => $ivalue->sender, 'user_name' => $notifyUser);
					}
				}
				$data = array(
					'users' => $usrData,
					'action_count' => $postCount,
					'posts' => $this->constructGroupPostData($userId, $ivalue, $allObjectId),
				);
				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($ivalue->created_at);
				$time = $finishTime->diffForHumans($startTime, true, true);
				return array(
					'type' => $aType,
					'action' => $ivalue->action,
					'text' => $activity_text,
					'profile_pic' => $profile_pic,
					'profile_id' => $ivalue->sender,
					'profile_name' => $notifyUser,
					'created_at_ago' => $time,
					'created_at' => $ivalue->created_at,
					'data' => $data,
				);
			}
		}
	}

	/*
		     * This is the function for Construct Grouped post data and media information(like,comment,added_post)
	*/

	function constructGroupPostData($userId, $value, $allObjectId) {
		$resultData = array();
		$i = 0;
		if (!empty($value) && $allObjectId) {
			$postRecords = \DB::table('posts')
				->select('posts.*', 'users.first_name', 'users.last_name', 'users.username', 'users.profile_pic')
				->join('users', 'users.id', '=', 'posts.user_id')
				->WhereIn('post_id', $allObjectId)
				->get();
			$pModel = new Post();
			$resultData = $pModel->postFeedResponseStructure($userId, $postRecords);
		}
		return $resultData;
	}

	/*
		     * This is the function for Mail template options - update which is called from Admin panel.
	*/

	public function actionmailtemplate($request) {
		// update register file based on register input value from mail setting
		$registeremailFile = base_path() . "/resources/views/email/register.blade.php";
		$rg = fopen($registeremailFile, "w+");
		fwrite($rg, $request->register_template);
		fclose($rg);
		// update forgot file based on forgot input value from mail setting
		$forgotemailFile = base_path() . "/resources/views/email/forgot.blade.php";
		$fp = fopen($forgotemailFile, "w+");
		fwrite($fp, $request->forgot_template);
		fclose($fp);
		// update post ready file based on post ready input value from mail setting
		$postreadyemailFile = base_path() . "/resources/views/email/post_is_ready.blade.php";
		$pr = fopen($postreadyemailFile, "w+");
		fwrite($pr, $request->post_ready_template);
		fclose($pr);
		// update common post file based on post ready input value from mail setting
		$commonpostemailFile = base_path() . "/resources/views/email/common_post.blade.php";
		$cp = fopen($commonpostemailFile, "w+");
		fwrite($cp, $request->common_post_template);
		fclose($cp);

		// update report post file based on post abuse template input value from mail setting
		$reportpostemailFile = base_path() . "/resources/views/email/post_abuse.blade.php";
		$rp = fopen($reportpostemailFile, "w+");
		fwrite($rp, $request->report_post);
		fclose($rp);

		return array('status' => 'success');
	}

}
