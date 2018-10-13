<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Controller : Post Controller
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use Validator;

class PostController extends Controller {

	public function __construct() {
		$this->post = new Post();
		$this->users = new Users();
	}

	/*
		     * This is the function for add post.
			 * It will be triggered while user add a new post from mobile application.
	*/

	function addPost(Request $request) {
		$user_id = $request->input('userid');
		$access_token = $request->input('access_token');
		$post_text = $request->input('post_text');
		$post_type = $request->input('post_type');
		$media_data = $request->input('media_data');
		$latitude = $request->input('latitude');
		$longitude = $request->input('longitude');
		$location = $request->input('location');
		$rules = array(
			'media_data' => 'required',
			'post_type' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		if ($validator->passes()) {
			$data = array();
			$data['user_id'] = $user_id;
			$data['post_text'] = $post_text;
			$data['post_type'] = $post_type;
			if (isset($latitude)) {
				$data['post_lat'] = $latitude;
			}
			if (isset($longitude)) {
				$data['post_lang'] = $longitude;
			}
			if (isset($location)) {
				$data['post_locations'] = $location;
			}
			$data['created_at'] = Carbon::now();
			$post_id = $this->post->insertPost($data);
			\DB::table('users')->where('id', $user_id)->increment('post_count', 1);
			$this->post->mediaSave($user_id, $post_id, $media_data);
			$this->users->pushupdate($user_id, 0, 'post_added', 'user added new post', $post_id);
			return response()->json(array(
				'status' => true,
				'status_message' => 'Post has been added successfully.',
				'posts' => $this->post->getPostInfo($user_id, $post_id),
			));
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for Post Actions.
			 * It will be triggered while deleting a post, like and unlike a post, add comment and edit comment from mobile application.
	*/
	public function postActionpost(Request $request) {

		$action_type = $request->input('action_type');
		$post_id = $request->input('post_id');
		//validation rules
		$rules = array(
			'post_id' => 'required',
			'action_type' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		//if validation passed, save into database
		if ($validator->passes()) {
			$comment_id = 0;
			$is_live = false;

			$toSave = $this->post->actionbt($request);
			$message = 'Something went wrong please try again later';
			if (!empty($toSave)) {
				$status = true;
				$s_post_id = $toSave;
				if ($action_type == 1) {
					if ($toSave == 'not_delete') {
						$status = false;
						$message = 'Only Post owner can delete their post.';
					} else {
						$message = 'Post has been deleted successfully.';
					}
				} elseif ($action_type == 2) {
					$message = 'Post like has been added successfully.';
				} elseif ($action_type == 3) {
					$comment_id = $s_post_id;
					$ct_id = $request->input('comment_id');
					$message = 'Post comment has been added successfully.';
					if (!empty($ct_id)) {
						$message = 'Post comment has been updated successfully.';
					}
				} elseif ($action_type == 4) {
					$message = 'Post comment has been deleted successfully.';
				}
			} else {
				$status = false;
				$s_post_id = 0;
			}

			return response()->json(array(
				'status' => $status,
				'post_id' => $post_id,
				'message' => $message,
				'comment_id' => $comment_id)
				, 200);
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting List of Comments inside specific post
			 * It will be triggered while viewing comments inside post from mobile application.
	*/

	public function getComments(Request $request) {

		$post_id = $request->input('post_id');
		$user_id = $request->input('user_id');
		$access_token = $request->input('access_token');
		$page_no = $request->input('page_no');
		$rules = array(
			'post_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$toInfo = $this->post->postcomments($post_id, $user_id, $access_token, $page_no);
			$status = true;
			if ($toInfo['count'] == 0) {
				$status = true;
			}
			return response()->json(array(
				'status' => $status,
				'result' => $toInfo['list'],
				'count' => $toInfo['count'],
				'no_page' => $toInfo['no_page'],
			)
				, 200);
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting list of posts
			 * It will be triggered while user viewing Home screen, Profile screen and post detail screen.
	*/

	public function getFeeds(Request $request) {
		$rules = array(
			'feed_type' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$toInfo = $this->post->getFeedsbyid($request);
			if ($toInfo == 'account_blocked') {
				return response()->json(array(
					'status' => false,
					'status_message' => 'Account blocked',
					'errorpage' => 404,
				));
			} else if ($toInfo == 'account_private') {
				return response()->json(array(
					'status' => false,
					'status_message' => 'Private Account. Can\'t view',
					'errorpage' => 404,
				));
			}
			$status = true;
			if ($toInfo['count'] == 0) {
				$status = true;
			}
			return response()->json(array(
				'status' => $status,
				'result' => $toInfo['list'],
				'count' => $toInfo['count'],
				'no_page' => $toInfo['no_page'],
			)
				, 200);
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for edit post.
			 * It will be triggered while user edit their post text from mobile application.
	*/

	public function postEditfeed(Request $request) {
		$rules = array(
			'userid' => 'required',
			'post_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$toInfo = $this->post->editPostFeedsbyid($request);
			return response()->json(array(
				'status' => true,
				'message' => 'Post has been updated successfully',
			)
				, 200);
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting media post listing.
			 * It will be triggered while viewing media posts from mobile application.
	*/

	public function getMediafeeds(Request $request) {
		$rules = array(
			'feed_type' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$toInfo = $this->post->getMediafeedsbyid($request);
			if ($toInfo == 'account_blocked') {
				return response()->json(array(
					'status' => false,
					'status_message' => 'Account blocked',
					'errorpage' => 404,
				));
			} else if ($toInfo == 'account_private') {
				return response()->json(array(
					'status' => false,
					'status_message' => 'Private Account. Can\'t view',
					'errorpage' => 404,
				));
			}
			$status = true;
			if ($toInfo['count'] == 0) {
				$status = true;
			}
			return response()->json(array(
				'status' => $status,
				'result' => $toInfo['list'],
				'count' => $toInfo['count'],
				'no_page' => $toInfo['no_page'],
			)
				, 200);
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting post like lists.
			 * It will be triggered while viewing likes list inside post from mobile application.
	*/

	public function getPostlikes(Request $request) {
		$rules = array(
			'post_id' => 'required|numeric',
			'user_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$toInfo = $this->post->getPostlikelists($request);
			$status = true;
			if ($toInfo['count'] == 0) {
				$status = true;
			}
			return response()->json(array(
				'status' => $status,
				'result' => $toInfo['list'],
				'count' => $toInfo['count'],
				'no_page' => $toInfo['no_page'],
			), 200);
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for posts list.
			 * It will be triggered while admin viewing posts list from admin Panel.
	*/

	public function getAdminpostlists(Request $request) {
		$rules = array(
			'user_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')
				->where('id', $request->user_id)
				->where('password', $request->access_token)
				->where('role', 1)
				->first();
			if (count($user_exist) > 0) {
				$toInfo = $this->post->getPostlists($request);
				$status = true;
				if ($toInfo['count'] == 0) {
					$status = false;
				}
				return response()->json(array(
					'status' => $status,
					'result' => $toInfo['list'],
					'count' => $toInfo['count'],
					'no_page' => $toInfo['no_page'],
				)
					, 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Invalid account',
				), 401);
			}
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for post details.
			 * It will be triggered while admin viewing post details from admin Panel.
	*/

	public function getAdminpostdetails(Request $request) {
		$rules = array(
			'post_id' => 'required|numeric',
			'user_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')
				->where('id', $request->user_id)
				->where('password', $request->access_token)
				->where('role', 1)
				->first();
			if (count($user_exist) > 0) {
				$toInfo = $this->post->getPostdetails($request);
				$status = true;
				if (count($toInfo) == 0) {
					$status = false;
				}
				return response()->json(array(
					'status' => $status,
					'result' => $toInfo,
				)
					, 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Invalid account',
				), 401);
			}
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting post comment lists.
			 * It will be triggered while admin viewing post comments from admin Panel.
	*/

	public function getAdminpostcomments(Request $request) {
		$rules = array(
			'post_id' => 'required|numeric',
			'user_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')
				->where('id', $request->user_id)
				->where('password', $request->access_token)
				->where('role', 1)
				->first();
			if (count($user_exist) > 0) {
				$toInfo = $this->post->getPostcomments($request);
				$status = true;
				if ($toInfo['count'] == 0) {
					$status = false;
				}
				return response()->json(array(
					'status' => $status,
					'result' => $toInfo['list'],
					'count' => $toInfo['count'],
					'no_page' => $toInfo['no_page'],
				)
					, 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Invalid account',
				), 401);
			}
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting post like lists.
			 * It will be triggered while admin viewing post likes from admin Panel.
	*/

	public function getAdminpostlikes(Request $request) {
		$rules = array(
			'post_id' => 'required|numeric',
			'user_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')
				->where('id', $request->user_id)
				->where('password', $request->access_token)
				->where('role', 1)
				->first();
			if (count($user_exist) > 0) {
				$toInfo = $this->post->getPostlikes($request);
				$status = true;
				if ($toInfo['count'] == 0) {
					$status = false;
				}
				return response()->json(array(
					'status' => $status,
					'result' => $toInfo['list'],
					'count' => $toInfo['count'],
					'no_page' => $toInfo['no_page'],
				)
					, 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Invalid account',
				), 401);
			}
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for update post and comment status.
			 * It will be triggered while admin updating post and comment status from admin Panel.
	*/

	public function postUpdatestatus(Request $request) {
		$rules = array(
			'post_status' => 'required|in:active,inactive',
			'post_type' => 'required|numeric',
			'post_id' => 'required|numeric',
			'user_id' => 'required',
			'comment_id' => 'numeric',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')
				->where('id', $request->user_id)
				->where('password', $request->access_token)
				->where('role', 1)
				->first();
			if (count($user_exist) > 0) {
				$post_type = $request->input('post_type');
				$toInfo = $this->post->updateStatus($request);
				$status = false;
				$msg = 'Something went wrong please try again later';
				$type = 'Comment';
				if ($post_type == 1) {
					$type = 'Post';
				}
				if ($toInfo) {
					$status = true;
					$msg = $type . ' status has been updated successfully';
				}
				return response()->json(array(
					'status' => $status,
					'message' => $msg,
				), 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Invalid account',
				), 401);
			}
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting posts list.
			 * It will be triggered while admin viewing posts list from admin Panel.
	*/
	public function getMemberpostlists(Request $request) {
		$rules = array(
			'user_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')
				->where('id', $request->user_id)
				->where('password', $request->access_token)
				->where('role', 1)
				->first();
			if (count($user_exist) > 0) {
				$toInfo = $this->post->getMemberPostlists($request);
				$status = true;
				if ($toInfo['count'] == 0) {
					$status = false;
				}
				return response()->json(array(
					'status' => $status,
					'result' => $toInfo['list'],
					'count' => $toInfo['count'],
					'no_page' => $toInfo['no_page'],
				)
					, 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Invalid account',
				), 401);
			}
		} else {

			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting types of report.
			 * It will be triggered while user reporting a post from mobile application.
	*/

	function getReportTypes(Request $request) {
		$user_id = $request->input('userid');
		$access_token = $request->input('access_token');
		$rules = array(
			'userid' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$types = $this->post->getReportTypes();
			return response()->json(array(
				'status' => true,
				'reports' => $types,
			), 200);
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for post report.
			 * It will be triggered while report the particular post from mobile application.
	*/

	public function postReporting(Request $request) {
		$post_id = $request->input('post_id');
		$report_id = $request->input('report_id');
		$message = $request->input('message');
		$rules = array(
			'post_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			if ($report_id || !empty($message)) {
				$this->post->insertPostReport($request);
				$msg = 'Report has been sent Successfully.';
				return response()->json(array(
					'status' => true,
					'message' => $msg,
				), 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Give report_id or message',
				), 401);
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for getting Reports of all posts
			 * It will be triggered while admin viewing reports from admin panel.
	*/

	public function getAdminPostReportList(Request $request) {
		$rules = array(
			'user_id' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user_exist = \DB::table('users')
				->where('id', $request->user_id)
				->where('password', $request->access_token)
				->where('role', 1)
				->first();
			if (count($user_exist) > 0) {
				$toInfo = $this->post->getAdminReportLists($request);
				$status = true;
				if ($toInfo['count'] == 0) {
					$status = false;
				}
				return response()->json(array(
					'status' => $status,
					'result' => $toInfo['list'],
					'count' => $toInfo['count'],
					'no_page' => $toInfo['no_page'],
				)
					, 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Invalid account',
				), 401);
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

}
