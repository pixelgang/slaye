<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Controller : User Controller
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Http\Controllers;
use App\Http\Controllers\CommonmailController;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Input;
use Validator;

class UserController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	protected $commonService;
	public function __construct(CommonmailController $commonService) {
		$this->users = new Users();
		$this->commonService = $commonService;
	}

	/*
		     * This is the function for User Registration.
			 * It will be triggered while user register from mobile application.
	*/

	public function postRegister(Request $request) {

		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:5|max:25',
			'first_name' => 'required',
			'last_name' => 'required',
			'username' => 'required|min:2',
			'state' => 'required',
			'country' => 'required',
			'gender' => 'required',
		);
		if ($request->input('description')) {
			$rules['description'] = 'max:150';
		}
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$email_exist = Users::where('email', $request->input('email'))->first();
			$user_exist = Users::where('username', $request->input('username'))->first();
			if (isset($user_exist->id)) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'Username already exist',
				));
			} else if (isset($email_exist->id)) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'Email already exist',
				));
			} else {
				$data = array();
				$data['first_name'] = $request->input('first_name');
				$data['last_name'] = $request->input('last_name');
				$data['username'] = $request->input('username');
				$data['email'] = $request->input('email');

				$data['password'] = app('hash')->make($request->input('password'));
				$data['state'] = $request->input('state');
				$data['country'] = $request->input('country');
				$data['dob'] = $request->input('dob');
				$data['gender'] = $request->input('gender');
				$data['description'] = $request->input('description');
				$data['role'] = '2'; // role = 1 means Admin, role = 2 means Norma User.
				$data['device_type'] = $request->input('device_type') ? $request->input('device_type') : '';
				$data['device_token'] = $request->input('device_token') ? $request->input('device_token') : '';
				$data['player_id'] = $request->input('player_id') ? $request->input('player_id') : '';
				$data['updated_at'] = Carbon::now();
				$data['created_at'] = Carbon::now();
				if ($request->has('profile_pic')) {
					$data['profile_pic'] = $request->input('profile_pic');
				} else {
					$data['profile_pic'] = '';
				}
				$language = $request->input('language');
				if (isset($language)) {
					$data['language'] = $request->input('language');
				}
				$user_id = \DB::table('users')->insertGetId($data);
				if (!empty($user_id)) {
					$path = rtrim(url('/'));
					$baseurl = \bsetecHelpers::getProfilePicture($user_id, (object) $data);
					$user_data = array();
					$user_data['id'] = $user_id;
					$user_data['first_name'] = $request->input('first_name');
					$user_data['last_name'] = $request->input('last_name');
					$user_data['username'] = $request->input('username');
					$user_data['email'] = $request->input('email');
					$user_data['access_token'] = $data['password'];
					$user_data['state'] = $request->input('state');
					$user_data['country'] = $request->input('country');
					$user_data['dob'] = $request->input('dob');
					$user_data['gender'] = $request->input('gender');
					$user_data['description'] = $request->input('description');
					$user_data['is_private'] = '0'; // is_private = 0 means public profile, is_private = 1 means Private profile.
					$user_data['is_notify'] = '1'; // is_notify = 0 means user restricted notifications, is_notify = 1 means user allowed notifications.
					$user_data['follower_count'] = '0'; //While create new user, we will set follower count as 0
					$user_data['following_count'] = '0'; //While create new user, we will set following count as 0
					$user_data['post_count'] = 0; //While create new user, we will set post count as 0
					$user_data['role'] = '2'; // role = 1 means Admin, role = 2 means Norma User.
					$user_data['profile_pic'] = $baseurl;
					$user_data['unread_count'] = 0;
					// Mail functionality
					$getoptionAll = \DB::table('options')->select('*')->get();
					$optionResult = [
						'app_name' => $getoptionAll[0]->option,
						'logo_url' => $getoptionAll[2]->option,
						'email' => $getoptionAll[1]->option,
					];
					$logoImage = "uploads/images/logo/" . $optionResult['logo_url'];
					$reponsemail = $this->commonService->getMail($optionResult['email'], $request->input('email'), 'Welcome to Insta Social', ['logo' => $logoImage, 'username' => $request->input('username'), 'sitename' => $optionResult['app_name']], 'email.register');
					return response()->json(array(
						'status' => true,
						'status_message' => 'User Successfully registered',
						'details' => $user_data,
					));
				} else {
					return response()->json(array(
						'status' => false,
						'status_message' => 'Not successfully registered!',
					));
				}
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		     * This is the function for User Login.
			 * It will be called while user login from mobile application.
	*/

	public function postLogin(Request $request) {
		$rules = array(
			'username' => 'required',
			'password' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = Users::where('email', $request->input('username'))->orwhere('username', $request->input('username'))->first();
			if (!$user_exist) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			} else {
				$check = app('hash')->check($request->input('password'), $user_exist->password);
				if (!$check) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'Password is incorrect',
					));
				}
				/* Check User Active Status - Start */
				$loginusername = $request->input('username');
				$checkUserActive = Users::where('status_active', 'inactive')
					->where(function ($query) use ($loginusername) {
						$query->where('username', $loginusername)
							->orwhere('email', $loginusername);
					})->first();
				if ($checkUserActive) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'Your account is suspend by Admin',
					));
				}

				$update = array();
				if ($request->input('device_token') && $request->input('device_type')) {
					$update['device_token'] = $request->input('device_token');
					$update['device_type'] = $request->input('device_type');
					$update['player_id'] = $request->input('player_id');
					$update['updated_at'] = Carbon::now();
					$language = $request->input('language');
					if (isset($language)) {
						$update['language'] = $request->input('language');
					}
					\DB::table('users')->where('id', $user_exist->id)->update($update);
				} else if ($request->input('player_id')) {
					$update['player_id'] = $request->input('player_id');
					\DB::table('users')->where('id', $user_exist->id)->update($update);
				}
				$update['updated_at'] = Carbon::now();
				\DB::table('users')->where('id', $user_exist->id)->update($update);
				//Calculate unread count with satisfied criteria of both sent push notification (push_status = 1), and user's unread status (status=0)
				$unread_count = $user_exist->unread_count;
				$user_data = array();
				$user_data['id'] = $user_exist->id;
				$user_data['first_name'] = $user_exist->first_name;
				$user_data['last_name'] = $user_exist->last_name;
				$user_data['username'] = $user_exist->username;
				$user_data['email'] = $user_exist->email;
				$user_data['access_token'] = $user_exist->password;
				$user_data['state'] = $user_exist->state;
				$user_data['country'] = $user_exist->country;
				$user_data['dob'] = $user_exist->dob ? $user_exist->dob : '';
				$user_data['gender'] = $user_exist->gender ? $user_exist->gender : '';
				$user_data['description'] = $user_exist->description ? $user_exist->description : '';
				$user_data['role'] = $user_exist->role;
				$user_data['is_private'] = $user_exist->is_private;
				$user_data['is_notify'] = $user_exist->is_notify;
				$user_data['created_at'] = $user_exist->created_at;
				$user_data['follower_count'] = $user_exist->follower_count;
				$user_data['following_count'] = $user_exist->following_count;
				$user_data['post_count'] = $user_exist->post_count;
				$user_data['unread_count'] = (int) $unread_count;
				$user_data['profile_pic'] = \bsetecHelpers::getProfilePicture($user_exist->id, $user_exist);
				return response()->json(array(
					'status' => true,
					'status_message' => 'Successfully logged in',
					'details' => $user_data,
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		     * This is the function for Edit profile.
			 * It will be called while user editing profile from mobile application.
	*/

	public function postEditprofile(Request $request) {
		$rules = array(
			'userid' => 'required',
			'access_token' => 'required',
		);
		if ($request->input('description')) {
			$rules['description'] = 'max:150';
		}
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = Users::where('id', $request->input('userid'))->first();
			if (!$user_exist) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			} else {
				if ($user_exist->password != $request->input('access_token')) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'invalid access token',
					));
				}
				$update = array();
				if ($request->input('first_name')) {
					$update['first_name'] = $request->input('first_name');
				}
				if ($request->input('last_name')) {
					$update['last_name'] = $request->input('last_name');
				}
				if ($request->input('state')) {
					$update['state'] = $request->input('state');
				}
				if ($request->input('country')) {
					$update['country'] = $request->input('country');
				}
				if ($request->input('dob')) {
					$update['dob'] = $request->input('dob');
				}
				if ($request->input('gender')) {
					$update['gender'] = $request->input('gender');
				}
				$update['description'] = $request->input('description');
				if ($request->input('profile_pic')) {
					$update['profile_pic'] = $request->input('profile_pic');
				}
				$language = $request->input('language');
				if (isset($language)) {
					$update['language'] = $request->input('language');
				}
				$update['updated_at'] = \DB::raw('CURRENT_TIMESTAMP');
				if (count($update) > 0) {
					\DB::table('users')->where('id', $user_exist->id)->update($update);
				}

				$profile = Users::where('id', $request->input('userid'))->first();
				$user_data = array();
				$user_data['id'] = $profile->id;
				$user_data['first_name'] = $profile->first_name;
				$user_data['last_name'] = $profile->last_name;
				$user_data['username'] = $profile->username;
				$user_data['email'] = $profile->email;
				$user_data['access_token'] = $profile->password;
				$user_data['state'] = $profile->state;
				$user_data['country'] = $profile->country;
				$user_data['dob'] = $profile->dob;
				$user_data['gender'] = $profile->gender;
				$user_data['description'] = ($profile->description) ? $profile->description : "";
				$user_data['role'] = $profile->role;
				$user_data['is_private'] = $profile->is_private;
				$user_data['is_notify'] = $profile->is_notify;
				$user_data['follower_count'] = $profile->follower_count;
				$user_data['following_count'] = $profile->following_count;
				$user_data['post_count'] = $profile->post_count;
				$user_data['profile_pic'] = \bsetecHelpers::getProfilePicture($profile->id, $profile);
				return response()->json(array(
					'status' => true,
					'status_message' => 'Successfully profile updated',
					'details' => $user_data,
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		    * This is the function for Gett Profile details
			* It will be called while user viewing profile from mobile application.
	*/

	public function getProfileinfo(Request $request) {
		$rules = array(
			'userid' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {

			$profile = Users::where('id', $request->input('userid'))->first();
			if (!$profile) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			} else {
				if ($profile->password != $request->input('access_token')) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'invalid access token',
					));
				}
				$author_info = $profile;
				if ($request->input('member_id')) {
					$profile = Users::where('id', $request->input('member_id'))->first();
					if (!$profile) {
						return response()->json(array(
							'status' => false,
							'status_message' => 'Profile not found',
						));
					}
				}

				if ($request->input('username')) {
					$profile = Users::where('username', $request->input('username'))->first();
					if (!$profile) {
						return response()->json(array(
							'status' => false,
							'status_message' => 'Profile not found',
							'errorpage' => 404,
						));
					}
				}
				$language = $request->input('language');
				if (isset($language)) {
					$updatelang = \DB::table('users')->where('id', $request->input('userid'))->update(array('language' => $request->input('language')));
				}

				$member_request_check = false;
				$connection_id = "";
				if ($request->input('userid') != $profile->id) {
					$follow_exist = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `user_id`="' . $request->input('userid') . '" AND `friend_id`="' . $profile->id . '"'));
					$member_request_check = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `user_id`="' . $profile->id . '" AND `friend_id`="' . $request->input('userid') . '"AND `status`=3'));

					$follower_check = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `user_id`="' . $request->input('userid') . '" AND `friend_id`="' . $profile->id . '"AND `status`=2'));
					$following_check = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `friend_id`="' . $request->input('userid') . '" AND `user_id`="' . $profile->id . '"AND `status`=2'));
				}
				// check whether user is blocked by me or not.
				$blockedbyme = false;
				if (!empty($follower_check) || !empty($following_check)) {
					$blockedbyme = true;
				}
				if ($request->input('is_admin') != 1 && $blockedbyme) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'Account blocked',
						'errorpage' => 404,
					));
				}
				$is_follow = false;
				$is_block = false;
				$is_requested = false;
				$is_follow_button = false;
				$follow_status = '';
				$member_request = false;

				if (!empty($follow_exist)) {
					if ($follow_exist[0]->status == 1) {
						$is_follow = true;
					}

					if ($follow_exist[0]->status == 1) {
						$follow_status = 'follow';
					} else if ($follow_exist[0]->status == 3) {
						$follow_status = 'request';
					} else if ($follow_exist[0]->status == 2) {
						$follow_status = 'block';
					}

					if ($follow_exist[0]->status == 2) {
						$is_block = true;
					}

					if ($follow_exist[0]->status == 3) {
						$is_requested = true;
					}
				}

				if (!$is_follow && !$is_requested && !$is_block) {
					$is_follow_button = true;
				}
				if ($member_request_check) {
					$member_request = true;
					$connection_id = $member_request_check[0]->id;
				}

				$date = Carbon::now();
				$date2 = Carbon::createFromFormat('Y-m-d H:i:s', $profile->created_at)->toDateTimeString();
				$diffInSeconds = strtotime($date) - strtotime($date2);
				$timer = $diffInSeconds;
				// Calculate time format as 1 minute ago, 1 day ago, 1 week ago, 1 month ago and so on
				$startTime = Carbon::parse($date);
				$updatedTime = Carbon::parse($profile->created_at);
				$updatedTimeAgo = $updatedTime->diffForHumans($startTime, true);
				$modifiedTime = Carbon::parse($profile->updated_at);
				$modifiedTimeAgo = $modifiedTime->diffForHumans($startTime, true);
				$user_data = array();
				$user_data['first_name'] = $profile->first_name;
				$user_data['last_name'] = $profile->last_name;
				$user_data['username'] = $profile->username;
				$user_data['email'] = $profile->email;
				$user_data['user_id'] = $profile->id;
				$user_data['access_token'] = $profile->password;
				$user_data['state'] = $profile->state ? $profile->state : '';
				$user_data['country'] = $profile->country ? $profile->country : '';
				$user_data['dob'] = $profile->dob ? $profile->dob : '';
				$user_data['gender'] = $profile->gender ? $profile->gender : '';
				$user_data['description'] = $profile->description ? $profile->description : '';
				$user_data['profilepic'] = '';
				$user_data['role'] = $profile->role;
				$user_data['is_private'] = $profile->is_private;
				$user_data['is_notify'] = $profile->is_notify;
				$user_data['updated_at'] = $profile->updated_at;
				$user_data['modified_at'] = $profile->created_at;
				$user_data['updated_ago'] = $updatedTimeAgo . ' ago';
				$user_data['modified_ago'] = $modifiedTimeAgo . ' ago';
				$user_data['timer'] = $timer;
				$user_data['follower_count'] = $profile->follower_count;
				$user_data['following_count'] = $profile->following_count;
				$user_data['post_count'] = $profile->post_count;
				$user_data['user_status'] = $profile->status_active;
				$user_data['device_type'] = ($profile->device_type) ? $profile->device_type : "";
				$user_data['profile_pic'] = \bsetecHelpers::getProfilePicture($profile->id, $profile);
				$user_data['author_pirc'] = \bsetecHelpers::getProfilePicture($author_info->id, $author_info);
				$user_data['is_follow'] = $is_follow;
				$user_data['follow_status'] = $follow_status;
				$user_data['is_block'] = $is_block;
				$user_data['is_requested'] = $is_requested;
				$user_data['is_follow_button'] = $is_follow_button;
				$user_data['blockedbyme'] = $blockedbyme;
				$user_data['member_request'] = $member_request;
				$user_data['connection_id'] = $connection_id;

				return response()->json(array(
					'status' => true,
					'status_message' => 'listed successfully',
					'details' => $user_data,
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		* This is the function for Change password
		* It will be called while user change password from mobile application.
	*/

	public function postChangepassword(Request $request) {
		$rules = array(
			'userid' => 'required',
			'access_token' => 'required',
			'old_password' => 'required',
			'new_password' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {

			if ($request->input('old_password') == $request->input('new_password')) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'old and new password are same!',
				));
			}

			$profile = Users::where('id', $request->input('userid'))->first();
			if (!$profile) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			} else {
				if ($profile->password != $request->input('access_token')) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'invalid access token',
					));
				}
				$check = app('hash')->check($request->input('old_password'), $profile->password);
				if (!$check) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'old password is wrong!',
					));
				}

				$update = array();
				$newpassword = app('hash')->make($request->input('new_password'));
				$language = $request->input('language');
				if (isset($language)) {
					Users::where('id', $profile->id)->update(['password' => $newpassword, 'updated_at' => \DB::raw('CURRENT_TIMESTAMP'), 'language' => $request->input('language')]);
				} else {
					Users::where('id', $profile->id)->update(['password' => $newpassword, 'updated_at' => \DB::raw('CURRENT_TIMESTAMP')]);
				}
				return response()->json(array(
					'status' => true,
					'status_message' => 'Password changed successfully',
					'access_token' => $newpassword,
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		     * This is the function for Update user settings
			 * It will be called while user update settings from mobile application.
	*/

	public function postSettings(Request $request) {

		$rules = array(
			'userid' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = Users::where('id', $request->input('userid'))->first();
			if (!$user_exist) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			} else {
				if ($user_exist->password != $request->input('access_token')) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'invalid access token',
					));
				}
				$language = $request->input('language');
				if (isset($language)) {
					$updatelang = \DB::table('users')->where('id', $request->input('userid'))->update(array('language' => $request->input('language')));
				}
				$update = array();
				if ($request->input('is_notify') == '1' || $request->input('is_notify') == '0') {
					if ($request->input('is_notify') == '0' && $user_exist->is_notify == '1') {
						\DB::table('notification')->where('receiver', $request->input('userid'))->delete();
					}
					$update['is_notify'] = $request->input('is_notify');
				}
				if ($request->input('is_private') == '1' || $request->input('is_private') == '0') {
					$update['is_private'] = $request->input('is_private');
				}
				$language = $request->input('language');
				if (isset($language)) {
					$update['language'] = $request->input('language');
				}

				if (count($update) > 0) {
					\DB::table('users')->where('id', $user_exist->id)->update($update);
				}

				$profile = Users::where('id', $request->input('userid'))->first();
				$user_data = array();
				$user_data['first_name'] = $profile->first_name;
				$user_data['last_name'] = $profile->last_name;
				$user_data['username'] = $profile->username;
				$user_data['email'] = $profile->email;
				$user_data['user_id'] = $profile->id;
				$user_data['access_token'] = $profile->password;
				$user_data['state'] = $profile->state ? $profile->state : '';
				$user_data['country'] = $profile->country ? $profile->country : '';
				$user_data['dob'] = $profile->dob ? $profile->dob : '';
				$user_data['gender'] = $profile->gender ? $profile->gender : '';
				$user_data['description'] = $profile->description ? $profile->description : '';
				$user_data['profilepic'] = '';
				$user_data['follower_count'] = $profile->follower_count;
				$user_data['following_count'] = $profile->following_count;
				$user_data['post_count'] = $profile->post_count;
				$user_data['role'] = $profile->role;
				$user_data['is_private'] = $profile->is_private;
				$user_data['is_notify'] = $profile->is_notify;

				return response()->json(array(
					'status' => true,
					'status_message' => 'Successfully Updated',
					'details' => $user_data,
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		    * This is the function for getting list of users with pagination, search, sort options
			* It will be called while user searching user from mobile application.
	*/

	public function getUser_list(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')->where('id', $request->user_id)->first();
			if (!$user_exist) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			} else {
				if ($user_exist->password != $request->access_token) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'invalid access token',
					));
				}
			}

			$page_no = isset($request->page_no) && $request->page_no != "" ? $request->page_no : 0;

			if (!$page_no) {
				$page_start = 0;
			} else {
				$page_start = 0;
				if ($page_no > 1) {
					$page_start = (($page_no - 1) * 10);
				}
			}
			$total = 0;
			$login_id = $request->user_id;
			$language = $request->input('language');
			if (isset($language)) {
				$updatelang = \DB::table('users')->where('id', $login_id)->update(array('language' => $request->input('language')));
			}
			$blocked_by_me = \DB::table('user_connection')->where('friend_id', $login_id)->where('status', 2)->groupby('user_id')->pluck('user_id')->all();
			$blocked_by = \DB::table('user_connection')->where('user_id', $login_id)->where('status', 2)->where('blocked_by', '<>', NULL)->groupby('friend_id')->pluck('friend_id')->all();
			$blocked_ids = array_unique(array_merge($blocked_by_me, $blocked_by));
			if ($request->sort) {
				$keyWord = isset($request->keyword) ? $request->keyword : "";
				if ($request->sort == 1) {
					$user = \DB::table('users')->where('id', '!=', $login_id)->where(function ($query) use ($keyWord) {
						$query->where('username', 'like', '%' . $keyWord . '%')
							->orwhere('first_name', 'like', '%' . $keyWord . '%')
							->orwhere('last_name', 'like', '%' . $keyWord . '%')
							->orwhere('email', 'like', '%' . $keyWord . '%');
					})->whereNotIn('id', $blocked_ids)->skip($page_start)->limit(10)->orderBy('id', 'DESC')->get();
					$total = \DB::table('users')->where('id', '!=', $login_id)->where(function ($query) use ($keyWord) {
						$query->where('username', 'like', '%' . $keyWord . '%')
							->orwhere('first_name', 'like', '%' . $keyWord . '%')
							->orwhere('last_name', 'like', '%' . $keyWord . '%')
							->orwhere('email', 'like', '%' . $keyWord . '%');
					})->whereNotIn('id', $blocked_ids)->count();
				} else {
					$user = \DB::table('users')->where('id', '!=', $login_id)->where(function ($query) use ($keyWord) {
						$query->where('users.username', 'like', '%' . $keyWord . '%')
							->orwhere('users.first_name', 'like', '%' . $keyWord . '%')
							->orwhere('users.last_name', 'like', '%' . $keyWord . '%')
							->orwhere('users.email', 'like', '%' . $keyWord . '%');
					})->whereNotIn('id', $blocked_ids)->skip($page_start)->limit(10)->orderBy('users.follower_count', 'DESC')->get();
					$total = \DB::table('users')->where('id', '!=', $login_id)->where(function ($query) use ($keyWord) {
						$query->where('users.username', 'like', '%' . $keyWord . '%')
							->orwhere('users.first_name', 'like', '%' . $keyWord . '%')
							->orwhere('users.last_name', 'like', '%' . $keyWord . '%')
							->orwhere('users.email', 'like', '%' . $keyWord . '%');
					})->whereNotIn('id', $blocked_ids)->count();
				}
			} else if ($request->keyword) {
				$keyWord = isset($request->keyword) ? $request->keyword : "";
				$user = \DB::table('users')->where('id', '!=', $login_id)
					->where(function ($query) use ($keyWord) {
						$query->where('username', 'like', '%' . $keyWord . '%')
							->orwhere('first_name', 'like', '%' . $keyWord . '%')
							->orwhere('last_name', 'like', '%' . $keyWord . '%')
							->orwhere('email', 'like', '%' . $keyWord . '%');
					})->whereNotIn('id', $blocked_ids)->skip($page_start)->limit(10)->orderBy('id', 'DESC')->get();
				$total = \DB::table('users')->where('id', '!=', $login_id)
					->where(function ($query) use ($keyWord) {
						$query->where('username', 'like', '%' . $keyWord . '%')
							->orwhere('first_name', 'like', '%' . $keyWord . '%')
							->orwhere('last_name', 'like', '%' . $keyWord . '%')
							->orwhere('email', 'like', '%' . $keyWord . '%');
					})->whereNotIn('id', $blocked_ids)->count();
			} else {
				$user = \DB::table('users')->where('id', '!=', $login_id)->whereNotIn('id', $blocked_ids)->skip($page_start)->limit(10)->orderBy('id', 'DESC')->get();
				$total = \DB::table('users')->where('id', '!=', $login_id)->whereNotIn('id', $blocked_ids)->count();
			}
			$user_list = array();

			if (count($user) > 0) {
				$flag = $page_no == 1 ? 1 : ($page_no - 1) * 10 + 1; // serail number generate
				foreach ($user as $key => $value) {
					$folllow_check = \DB::select(\DB::raw('SELECT `status` FROM `user_connection`  WHERE `user_id`="' . $request->user_id . '" AND  `friend_id`="' . $value->id . '"'));
					$is_follow = false;
					if ($folllow_check == '1' && $request->user_id != $value->id) {
						$is_follow = true;
					}

					if ($folllow_check == '1') {
						$follow_req_status = 'follow';
					} else if ($folllow_check == '2') {
						$follow_req_status = 'block';
					} else if ($folllow_check == '3') {
						$follow_req_status = 'request';
					} else {
						$follow_req_status = '';
					}

					$user_follow_status = "";
					$is_block = false;
					if ($login_id != "") {
						$checkFollowing = \DB::table('user_connection')
							->select('user_connection.id')
							->where('user_connection.user_id', $login_id)
							->where('user_connection.friend_id', $value->id)
							->where('user_connection.status', 1)
							->get();
						$checkrequest = \DB::table('user_connection')
							->select('user_connection.id')
							->where('user_connection.user_id', $login_id)
							->where('user_connection.friend_id', $value->id)
							->where('user_connection.status', 3)
							->get();
						$checkblock = \DB::table('user_connection')
							->select('user_connection.id')
							->where('user_connection.user_id', $value->id)
							->where('user_connection.friend_id', $login_id)
							->where('user_connection.status', 2)
							->get();
						$user_follow_status = count($checkFollowing) == 0 ? 0 : 1;
						if (count($checkrequest)) {
							$user_follow_status = 2;
						}
						if (count($checkblock)) {
							$is_block = true;
						}
					}
					$user_list[] = array(
						'user_id' => $value->id,
						'name' => $value->username,
						'first_name' => $value->first_name,
						'last_name' => $value->last_name,
						'username' => $value->username,
						'email' => $value->email,
						'state' => $value->state ? $value->state : '',
						'country' => $value->country ? $value->country : '',
						'dob' => $value->dob ? $value->dob : '',
						'gender' => $value->gender ? $value->gender : '',
						'description' => $value->description ? $value->description : '',
						'follower_count' => $value->follower_count,
						'following_count' => $value->following_count,
						'post_count' => $value->post_count,
						'created_at' => $value->created_at,
						'role' => $value->role,
						'is_private' => $value->is_private,
						'is_follow' => $is_follow,
						'is_block' => $is_block,
						'follow_status' => $follow_req_status,
						'serial_no' => $flag,
						'user_follow_status' => $user_follow_status,
					);
					$flag++;
				}
				$status = true;
			} else {
				$status = true;
				$user_list = array();
			}

			return response()->json([
				'status' => $status,
				'result' => $user_list,
				'total' => $total,
			]);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		     * This is the function for Admin user listing
			 * Get list of users with pagination, search, sort options
	*/

	public function getadminuserlist(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')
				->where('id', $request->user_id)
				->first();
			if (!$user_exist) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			} else {
				if ($user_exist->password != $request->access_token) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'invalid access token',
					));
				}
			}

			$page_no = $request->page_no;

			if (!$page_no) {
				$page_start = 0;
			} else {
				$page_start = 0;
				if ($page_no > 1) {
					$page_start = (($page_no - 1) * 10);
				}
			}
			$total = $totalvideo = $totalphoto = 0;
			$login_id = $request->user_id;

			if ($request->keyword) {
				$keyWord = $request->keyword;
				$user = \DB::table('users')
					->where(function ($query) use ($keyWord) {
						$query->where('username', 'like', '%' . $keyWord . '%')
							->orwhere('first_name', 'like', '%' . $keyWord . '%')
							->orwhere('last_name', 'like', '%' . $keyWord . '%')
							->orwhere('email', 'like', '%' . $keyWord . '%');
					})->skip($page_start)->limit(10)->orderBy('id', 'DESC')->get();
				$total = \DB::table('users')
					->where(function ($query) use ($keyWord) {
						$query->where('username', 'like', '%' . $keyWord . '%')
							->orwhere('first_name', 'like', '%' . $keyWord . '%')
							->orwhere('last_name', 'like', '%' . $keyWord . '%')
							->orwhere('email', 'like', '%' . $keyWord . '%');
					})->count();
			} else {
				$user = \DB::table('users')->skip($page_start)->limit(10)->orderBy('id', 'DESC')->get();
				$total = \DB::table('users')->count();
			}
			$user_list = array();

			if (count($user) > 0) {
				$page_no = (int) $page_no;

				foreach ($user as $key => $value) {
					$folllow_check = \DB::select(\DB::raw('SELECT `status` FROM `user_connection`  WHERE `user_id`="' . $request->user_id . '" AND  `friend_id`="' . $value->id . '"'));
					$is_follow = false;
					if ($folllow_check == '1' && $request->user_id != $value->id) {
						$is_follow = true;
					}

					if ($folllow_check == '1') {
						$follow_req_status = 'follow';
					} else if ($folllow_check == '2') {
						$follow_req_status = 'block';
					} else if ($folllow_check == '3') {
						$follow_req_status = 'request';
					} else {
						$follow_req_status = '';
					}

					$user_follow_status = "";
					if ($login_id != "") {
						$checkFollowing = \DB::table('user_connection')
							->select('user_connection.id')
							->where('user_connection.user_id', $login_id)
							->where('user_connection.friend_id', $value->id)
							->where('user_connection.status', 1)
							->get();
						$checkrequest = \DB::table('user_connection')
							->select('user_connection.id')
							->where('user_connection.user_id', $login_id)
							->where('user_connection.friend_id', $value->id)
							->where('user_connection.status', 3)
							->get();
						$user_follow_status = count($checkFollowing) == 0 ? 0 : 1;
						if (count($checkrequest)) {
							$user_follow_status = 2;
						}
					}
					$now = Carbon::now();
					$startTime = Carbon::parse($now);
					$finishTime = Carbon::parse($value->created_at);
					$time = $finishTime->diffForHumans($startTime, true);
					$user_list[] = array(
						'user_id' => $value->id,
						'username' => $value->username,
						'first_name' => $value->first_name,
						'last_name' => $value->last_name,
						'email' => $value->email,
						'status' => $value->status_active,
						'state' => $value->state ? $value->state : '',
						'country' => $value->country ? $value->country : '',
						'dob' => $value->dob ? $value->dob : '',
						'gender' => $value->gender ? $value->gender : '',
						'description' => $value->description ? $value->description : '',
						'follower_count' => \bsetecHelpers::lv_count($value->follower_count),
						'following_count' => \bsetecHelpers::lv_count($value->following_count),
						'post_count' => \bsetecHelpers::lv_count($value->post_count),
						'created_at' => $value->created_at,
						'role' => $value->role,
						'is_private' => $value->is_private,
						'is_follow' => $is_follow,
						'follow_status' => $follow_req_status,
						'user_follow_status' => $user_follow_status,
						'time_ago' => $time . ' ago',
					);
				}
				$status = true;
			} else {
				$status = true;
				$user_list = array();
			}

			return response()->json([
				'status' => $status,
				'result' => $user_list,
				'total' => $total,
			]);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		    * Follow, unfollow, block, unblock Actions
		    * type => 1-follow,2-block,3-unfollow,4-unblock
			* It will be called while user follow/unfollow/block/unblock from mobile application
	*/

	public function postFollowunfollowblock(Request $request) {

		$rules = array(
			'type' => 'required',
			'member_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')->where('id', $request->user_id)->first();
			if (!$user_exist) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			} else {
				if ($user_exist->password != $request->access_token) {
					return response()->json(array(
						'status' => false,
						'status_message' => 'invalid access token',
					));
				}
			}
			if ($request->user_id == $request->member_id) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'user_id and member_id should not be same.',
				));
			}
			$status = $request->type;

			$language = $request->input('language');
			if (isset($language)) {
				$updatelang = \DB::table('users')->where('id', $request->user_id)->update(array('language' => $request->input('language')));
			}
			$current_time = Carbon::now()->toDateTimeString();
			$user_follow_status = 0;
			$success_status = true;
			$is_block = 0;
			if ($status == 1) {
				// To avoid duplicate records, Check whether same data is already inserted or not
				$is_already_follow = \DB::table('user_connection')->where('user_id', '=', $request->user_id)->where('friend_id', '=', $request->member_id)->where('status', '=', 1)->first();
				$is_requested = \DB::table('user_connection')->where('user_id', '=', $request->user_id)->where('friend_id', '=', $request->member_id)->where('status', '=', 3)->first();
				$is_blocked_user = \DB::table('user_connection')->where('user_id', '=', $request->member_id)->where('friend_id', '=', $request->user_id)->where('status', '=', 2)->first();
				if ($is_already_follow) {
					$success_status = false;
					$message = 'already follow';
					$user_follow_status = 1;
				} else if ($is_requested) {
					$success_status = false;
					$message = 'Already Requested';
					$user_follow_status = 2;
				} else {
					$is_private = \DB::table('users')->where('id', '=', $request->member_id)->where('is_private', '=', 0)->first();
					$astatus = $is_private ? 1 : 3;
					$values = array('user_id' => $request->user_id, 'status' => $astatus, 'friend_id' => $request->member_id, 'created_at' => $current_time);
					if ($is_blocked_user) {
						\DB::select(\DB::raw('DELETE FROM `user_connection`  WHERE `user_id`="' . $request->member_id . '" AND `friend_id`="' . $request->user_id . '" '));
						\DB::select(\DB::raw('DELETE FROM `user_connection`  WHERE `user_id`="' . $request->user_id . '" AND `friend_id`="' . $request->member_id . '" '));
						\DB::table('user_connection')->insert($values);
					} else {
						\DB::table('user_connection')->insert($values);
					}
					if ($is_private) {
						\DB::table('users')->where('id', $request->user_id)->increment('following_count');
						\DB::table('users')->where('id', $request->member_id)->increment('follower_count');
					}
					if ($astatus == 3) {
						$user_follow_status = 2;
						$this->users->pushupdate($request->user_id, $request->member_id, 'request_sent', '');
						$message = 'Follow request sent';
					} else {
						$user_follow_status = 1;
						$this->users->pushupdate($request->user_id, $request->member_id, 'follow', '');
						$message = 'Follow successfully';
					}
				}
			} else if ($status == 2) {
				//blocking the user ( Follower & Following ) based decrease the count
				$check_login_follower = \DB::table('user_connection')->where('user_id', '=', $request->user_id)->where('friend_id', '=', $request->member_id)->first();
				$check_login_following = \DB::table('user_connection')->where('user_id', '=', $request->member_id)->where('friend_id', '=', $request->user_id)->first();

				if ($check_login_follower) {
					$values = array('user_id' => $request->member_id, 'status' => 2, 'follow' => 0, 'blocked_by' => $request->user_id, 'friend_id' => $request->user_id, 'created_at' => $current_time);
					\DB::table('user_connection')->insert($values);
				} else if ($check_login_following) {
					$values = array('user_id' => $request->user_id, 'status' => 2, 'follow' => 0, 'blocked_by' => $request->user_id, 'friend_id' => $request->member_id, 'created_at' => $current_time);
					\DB::table('user_connection')->insert($values);
				}

				$block_follower_check = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `user_id`="' . $request->member_id . '" AND `friend_id`="' . $request->user_id . '" AND `follow`=1 '));
				$block_following_check = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `friend_id`="' . $request->member_id . '" AND `user_id`="' . $request->user_id . '" AND `follow`=1 '));

				if ($block_follower_check) {
					//Follower User
					\DB::select(\DB::raw('UPDATE `user_connection` SET `status`="2",`blocked_by`="' . $request->user_id . '" WHERE `user_id`="' . $request->member_id . '" AND `friend_id`="' . $request->user_id . '" '));

					$getFollowerCount = \DB::table('users')->select('follower_count')->where('id', '=', $request->user_id)->get();
					$getFollowingCount = \DB::table('users')->select('following_count')->where('id', '=', $request->member_id)->get();
					// Count decrease in User ID
					if ($getFollowerCount[0]->follower_count != 0) {
						$follower_update['follower_count'] = $getFollowerCount[0]->follower_count - 1;
						\DB::table('users')->where('id', $request->user_id)->update($follower_update);
					}
					// Count decrease in Member ID
					if ($getFollowingCount[0]->following_count != 0) {
						$following_update['following_count'] = $getFollowingCount[0]->following_count - 1;
						\DB::table('users')->where('id', $request->member_id)->update($following_update);
					}
				}
				if ($block_following_check) {
					//Following User
					\DB::select(\DB::raw('UPDATE `user_connection` SET `status`="2",`blocked_by`="' . $request->user_id . '" WHERE `friend_id`="' . $request->member_id . '" AND `user_id`="' . $request->user_id . '" '));

					$getFollowerCount = \DB::table('users')->select('following_count')->where('id', '=', $request->user_id)->get();
					$getFollowingCount = \DB::table('users')->select('follower_count')->where('id', '=', $request->member_id)->get();
					// Count decrease in User ID
					if ($getFollowerCount[0]->following_count != 0) {
						$follower_update['following_count'] = $getFollowerCount[0]->following_count - 1;
						\DB::table('users')->where('id', $request->user_id)->update($follower_update);
					}
					// Count decrease in Member ID
					if ($getFollowingCount[0]->follower_count != 0) {
						$following_update['follower_count'] = $getFollowingCount[0]->follower_count - 1;
						\DB::table('users')->where('id', $request->member_id)->update($following_update);
					}
				}
				if (!$block_following_check && !$block_follower_check) {
					$followervalues = array('user_id' => $request->member_id, 'blocked_by' => $request->user_id, 'status' => $request->type, 'follow' => 0, 'friend_id' => $request->user_id, 'updated_at' => $current_time);
					\DB::table('user_connection')->insert($followervalues);
					$followingvalues = array('user_id' => $request->user_id, 'blocked_by' => $request->user_id, 'status' => $request->type, 'follow' => 0, 'friend_id' => $request->member_id, 'updated_at' => $current_time);
					\DB::table('user_connection')->insert($followingvalues);
				}
				$message = 'Blocked successfully';
				$is_block = 1;
			} else if ($status == 3) {
				\DB::select(\DB::raw('DELETE FROM `user_connection`  WHERE `user_id`="' . $request->user_id . '" AND `friend_id`="' . $request->member_id . '" '));
				$update_with_condition1 = 'IF(`following_count` - 1 < 0, 0, `following_count` - 1)';
				$update_with_condition2 = 'IF(`follower_count` - 1 < 0, 0, `follower_count` - 1)';
				\DB::select(\DB::raw("UPDATE `users` SET `following_count` = {$update_with_condition1} WHERE `id` = '" . $request->user_id . "'"));
				\DB::select(\DB::raw("UPDATE `users` SET `follower_count` = {$update_with_condition2} WHERE `id` = '" . $request->member_id . "'"));
				$user_follow_status = 0;
				$message = 'unfollow successfully';
			} else if ($status == 4) {
				$connection_follower_details = \DB::table('user_connection')->select('id')->where('user_id', '=', $request->member_id)->where('friend_id', '=', $request->user_id)->where('status', '=', 2)->where('follow', '=', 0)->first();
				if ($connection_follower_details) {
					\DB::select(\DB::raw('DELETE FROM `user_connection` WHERE `id`="' . $connection_follower_details->id . '" '));
				}
				$connection_following_details = \DB::table('user_connection')->select('id')->where('user_id', '=', $request->user_id)->where('friend_id', '=', $request->member_id)->where('status', '=', 2)->where('follow', '=', 0)->first();
				if ($connection_following_details) {
					\DB::select(\DB::raw('DELETE FROM `user_connection` WHERE `id`="' . $connection_following_details->id . '" '));
				}
				// unblocking user
				$is_follower_blocked = \DB::table('user_connection')->where('user_id', '=', $request->member_id)->where('friend_id', '=', $request->user_id)->where('status', '=', 2)->first();
				$is_following_blocked = \DB::table('user_connection')->where('user_id', '=', $request->user_id)->where('friend_id', '=', $request->member_id)->where('status', '=', 2)->first();

				if ($is_follower_blocked) {

					\DB::select(\DB::raw('UPDATE `user_connection` SET `status`="1" WHERE `user_id`="' . $request->member_id . '" AND `friend_id`="' . $request->user_id . '" '));

					$getFollowerCount = \DB::table('users')->select('follower_count')->where('id', '=', $request->user_id)->get();
					$getFollowingCount = \DB::table('users')->select('following_count')->where('id', '=', $request->member_id)->get();
					// Count increase in User ID
					$follower_update['follower_count'] = $getFollowerCount[0]->follower_count + 1;
					\DB::table('users')->where('id', $request->user_id)->update($follower_update);
					// Count increase in Member ID
					$following_update['following_count'] = $getFollowingCount[0]->following_count + 1;
					\DB::table('users')->where('id', $request->member_id)->update($following_update);
				}
				if ($is_following_blocked) {
					\DB::select(\DB::raw('UPDATE `user_connection` SET `status`="1" WHERE `user_id`="' . $request->user_id . '" AND `friend_id`="' . $request->member_id . '" '));

					$getFollowerCount = \DB::table('users')->select('following_count')->where('id', '=', $request->user_id)->get();
					$getFollowingCount = \DB::table('users')->select('follower_count')->where('id', '=', $request->member_id)->get();
					// Count increase in User ID
					$follower_update['following_count'] = $getFollowerCount[0]->following_count + 1;
					\DB::table('users')->where('id', $request->user_id)->update($follower_update);
					// Count increase in Member ID
					$following_update['follower_count'] = $getFollowingCount[0]->follower_count + 1;
					\DB::table('users')->where('id', $request->member_id)->update($following_update);
				}
				$message = 'Unblocked successfully';
			}

			return response()->json([
				'status' => $success_status,
				'message' => $message,
				'user_follow_status' => $user_follow_status,
				'is_block' => $is_block,
			]);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		    * This is the function for getting Blocked list of users.
			* It will be called while user viewing blocked user list from mobile application.
	*/

	function getBlock_list(Request $request) {

		$user_exist = \DB::table('users')->where('id', $request->user_id)->first();
		if (!$user_exist) {
			return response()->json(array(
				'status' => false,
				'status_message' => 'User does not exist',
			));
		} else {
			if ($user_exist->password != $request->access_token) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'invalid access token',
				));
			}
			if ($request->page_no == "" || $request->page_no == 0) {
				return response()->json(array(
					'status' => false,
					'status_message' => 'page no is required',
				));
			}
		}
		$language = $request->input('language');
		if (isset($language)) {
			$updatelang = \DB::table('users')->where('id', $request->user_id)->update(array('language' => $request->input('language')));
		}
		$start = $request->page_no == 1 ? 0 : 10 * ($request->page_no - 1);
		$user_block = array();
		$total_count = \DB::table('user_connection')->select('user_id')->groupby('user_id')->where('friend_id', '=', $request->user_id)->where('status', '=', 2)->where('blocked_by', $request->user_id)->count();
		$block_details = \DB::table('user_connection')->select('user_id')
			->where('friend_id', $request->user_id)
			->where('status', 2)
			->where('blocked_by', $request->user_id)
			->groupby('user_id')
			->skip($start)->limit(10)->get();

		if (count($block_details) > 0) {
			foreach ($block_details as $block_list) {
				$user = \DB::table('users')->where('id', '=', $block_list->user_id)->first();
				$baseurl = \bsetecHelpers::getProfilePicture($user->id, $user);
				$user_block[] = [
					'id' => $user->id,
					'name' => $user->username,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'email' => $user->email,
					'profile_pic' => $baseurl,
					'country' => $user->country,
					'state' => $user->state,
				];
			}
			return response()->json(array(
				'status' => true,
				'result' => $user_block,
				'total_count' => $total_count,
			));
		} else {
			return response()->json(array(
				'status' => true,
				'result' => $user_block,
				'errors' => 'no more block',
			));
		}
	}

	/*
		    * Forgot password - mail will send to email.
			* It will be called while user tries to give forget password from mobile application.
	*/

	public function postForgotpassword(Request $request) {
		$rules = array(
			'email' => 'required|email',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {

			$user_exist = Users::where('email', $request->input('email'))->first();
			if (count($user_exist) > 0) {
				$six_digit_random_number = mt_rand(100000, 999999);
				$newpassword = app('hash')->make($six_digit_random_number);
				$language = $request->input('language');
				if (isset($language)) {
					Users::where('email', $request->input('email'))->update(['password' => $newpassword, 'language' => $request->input('language')]);
				} else {
					Users::where('email', $request->input('email'))->update(['password' => $newpassword]);
				}

				//MAIL FUNCTIONALITY
				//MAIL FUNCTIONALITY
				$to = $request->input('email');
				$pass = $six_digit_random_number;

				$getoptionAll = \DB::table('options')->select('*')->get();
				$optionResult = [
					'app_name' => $getoptionAll[0]->option,
					'logo_url' => $getoptionAll[2]->option,
					'email' => $getoptionAll[1]->option,
				];
				$logoImage = "uploads/images/logo/" . $optionResult['logo_url'];
				$this->commonService->getMail($optionResult['email'], $request->input('email'), "Forgot Password Mail", ['logo' => $logoImage, 'username' => $user_exist->username, 'sitename' => $optionResult['app_name'], 'password' => $pass], 'email.forgot');

				return response()->json(array(
					'status' => true,
					'status_message' => 'New Password generated.You have been recognized as a member and your account details have just been sent to your mail.',
				));
			} else {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'status_message' => $validator->getMessageBag()->toArray(),
			));
		}
	}

	/*
		     * Admin account forgot password - mail will send to email
	*/

	public function postAdminforgotpassword(Request $request) {
		$rules = array(
			'email' => 'required|email',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {

			$user_exist = Users::where('email', $request->input('email'))->first();
			if (count($user_exist) > 0) {
				$role = $user_exist->role;
				if ($role == 1) { // role = 1 means Admin, role = 2 means Norma User.
					$six_digit_random_number = mt_rand(100000, 999999);
					$newpassword = app('hash')->make($six_digit_random_number);
					$language = $request->input('language');
					if (isset($language)) {
						Users::where('email', $request->input('email'))->update(['password' => $newpassword, 'language' => $request->input('language')]);
					} else {
						Users::where('email', $request->input('email'))->update(['password' => $newpassword]);
					}

					//MAIL FUNCTIONALITY
					$to = $request->input('email');
					$pass = $six_digit_random_number;
					$getoptionAll = \DB::table('options')->select('*')->get();
					$optionResult = [
						'app_name' => $getoptionAll[0]->option,
						'logo_url' => $getoptionAll[2]->option,
						'email' => $getoptionAll[1]->option,
					];
					$logoImage = "uploads/images/logo/" . $optionResult['logo_url'];
					$this->commonService->getMail($optionResult['email'], $request->input('email'), "Forgot Password Mail", ['logo' => $logoImage, 'username' => $user_exist->username, 'sitename' => $optionResult['app_name'], 'password' => $pass], 'email.forgot');

					return response()->json(array(
						'status' => true,
						'status_message' => 'New Password generated.You have been recognized as a member and your account details have just been sent to your mail.',
					));
				} else {
					return response()->json(array(
						'status' => false,
						'status_message' => 'Not recognized as admin user',
					));
				}

			} else {
				return response()->json(array(
					'status' => false,
					'status_message' => 'User does not exist',
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'status_message' => $validator->getMessageBag()->toArray(),
			));
		}
	}

	/*
		     * This is the function for getting Following list
			 * It will be called while user viewing following user list from mobile application.
	*/

	public function getFollowing_list(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$iPerPage = 10;
			$followings_info = $this->users->myfollowings($request, $iPerPage);
			if (count($followings_info['my_followings']) > 0) {

				return response()->json(array(
					'status' => true,
					'result' => $followings_info['my_followings'],
					'total_count' => $followings_info['count'],
					'no_page' => $followings_info['no_page'])
					, 200);
			} else {
				return response()->json(array(
					'status' => true,
					'result' => $followings_info['my_followings'],
					'total_count' => 0,
					'errors' => 'No More Following Persons',
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		    * This is the function for getting Followers list
			* It will be called while user viewing Followers user list from mobile application.
	*/

	public function getFollowers_list(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$iPerPage = 10;
			$followers_info = $this->users->myfollowers($request, $iPerPage);
			if (count($followers_info['my_followers']) > 0) {
				if ($request['record'] == 'all') {
					return response()->json(array(
						'status' => true,
						'result' => $followers_info['my_followers'])
						, 200);
				} else {
					return response()->json(array(
						'status' => true,
						'result' => $followers_info['my_followers'],
						'total_count' => $followers_info['count'],
						'no_page' => $followers_info['no_page'])
						, 200);
				}
			} else {
				return response()->json(array(
					'status' => true,
					'result' => $followers_info['my_followers'],
					'total_count' => 0,
					'errors' => 'No More Follower Persons',
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		     * This is the function for Send mail with given subject and message
	*/

	public function postSend_mail(Request $request) {
		$member_id = $request->input('member_id');
		$rules = array(
			'member_id' => 'required',
			'subject' => 'required',
			'message' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			if (empty($email_id)) {
				$my_details = \DB::table('users')->where('id', $member_id)->get();
				$email = $my_details[0]->email;
			} else {
				$email = $email_id;
			}
			$from = "jeyakumar@bsetec.com";
			$to = $email;
			$subject = $request->input('subject');
			$message = $request->input('message');
			$headers = "From:" . $from;
			if (mail($to, $subject, $message, $headers)) {
				return response()->json(array(
					'status' => true,
					'status_message' => 'Your mail has been send.',
				));
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'mail not sending',
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		     * This is the function for getting Notifications
			 * It will be called while user viewing You/Follow notification list from mobile application.
	*/

	public function getNotification(Request $request) {
		echo "string";
		exit();
		$iPerPage = 10;
		$notify_info = $this->users->getNotifications($request, $iPerPage);
		if (count($notify_info) > 0) {

			return response()->json(array(
				'status' => true,
				'result' => $notify_info)
				, 200);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => 'No more notifications',
			));
		}
	}

	/*
		     * This is the function for Delete user
	*/

	public function postDelete_user(Request $request) {

		$u_id = $request->input('u_id');
		$rules = array(
			'u_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$toDelete = $this->users->deleteUser($request);
			$message = 'Something went wrong, Please try again later.';
			if ($toDelete) {
				$status = true;
				$message = 'User has been deleted successfully.';
			} else {
				$status = false;
			}
			return response()->json(array(
				'status' => $status,
				'message' => $message)
				, 200);
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for Social network login/signup authentication from mobile application.
	*/

	function postOauth(Request $request) {
		$rules = array(
			'auth_id' => 'required',
			'auth_type' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$exist = '';
			if ($request->auth_type == 'facebook') {
				$exist = \DB::table('user_social')->where('fb_id', '=', $request->auth_id)->first();
			} elseif ($request->auth_type == 'twitter') {
				$exist = \DB::table('user_social')->where('twitter_id', '=', $request->auth_id)->first();
			} elseif ($request->auth_type == 'google') {
				$exist = \DB::table('user_social')->where('google_id', '=', $request->auth_id)->first();
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Invalid oatuh type',
				));
			}
			if ($exist) {
				$user_exist = Users::where('id', $exist->user_id)->first();
				if (count($user_exist) > 0) {
					if ($user_exist->status_active == 'inactive') {
						return response()->json(array(
							'status' => false,
							'status_message' => 'Your account is suspend by Admin',
						));
					}
					return $this->loginoauth($exist->user_id, $request->input('device_token'), $request->input('device_type'), $request->input('player_id'), $request);
				} else {
					\DB::table('user_social')->where('user_id', $exist->user_id)->delete();
					return $this->emailupdateorsignup($request->all());
				}
			} else {
				return $this->emailupdateorsignup($request->all());
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		    * This is the function for Social network login from mobile application.
	*/

	function loginoauth($id, $device_token = '', $device_type = '', $player_id = '', $request) {
		$user_exist = Users::where('id', $id)->first();
		$update = array();
		if ($device_token && $device_type) {
			$update['device_token'] = $device_token;
			$update['device_type'] = $device_type;
			$update['player_id'] = $player_id;
			\DB::table('users')->where('id', $user_exist->id)->update($update);
		} else if ($player_id) {
			$update['player_id'] = $player_id;
			\DB::table('users')->where('id', $user_exist->id)->update($update);
		}
		$profile_pic = \bsetecHelpers::getProfilePicture($user_exist->id, $user_exist);
		$path = rtrim(url('/'));

		$unread_count = \DB::table('notification')
			->join('users', 'users.id', '=', 'notification.sender')
			->where('notification.receiver', '=', $user_exist->id)
			->where('notification.status', '=', 0)
			->where('notification.push_status', '=', 1)
			->count();
		$baseurl = $profile_pic;
		$user_data = array();
		$user_data['id'] = $user_exist->id;
		$user_data['first_name'] = $user_exist->first_name;
		$user_data['last_name'] = $user_exist->last_name;
		$user_data['username'] = $user_exist->username;
		$user_data['email'] = $user_exist->email;
		$user_data['access_token'] = $user_exist->password;
		$user_data['state'] = $user_exist->state;
		$user_data['country'] = $user_exist->country;
		$user_data['dob'] = $user_exist->dob ? $user_exist->dob : '';
		$user_data['gender'] = $user_exist->gender ? $user_exist->gender : '';
		$user_data['description'] = $user_exist->description ? $user_exist->description : '';
		$user_data['role'] = $user_exist->role;
		$user_data['is_private'] = $user_exist->is_private;
		$user_data['is_notify'] = $user_exist->is_notify;
		$user_data['follower_count'] = $user_exist->follower_count;
		$user_data['following_count'] = $user_exist->following_count;
		$user_data['post_count'] = $user_exist->post_count;
		$user_data['profile_pic'] = $baseurl;
		$user_data['unread_count'] = (int) $unread_count;
		return response()->json(array(
			'status' => true,
			'status_message' => 'Successfully logged in',
			'details' => $user_data,
		));
	}

	/*
		     * This is the function for Email signup from mobile application.
	*/

	function emailupdateorsignup($request) {
		if (empty($request['language'])) {
			$request['language'] = "en";
		}
		if (!empty($request['email'])) {
			$email_exist = \DB::table('users')->where('email', $request['email'])->first();
			if (count($email_exist) > 0) {
				$data = array();
				$data['user_id'] = $email_exist->id;
				if ($request['auth_type'] == 'facebook') {
					$data['fb_id'] = $request['auth_id'];
				} else if ($request['auth_type'] == 'twitter') {
					$data['twitter_id'] = $request['auth_id'];
				} else if ($request['auth_type'] == 'google') {
					$data['google_id'] = $request['auth_id'];
				}
				$data['updated_at'] = \DB::raw('CURRENT_TIMESTAMP');
				$data['created_at'] = \DB::raw('CURRENT_TIMESTAMP');
				\DB::table('user_social')->insert($data);
				$device_token = $device_type = '';
				if (isset($request['device_token'])) {
					$device_token = $request['device_token'];
				}
				if (isset($request['device_type'])) {
					$device_type = $request['device_type'];
				}
				if (isset($request['player_id'])) {
					$player_id = $request['player_id'];
				}

				return $this->loginoauth($email_exist->id, $device_token, $device_type, $player_id, $request);
			} else {
				$user_exist = \DB::table('users')->where('email', $request['email'])->first();
				if (isset($user_exist->id)) {
					$request['username'] = rand();
					if (isset($request['language'])) {
						Users::where('id', $user_exist->id)->update(['language' => $request['language']]);
					}
				}
				$data = array();
				$data['first_name'] = isset($request['first_name']) ? $request['first_name'] : '';
				$data['last_name'] = isset($request['last_name']) ? $request['last_name'] : '';
				$data['username'] = isset($request['username']) ? $request['username'] : rand();
				$data['email'] = isset($request['email']) ? $request['email'] : '';

				$passrandom = $data['password'] = app('hash')->make(rand());
				$data['state'] = isset($request['state']) ? $request['state'] : '';
				$data['country'] = isset($request['country']) ? $request['country'] : '';
				$data['role'] = '2'; // role = 1 means Admin, role = 2 means Norma User.
				$data['device_type'] = isset($request['device_type']) ? $request['device_type'] : '';
				$data['device_token'] = isset($request['device_token']) ? $request['device_token'] : '';
				$data['updated_at'] = \DB::raw('CURRENT_TIMESTAMP');
				$data['created_at'] = \DB::raw('CURRENT_TIMESTAMP');
				if (isset($request['profile_pic']) && $request['profile_pic'] != "") {
					$data['profile_pic'] = $request['profile_pic'];
				} else {
					$data['profile_pic'] = '';
				}
				if (count($user_exist) == 0) {
					$user_id = \DB::table('users')->insertGetId($data);
				} else {
					$user_id = $user_exist->id;
					\DB::table('users')->where('id', $user_id)->update($data);
				}
				if (!empty($user_id)) {
					$member = array();
					$member['user_id'] = $user_id;
					$member['start_date'] = date('Y-m-d');
					$member['role_id'] = '2'; // role = 1 means Admin, role = 2 means Norma User.

					$auth_data = array();
					$auth_data['user_id'] = $user_id;
					if ($request['auth_type'] == 'facebook') {
						$auth_data['fb_id'] = $request['auth_id'];
					} else if ($request['auth_type'] == 'twitter') {
						$auth_data['twitter_id'] = $request['auth_id'];
					} else if ($request['auth_type'] == 'google') {
						$auth_data['google_id'] = $request['auth_id'];
					}

					$us_social = \DB::table('user_social')->where('user_id', $user_id)->get();
					if (count($us_social) > 0) {
						$us_id = $us_social->id;
						$auth_data['updated_at'] = date('Y-m-d H:i:s');
						\DB::table('user_social')->where('id', $us_id)->update($auth_data);
					} else {
						$auth_data['created_at'] = date('Y-m-d H:i:s');
						\DB::table('user_social')->insertGetId($auth_data);
					}

					$path = rtrim(url('/'));
					$data['profile_pic'] = \bsetecHelpers::getProfilePicture($user_id, (object) $request);
					$baseurl = $data['profile_pic'];
					$user_data = array();
					$user_data['id'] = $user_id;
					$user_data['first_name'] = isset($request['first_name']) ? $request['first_name'] : '';
					$user_data['last_name'] = isset($request['last_name']) ? $request['last_name'] : '';
					$user_data['username'] = isset($request['username']) ? $request['username'] : '';
					$user_data['email'] = isset($request['email']) ? $request['email'] : '';
					$user_data['access_token'] = $data['password'];
					$user_data['state'] = isset($request['state']) ? $request['state'] : '';
					$user_data['country'] = isset($request['country']) ? $request['country'] : '';
					$user_data['dob'] = isset($request['dob']) ? $request['dob'] : '';
					$user_data['gender'] = isset($request['gender']) ? $request['gender'] : '';
					$user_data['description'] = isset($request['description']) ? $request['description'] : '';
					$user_data['is_private'] = '0'; // is_private = 0 means public profile, is_private = 1 means Private profile.
					$user_data['is_notify'] = '1'; // is_notify = 0 means user restricted notifications, is_notify = 1 means user allowed notifications.
					$user_data['follower_count'] = '0'; //While create new user, we will set follower count as 0
					$user_data['following_count'] = '0'; //While create new user, we will set following count as 0
					$user_data['post_count'] = '0'; //While create new user, we will set post count as 0
					$user_data['role'] = '2'; // role = 1 means Admin, role = 2 means Norma User.
					$user_data['profile_pic'] = $baseurl;
					$user_data['unread_count'] = 0;
					return response()->json(array(
						'status' => true,
						'status_message' => 'User Successfully registered',
						'details' => $user_data,
					));
				} else {
					return response()->json(array(
						'status' => false,
						'status_message' => 'Not successfully registered!',
					));
				}
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => 'User does not exist',
			));
		}
	}

	/*
	 * This is the function for getting follower request list which is used from mobile application.
	 */

	public function getrequestlist(Request $request) {

		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$result = $this->users->getfollowerrequest($request);
			$language = $request->input('language');
			if (isset($language)) {
				$updatelang = \DB::table('users')->where('id', $request->input('user_id'))->update(array('language' => $request->input('language')));
			}
			return response()->json(array(
				'status' => true,
				'result' => $result['request_list'],
				'total_count' => $result['total_count'],
				'no_page' => $result['no_page'],
			));
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/* This is the function for Response to follower request ( accept or decline ) */

	public function postresponsestatus(Request $request) {
		$rules = array(
			'userid' => 'required',
			'access_token' => 'required',
			'connect_id' => 'required',
			'status' => 'required',
		);
		if ($request->status == "1") {
			$rules['follower_id'] = 'required';
		}
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$result = $this->users->postresponsestatus($request);
			$language = $request->input('language');
			if (isset($language)) {
				$updatelang = \DB::table('users')->where('id', $request->input('userid'))->update(array('language' => $request->input('language')));
			}
			return response()->json(array(
				'status' => true,
				'result' => $result,
			));
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting Notifications
			 * It will be called while user viewing You/Follow notification list from mobile application.
	*/

	public function getNotifications(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
			'type' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$result = $this->users->getNotificationsFeed($request);
			return response()->json($result);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for Update Notifcation status
		     * if notification_id given, we will change status as read for particular feed
		     * else, we will reset total unread count to 0
	*/

	public function postNotificationsupdate(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_id = $request->input('user_id');
			$notifications_id = $request->input('notification_id');
			if (!empty($notifications_id)) {
				$dats = explode(',', $notifications_id);
				foreach ($dats as $key => $value) {
					$update = array('status' => 1, 'push_status' => 1, 'updated_at' => date('Y-m-d H:i:s'));
					\DB::table('notification')->where('id', $value)->update($update);
					$getUnCount = \DB::table('users')->select('unread_count')->where('id', '=', $user_id)->get();
					if ($getUnCount[0]->unread_count != 0) {
						$u_update['unread_count'] = $getUnCount[0]->unread_count - 1;
						\DB::table('users')->where('id', $user_id)->update($u_update);
					}
				}
				$uRec = \DB::table('users')
					->select('unread_count')
					->where('id', $user_id)
					->first();
				$unread_count = ($uRec->unread_count) ? $uRec->unread_count : 0;
			} else {
				$update = array('unread_count' => 0, 'updated_at' => date('Y-m-d H:i:s'));
				\DB::table('users')->where('id', $user_id)->update($update);
				$unread_count = 0;
			}
			return response()->json(array(
				'status' => true,
				'status_msg' => 'Update successfully',
				'unread_count' => (int) $unread_count,
			));
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for Update admin profile
	*/

	public function postUpdateadminprofile(Request $request) {

		$rules = array(
			'userid' => 'required',
			'access_token' => 'required',
			'email' => 'required|email|unique:users,email,' . $request->input('userid'),
			'first_name' => 'required',
			'last_name' => 'required',
			'username' => 'required|min:2|unique:users,username,' . $request->input('userid'),
			'country' => 'required',
			'gender' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = Users::where('id', $request->input('userid'))->first();
			if (!$user_exist) {
				return response()->json(array(
					'status' => false,
					'errors' => array('User does not exist'),
				));
			} else {
				if ($user_exist->password != $request->input('access_token')) {
					return response()->json(array(
						'status' => false,
						'errors' => array('invalid access token'),
					));
				}
				$update = array();
				if ($request->input('first_name')) {
					$update['first_name'] = $request->input('first_name');
				}
				if ($request->input('last_name')) {
					$update['last_name'] = $request->input('last_name');
				}
				if ($request->input('state')) {
					$update['state'] = $request->input('state');
				}
				if ($request->input('country')) {
					$update['country'] = $request->input('country');
				}
				if ($request->input('gender')) {
					$update['gender'] = $request->input('gender');
				}
				if ($request->has('profile_pic')) {
					$update['profile_pic'] = $request->input('profile_pic');
				}
				if ($request->has('username')) {
					$update['username'] = $request->input('username');
				}
				if ($request->has('email')) {
					$update['email'] = $request->input('email');
				}

				$update['updated_at'] = \DB::raw('CURRENT_TIMESTAMP');
				if (count($update) > 0) {
					\DB::table('users')->where('id', $user_exist->id)->update($update);
				}

				$profile = Users::where('id', $request->input('userid'))->first();
				$user_data = array();
				$user_data['id'] = $profile->id;
				$user_data['first_name'] = $profile->first_name;
				$user_data['last_name'] = $profile->last_name;
				$user_data['username'] = $profile->username;
				$user_data['email'] = $profile->email;
				$user_data['access_token'] = $profile->password;
				$user_data['state'] = $profile->state;
				$user_data['country'] = $profile->country;
				$user_data['dob'] = $user_exist->dob;
				$user_data['gender'] = $user_exist->gender;
				$user_data['description'] = $user_exist->description;
				$user_data['role'] = $profile->role;
				$user_data['is_private'] = $profile->is_private;
				$user_data['is_notify'] = $profile->is_notify;
				$user_data['follower_count'] = $profile->follower_count;
				$user_data['following_count'] = $profile->following_count;
				$user_data['post_count'] = $profile->post_count;
				$user_data['profile_pic'] = \bsetecHelpers::getProfilePicture($profile->id, $profile);
				return response()->json(array(
					'status' => true,
					'status_message' => 'Successfully profile updated',
					'details' => $user_data,
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/* This is the function for getting member follower list from admin back-end */

	public function getMemberFollowers_list(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$iPerPage = 5;
			$followers_info = $this->users->memberfollowers($request, $iPerPage);
			if (count($followers_info['my_followers']) > 0) {
				if ($request['record'] == 'all') {
					return response()->json(array(
						'status' => true,
						'result' => $followers_info['my_followers'])
						, 200);
				} else {
					return response()->json(array(
						'status' => true,
						'result' => $followers_info['my_followers'],
						'total_count' => $followers_info['count'],
						'no_page' => $followers_info['no_page'])
						, 200);
				}
			} else {
				return response()->json(array(
					'status' => true,
					'result' => $followers_info['my_followers'],
					'total_count' => 0,
					'errors' => 'No More Follower Persons',
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/* This is the function for getting member following list from admin back-end */

	public function getMemberFollowing_list(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$iPerPage = 5;
			$followings_info = $this->users->memberfollowings($request, $iPerPage);
			if (count($followings_info['my_followings']) > 0) {

				return response()->json(array(
					'status' => true,
					'result' => $followings_info['my_followings'],
					'total_count' => $followings_info['count'],
					'no_page' => $followings_info['no_page'])
					, 200);
			} else {
				return response()->json(array(
					'status' => true,
					'result' => $followings_info['my_followings'],
					'total_count' => 0,
					'errors' => 'No More Following Persons',
				));
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/* This is the function for user active&deactive option in admin back-end */
	public function userStatusupdate(Request $request) {
		$rules = array(
			'userid' => 'required',
			'access_token' => 'required',
			'member_id' => 'required',
			'status' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$toInfo = $this->users->updateUserStatus($request);
			return response()->json(array(
				'status' => true,
				'message' => 'User has been updated successfully',
			)
				, 200);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/* This is the function for Site general setting in admin back-end */
	public function postgeneralSetting(Request $request) {
		$resultGeneralSave = $this->users->actiongeneral($request);
		return $request;
	}

	/* This is the function for Site mail setting in admin back-end - start */
	public function postmailSetting(Request $request) {
		$resultGeneralSave = $this->users->actionmailsetting($request);
		return $request;
	}
/* This is the function for mail template update in admin back-end - start */
	public function postTemplateUpdate(Request $request) {
		$resultGeneralSave = $this->users->actionmailtemplate($request);
		return $request;
	}
	/* Site mail setting in admin back-end - end */

	/**
	 * This is the function for getting general settings data (app name, email, logo & favi image).
	 * These values are dynamic data which is managed from Admin panel.
	 */
	
	public function getGeneralData(Request $request) {
		$getAll = \DB::table('options')->select('*')->get();
		$result = [
			'app_name' => $getAll[0]->option,
			'email' => $getAll[1]->option,
			'logo_url' => $getAll[2]->option,
			'favi_url' => $getAll[3]->option,
			'notification_flush' => $getAll[4]->option,
			'onesignal_appid' => $getAll[10]->option,
			'onesignal_appkey' => $getAll[11]->option,
		];
		return response()->json($result, 200);
	}

	/* This is the function for Site mail setting in admin back-end - start */
	public function getMailSettingData(Request $request) {
		$getAll = \DB::table('options')->select('*')->get();
		$result = [
			'smtp_host' => $getAll[5]->option,
			'smtp_port' => $getAll[6]->option,
			'smtp_username' => $getAll[7]->option,
			'smtp_password' => $getAll[8]->option,
			'smtp_secure' => $getAll[9]->option,
		];
		return response()->json($result, 200);
	}
	/**This is the function for getting mail template from Admin panel */
	public function getMailTemplateData(Request $request) {
		$register_template = file_get_contents(base_path() . "/resources/views/email/register.blade.php");
		$forgot_template = file_get_contents(base_path() . "/resources/views/email/forgot.blade.php");
		$postready_template = file_get_contents(base_path() . "/resources/views/email/post_is_ready.blade.php");
		$common_post_template = file_get_contents(base_path() . "/resources/views/email/common_post.blade.php");
		$report_post_template = file_get_contents(base_path() . "/resources/views/email/post_abuse.blade.php");

		$result = [
			'register_template' => $register_template,
			'forgot_template' => $forgot_template,
			'post_ready' => $postready_template,
			'common_post' => $common_post_template,
			'report_post' => $report_post_template,
		];
		return response()->json($result, 200);
	}
	/* Site mail setting in admin back-end - end */

}
