<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Controller : Dashboard Controller
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */

namespace App\Http\Controllers;
use App\Models\Dashboard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use Response;
use Validator;

class DashboardController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->dashboard = new Dashboard();
	}

	/**
	 * This is the function for Getting admin side dashboard details
	 */

	public function getDashboardDetails(Request $request) {
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

			$page_no = '';

			if (!$page_no) {
				$page_start = 0;
			} else {
				$page_start = 0;
				if ($page_no > 1) {
					$page_start = (($page_no - 1) * 10);
				}
			}
			$total = $totalvideo = $totalphoto = $totalvideo = $todayUserCount = $totalandroid = $totaliphone = 0;
			$login_id = $request->user_id;
			$language = $request->input('language');
			if (isset($language)) {
				$updatelang = \DB::table('users')->where('id', $login_id)->update(array('language' => $request->input('language')));
			}
			$user = \DB::table('users')->skip($page_start)->limit(5)->orderBy('id', 'DESC')->get();
			$total = \DB::table('users')->count();
			$user_list = array();

			if (count($user) > 0) {
				$page_no = (int) $page_no;
				$total = \DB::table('users')->count();
				$totalandroid = \DB::table('users')->where('device_type', 'android')->count();
				$totaliphone = \DB::table('users')->where('device_type', 'iphone')->count();
				$totalpost = \DB::table('posts')->count();
				$totalvideo = \DB::table('posts')->where('post_type', 'video')->count();
				$totalphoto = \DB::table('posts')->where('post_type', 'photo')->count();
				$start = \Carbon\Carbon::parse()->startOfDay();
				$end = \Carbon\Carbon::parse()->endOfDay();
				$todayUserCount = \DB::table('users')->select('users.created_at')
					->whereBetween('users.created_at', [$start, $end])->count();
				$todayPostCount = \DB::table('posts')
					->select('posts.created_at')
					->whereBetween('posts.created_at', [$start, $end])
					->count();
				$todayCommentCount = \DB::table('post_comment')
					->select('post_comment.created_at')
					->whereBetween('post_comment.created_at', [$start, $end])
					->count();
				$todayLikeCount = \DB::table('post_like')
					->select('post_like.created_at')
					->whereBetween('post_like.created_at', [$start, $end])
					->count();
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
						'follower_count' => $value->follower_count,
						'following_count' => $value->following_count,
						'post_count' => $value->post_count,
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
				'total_post' => $totalpost,
				'total_video' => $totalvideo,
				'total_photo' => $totalphoto,
				'total_iphone' => $totaliphone,
				'total_android' => $totalandroid,
				'today_user_count' => $todayUserCount,
				'today_post_count' => $todayPostCount,
				'today_like_count' => $todayLikeCount,
				'total_cmt_count' => $todayCommentCount,
			]);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			));
		}
	}

	/*
		     * This is the function for Admin panel - post and users count with time filter
	*/

	public function getAdminpostusercount(Request $request) {
		$rules = array(
			'user_id' => 'required',
			'access_token' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$dateCount = 0;
			$status = false;
			$message = 'Something went wrong, Please try again later.';
			if ($request['type'] == 'today') {
				for ($i = 0; $i < 24; $i++) {
					$start = \Carbon\Carbon::parse()->startOfDay()->addHour($i);
					$end = \Carbon\Carbon::parse()->startOfDay()->addHour($i + 1);
					$resultData = $this->dashboard->retrunPostUserData($start, $end);
					$postData[$i] = $resultData['post_count'];
					$userData[$i] = $resultData['user_count'];
				}
			} else if ($request['type'] == 'yesterday') {
				for ($i = 0; $i < 24; $i++) {
					$start = \Carbon\Carbon::parse()->yesterday()->addHour($i);
					$end = \Carbon\Carbon::parse()->yesterday()->addHour($i + 1);
					$resultData = $this->dashboard->retrunPostUserData($start, $end);
					$postData[$i] = $resultData['post_count'];
					$userData[$i] = $resultData['user_count'];
				}
			} else if ($request['type'] == 'lastweek') {
				for ($i = 0; $i < 7; $i++) {
					$start = \Carbon\Carbon::parse()->subDays(7)->addDays($i);
					$end = \Carbon\Carbon::parse()->subDays(7)->addDays($i + 1);
					$resultData = $this->dashboard->retrunPostUserData($start, $end);
					$postData[$i] = $resultData['post_count'];
					$userData[$i] = $resultData['user_count'];
				}
			} else if ($request['type'] == 'last30day') {
				for ($i = 0; $i < 30; $i++) {
					$start = \Carbon\Carbon::parse()->subDays(30)->addDays($i);
					$end = \Carbon\Carbon::parse()->subDays(30)->addDays($i + 1);
					$resultData = $this->dashboard->retrunPostUserData($start, $end);
					$postData[$i] = $resultData['post_count'];
					$userData[$i] = $resultData['user_count'];
				}
			} else if ($request['type'] == 'thismonth') {
				$lastdate = new Carbon('last day of this month');
				for ($i = 0; $i < $lastdate->day; $i++) {
					$start = \Carbon\Carbon::parse()->startOfMonth()->addDays($i);
					$end = \Carbon\Carbon::parse()->startOfMonth()->addDays($i + 1);
					$resultData = $this->dashboard->retrunPostUserData($start, $end);
					$postData[$i] = $resultData['post_count'];
					$userData[$i] = $resultData['user_count'];
				}
			} else if ($request['type'] == 'lastmonth') {
				$lastdate = new Carbon('last day of last month');
				for ($i = 0; $i < $lastdate->day; $i++) {
					$start = \Carbon\Carbon::parse()->startOfMonth()->subMonth()->addDays($i);
					$end = \Carbon\Carbon::parse()->startOfMonth()->subMonth()->addDays($i + 1);
					$resultData = $this->dashboard->retrunPostUserData($start, $end);
					$postData[$i] = $resultData['post_count'];
					$userData[$i] = $resultData['user_count'];
				}
			} else if ($request['type'] == 'range') {
				$startdiff = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request['start']);
				$enddiff = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request['end']);
				$dateCount = $enddiff->diffInDays($startdiff);
				if ($dateCount == 0) {
					for ($i = 0; $i < 24; $i++) {
						$start = \Carbon\Carbon::parse($startdiff)->addHour($i);
						$end = \Carbon\Carbon::parse($startdiff)->addHour($i + 1);
						$resultData = $this->dashboard->retrunPostUserData($start, $end);
						$postData[$i] = $resultData['post_count'];
						$userData[$i] = $resultData['user_count'];
					}
				} else {
					for ($i = 0; $i < $dateCount; $i++) {
						$start = \Carbon\Carbon::parse($request['start'])->addDays($i)->format('Y-m-d H:i:s');
						$end = \Carbon\Carbon::parse($request['start'])->addDays($i + 1)->format('Y-m-d H:i:s');
						$startSelect = \Carbon\Carbon::parse($request['start'])->addDays($i + 1)->endOfDay()->format('Y-m-d H:i:s');
						$endSelect = \Carbon\Carbon::parse($request['end'])->format('Y-m-d H:i:s');

						$resultData = $this->dashboard->retrunPostUserData($start, $end);
						$postData[$i] = $resultData['post_count'];
						$userData[$i] = $resultData['user_count'];
					}
				}
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => $message,
				), 401);
			}
			return response()->json(array(
				'status' => true,
				'postdata' => $postData,
				'userdata' => $userData)
				, 200);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

}
