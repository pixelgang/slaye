<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Model : Post
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Models;
use App\Http\Controllers\CommonmailController;
use App\Library\VideoHelpers;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	public function __construct() {
		$this->users = new Users();
		$this->postMediaPath = '/uploads/images/post/';
		$this->commonService = new CommonmailController();
	}

	/*
		     * This is the function for Insert Post
	*/

	function insertPost($data) {
		return \DB::table('posts')->insertGetId($data);
	}

	/*
		     * Save media for post
		     * Detect media information for photo and video
		     * For video posting, generate thumbnail from video using ffmpeg
	*/

	function mediaSave($userId, $postId, $mediaData) {
		if (!empty($mediaData)) {
			$mediaArr = explode(',', $mediaData);
			$base = base_path();
			foreach ($mediaArr as $mkey => $mvalue) {
				$mediaPath = $base . $this->postMediaPath . $mvalue;
				$mExt = pathinfo($mediaPath, PATHINFO_EXTENSION);
				$mMimeType = mime_content_type($mediaPath);
				$image_array = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');
				$mMediaSize = filesize($mediaPath);
				$mMimeType = mime_content_type($mediaPath);
				$media_name = '';
				$mMediaDimension = '';
				if (in_array($mMimeType, $image_array)) {
					$mediaType = 'photo';
					$mediaProcess = 'completed';
					$mediaInfo = getimagesize($mediaPath);
					$mMediaDimension = ($mediaInfo) ? $mediaInfo[0] . 'x' . $mediaInfo[1] : '';
				} else {
					$explode = explode('.', $mvalue);
					if (count($explode) > 0) {
						$media_name = $explode['0'];
					}
					if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
						$ffmpeg_path = base_path() . '\resources\ffmpeg\ffmpeg_win\ffmpeg';
					} else {
						$ffmpeg_path = base_path() . '/resources/ffmpeg/ffmpeg_lin/ffmpeg.exe';
					}
					$file_name = time() . rand(4, 9999);
					$ffmpeg = new VideoHelpers($ffmpeg_path, $mediaPath, $media_name);
					$ffmpeg->convertImages();
					$mediaType = 'video';
					$mediaProcess = 'progress';
					$mediaPath = $base . $this->postMediaPath . $media_name . '.jpg';
					$mediaInfo = getimagesize($mediaPath);
					$mMediaDimension = ($mediaInfo) ? $mediaInfo[0] . 'x' . $mediaInfo[1] : '';
					$media_name = $media_name . '.jpg';
					$mvalue = ($mediaProcess == 'completed' || $mExt == 'mp4') ? $mvalue : '';
				}
				$this->insertMedia(array(
					'user_id' => $userId,
					'post_id' => $postId,
					'media_name' => $mvalue,
					'media_image' => $media_name,
					'media_size' => $mMediaSize,
					'media_dimension' => $mMediaDimension,
					'media_mime_type' => $mMimeType,
					'media_extension' => $mExt,
					'media_type' => $mediaType,
					'media_process' => $mediaProcess,
					'created_at' => Carbon::now(),
				));
			}
		}
	}

	/*
		     * This is the function for Insert Post media
	*/

	function insertMedia($data) {
		return \DB::table('post_media')->insertGetId($data);
	}

	/*
		     * This is the function for getting post information from post id and user id
	*/

	function getPostInfo($userId, $postId) {
		$postInfo = array();
		$postResult = \DB::table('posts')
			->select('posts.*', 'users.first_name', 'users.last_name', 'users.username')
			->join('users', 'users.id', '=', 'posts.user_id')
			->where('post_id', $postId)->get();

		foreach ($postResult as $key => $postData) {
			$postInfo[] = $this->postFeedStructure($postData);
		}
		return $postInfo;
	}

	/*
		     * This is the function for Post feed structure while adding new post, we will return this response
	*/

	function postFeedStructure($postData) {
		$path = rtrim(url('/'));
		$postPath = '/uploads/images/post/';
		$mediaUrl = $path . $postPath;
		$mediaData = \DB::table('post_media')
			->select('post_media.*')
			->selectSub('SELECT "' . $mediaUrl . '"', 'media_url')
			->where('post_id', $postData->post_id)->get();
		return array(
			'post_id' => $postData->post_id,
			'post_text' => $postData->post_text,
			'user_id' => $postData->user_id,
			'user_name' => $postData->username,
			'full_name' => $postData->first_name . ' ' . $postData->last_name,
			'post_type' => $postData->post_type,
			'media_data' => $mediaData,
			'post_locations' => $postData->post_locations,
			'location' => $postData->post_locations,
			'latitude' => $postData->post_lat,
			'longitude' => $postData->post_lang,
			'like_count' => $postData->post_like_count,
			'comment_count' => $postData->post_comment_count,
			'created_at' => $postData->created_at
		);
	}

	/*
		     * This is the function for Post Actions - post delete, like, comment add/edit/delete
	*/

	public function actionbt($request) {
		$data = array();
		$user_id = $request['user_id'];
		$action_type = $request['action_type'];
		$post_id = $request['post_id'];
		$cmt_desc = $request['cmt_desc'];
		$data = array();
		$postData = \DB::table('posts')->where('post_id', $post_id)->get();
		if ($action_type == 1) {
			//post deleted
			if (($postData[0]->user_id == $user_id) || $user_id == '1') {
				//only Post owner/Admin should delete
				\DB::table('posts')->where('post_id', $post_id)->delete();
				\DB::table('post_media')->where('post_id', $post_id)->delete();
				\DB::table('post_comment')->where('post_id', $post_id)->delete();
				\DB::table('post_like')->where('post_id', $post_id)->delete();
				\DB::table('notification')->where('object_id', $post_id)->delete();
				\DB::table('post_report')->where('post_id', $post_id)->delete();
				\DB::table('users')
					->where('id', $postData[0]->user_id)
					->where('post_count', '>', 0)
					->decrement('post_count', 1);
			} else {
				return 'not_delete';
			}
		} elseif ($action_type == 2) {
			//Post - like
			$like_count = 1;
			$count = \DB::table('post_like')->where('user_id', $user_id)->where('post_id', $post_id)->count();
			if ($count == 0) {
				$data['post_id'] = $post_id;
				$data['user_id'] = $user_id;
				$data['created_at'] = Carbon::now();
				$post_like = \DB::table('post_like')->insertGetId($data);
				\DB::table('posts')->where('post_id', $post_id)->increment('post_like_count', 1);
				if ($user_id != $postData[0]->user_id) {
					$this->users->pushupdate($user_id, $postData[0]->user_id, 'like', 'user liked a post', $post_id);
				}
			} else {
				\DB::table('post_like')->where('user_id', $user_id)->where('post_id', $post_id)->delete();
				\DB::table('posts')->where('post_id', $post_id)->where('post_like_count', '>', 0)->decrement('post_like_count', 1);
			}
		} elseif ($action_type == 3) {
			//Add/edit comments
			if (isset($cmt_desc)) {
				$comment_id = $request['comment_id'];
				if (!empty($comment_id)) {
					$data['desc'] = $cmt_desc;
					$data['updated_at'] = Carbon::now();
					\DB::table('post_comment')->where('user_id', $user_id)->where('id', $comment_id)->update($data);
					$cmt_id = $comment_id;
				} else {
					$comment_count = 1;
					$data['user_id'] = $user_id;
					$data['post_id'] = $post_id;
					$data['desc'] = $cmt_desc;
					$data['created_at'] = Carbon::now();
					$cmt_id = \DB::table('post_comment')->insertGetId($data);
					\DB::table('posts')->where('post_id', $post_id)->increment('post_comment_count', 1);
					if ($user_id != $postData[0]->user_id) {
						$this->users->pushupdate($user_id, $postData[0]->user_id, 'comment', 'user commented a post', $post_id);
					}
				}
				$post_id = $cmt_id;
			}
		} elseif ($action_type == 4) {
			//Delete comments
			$comment_id = $request['comment_id'];
			\DB::table('post_comment')->where('user_id', $user_id)->where('id', $comment_id)->delete();
			\DB::table('posts')->where('post_id', $post_id)->where('post_comment_count', '>', 0)->decrement('post_comment_count', 1);
			\DB::table('users')->where('id', $user_id)->where('post_count', '>', 0)->decrement('post_count', 1);
		}

		return $post_id;
	}

	/*
		     * This is the function for getting post comments list with pagination
	*/

	public function postcomments($post_id, $user_id = '', $access_token = '', $page_no) {
		$start = 0;
		$iPerPage = 10;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$cmts_lists = $total_cmts = array();

		$total_cmts = \DB::table('post_comment')
			->select('post_comment.*', 'users.username')
			->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
			->where('post_id', $post_id)
			->where('comment_status', 'active')
			->count();
		$cmts_lists = \DB::table('post_comment')
			->select('post_comment.*', 'users.username')
			->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
			->where('post_id', $post_id)
			->where('comment_status', 'active')
			->orderBy('id', 'desc')
			->skip($start)->take($iPerPage)->get();

		$result = array();
		if (count($cmts_lists) > 0) {
			foreach ($cmts_lists as $key => $b_value) {

				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($b_value->created_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$author_pic = '';
				$result[] = array(
					'cmt_id ' => $b_value->id,
					'user_id' => $b_value->user_id,
					'user_name' => $b_value->username,
					'post_id' => $b_value->post_id,
					'cmt_text' => $b_value->desc,
					'created_at' => $time . ' ago',
					'author_pic' => $b_value->user_id,
				);
			}
		}
		$no_page = ceil($total_cmts / $iPerPage);
		return array('list' => $result, 'count' => $total_cmts, 'no_page' => $no_page);
	}

	/*
		     * This is the function for getting Post feeds list
		     * type = 1 for Home page listing - combined set of results (me and following)
		     * type = 2 for feed details
	*/

	public function getFeedsbyid($post_info) {
		$user_id = $post_info['user_id'];
		$access_token = $post_info['access_token'];
		$member_id = $post_info['member_id'];
		if (!isset($member_id)) {
			$member_id = 0;
		}
		$feed_type = $post_info['feed_type'];
		$feed_id = $post_info['feed_id'];
		$page_no = $post_info['page_no'];
		$start = 0;
		$iPerPage = 10;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$post_lits = array();
		if ($feed_type == 1) {
			// Home page listing - combined set of results (me and following)
			$my_user = \DB::table('user_connection')
				->where('user_connection.user_id', $user_id)
				->where('user_connection.follow', '1')
				->where('user_connection.status', '1')
				->pluck('user_connection.friend_id');

			$total_posts = \DB::table('posts')
				->select('posts.*', 'users.first_name', 'users.last_name', 'users.username', 'users.profile_pic')
				->join('users', 'users.id', '=', 'posts.user_id')
				->where(function ($query) use ($user_id, $my_user) {
					$query->where('user_id', $user_id)
						->orWhereIn('user_id', $my_user);
				})
				->where('post_status', 'active')
				->orderBy('post_id', 'desc')->count();
			$post_lits = \DB::table('posts')
				->select('posts.*', 'users.first_name', 'users.last_name', 'users.username', 'users.profile_pic')
				->join('users', 'users.id', '=', 'posts.user_id')
				->where(function ($query) use ($user_id, $my_user) {
					$query->where('user_id', $user_id)
						->orWhereIn('user_id', $my_user);
				})
				->where('post_status', 'active')
				->orderBy('post_id', 'desc')->skip($start)->take($iPerPage)->get();
		} elseif ($feed_type == 2) {
			//feed details
			$uBUids = \DB::table('user_connection')->select('friend_id AS uids')
				->where('user_id', $user_id)
				->where('status', 2)
				->get();
			$fBUids = \DB::table('user_connection')->select('user_id AS uids')
				->where('friend_id', $user_id)
				->where('status', 2)
				->get();
			$blockedUids = $uBUids->merge($fBUids)->pluck('uids')->unique()->toArray();
			$total_posts = \DB::table('posts')
				->select('posts.*', 'users.first_name', 'users.last_name', 'users.username', 'users.profile_pic')
				->join('users', 'users.id', '=', 'posts.user_id')
				->where('post_id', $feed_id)
				->where('posts.post_status', 'active')
				->whereNotIn('posts.user_id', $blockedUids)
				->orderBy('post_id', 'desc')->count();
			$post_lits = \DB::table('posts')
				->select('posts.*', 'users.first_name', 'users.last_name', 'users.username', 'users.profile_pic')
				->join('users', 'users.id', '=', 'posts.user_id')
				->where('post_id', $feed_id)
				->where('posts.post_status', 'active')
				->whereNotIn('posts.user_id', $blockedUids)
				->get();
		} elseif ($feed_type == 3 && $member_id) {
			//Profile feed
			if ($user_id != $member_id) {
				$uBUids = \DB::table('user_connection')->select('friend_id AS uids')
					->where('user_id', $user_id)
					->where('status', 2)
					->get();
				$fBUids = \DB::table('user_connection')->select('user_id AS uids')
					->where('friend_id', $user_id)
					->where('status', 2)
					->get();
				$blockedUids = $uBUids->merge($fBUids)->pluck('uids')->unique()->toArray();
				if (count($blockedUids) > 0) {
					if (in_array($member_id, $blockedUids)) {
						return 'account_blocked';
					}
				}
				$isPrivate = \DB::table('users')->select('*')
					->where('id', $member_id)
					->where('is_private', 1)
					->get();
				if (count($isPrivate) > 0) {
					//this is private account
					$uFollowings = \DB::table('user_connection')->select('*')
						->where('user_id', $user_id)
						->where('friend_id', $member_id)
						->where('status', 1)
						->where('follow', 1)
						->get();
					$uFollowers = \DB::table('user_connection')->select('*')
						->where('user_id', $member_id)
						->where('friend_id', $user_id)
						->where('status', 1)
						->where('follow', 1)
						->get();
					if (count($uFollowings) == 0 && count($uFollowers) == 0) {
						return 'account_private';
					}
				}
			}
			$total_posts = \DB::table('posts')
				->select('posts.*', 'users.first_name', 'users.last_name', 'users.username', 'users.profile_pic')
				->join('users', 'users.id', '=', 'posts.user_id')
				->where('user_id', $member_id)
				->where('posts.post_status', 'active')
				->orderBy('post_id', 'desc')->count();
			$post_lits = \DB::table('posts')
				->select('posts.*', 'users.first_name', 'users.last_name', 'users.username', 'users.profile_pic')
				->join('users', 'users.id', '=', 'posts.user_id')
				->where('user_id', $member_id)
				->where('posts.post_status', 'active')
				->orderBy('posts.post_id', 'desc')->skip($start)->take($iPerPage)->get();
		}
		$result = $this->postFeedResponseStructure($user_id, $post_lits);
		$no_page = ceil($total_posts / $iPerPage);
		return array('list' => $result, 'count' => $total_posts, 'no_page' => $no_page);
	}
	/*
		     * This is the function for getting post feed Response Structure
		     * It is used for feed list/feed details/notification feeds
	*/
	public function postFeedResponseStructure($user_id, $post_lits) {
		$result = array();
		if (count($post_lits) > 0) {
			foreach ($post_lits as $pkey => $b_value) {
				$getMedia = \DB::table('post_media')->where('post_id', $b_value->post_id)->orderBy('media_id', 'asc')->get();
				$islike = \DB::table('post_like')->where('post_id', $b_value->post_id)->where('user_id', $user_id)->count();
				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($b_value->created_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$result[$pkey] = array(
					'post_id' => $b_value->post_id,
					'user_id' => $b_value->user_id,
					'post_text' => $b_value->post_text,
					'post_type' => $b_value->post_type,
					'post_like_count' => $b_value->post_like_count,
					'post_comment_count' => $b_value->post_comment_count,
					'user_name' => $b_value->username,
					'user_first_name' => $b_value->first_name,
					'user_last_name' => $b_value->last_name,
					'user_image' => url('image/user/' . $b_value->user_id),
					'created_at_ago' => $time . ' ago',
					'created_at' => $b_value->created_at,
					'author_pic' => $b_value->user_id,
					'is_like' => $islike
				);
				if (count($getMedia) > 0) {
					foreach ($getMedia as $key => $media) {
						if ($media->media_dimension) {
							$mediaDimension = explode('x', $media->media_dimension);
							$mediaWidth = $mediaDimension[0];
							$mediaHeight = $mediaDimension[1];
						} else {
							$mediaWidth = $mediaHeight = "";
						}
						$mediaUrl = url('uploads/images/post/' . $media->media_name);
						$videoThumbnail = "";
						if ($media->media_type == 'video') {
							$mediaUrl = ($media->media_process == 'completed' || $media->media_extension == 'mp4') ? $mediaUrl : '';

							$videoThumbnail = url('uploads/images/post/' . $media->media_image);
						}
						$result[$pkey]['media'][$key] = array(
							'media_id' => $media->media_id,
							'media_name' => $mediaUrl,
							'media_image' => $videoThumbnail,
							'media_size' => $media->media_size,
							'media_dimension' => $media->media_dimension,
							'media_width' => $mediaWidth,
							'media_height' => $mediaHeight,
							'media_mime_type' => $media->media_mime_type,
							'media_extension' => $media->media_extension,
							'media_type' => $media->media_type,
						);
					}
				}
			}
		}
		return $result;
	}

	/*
		     * This is the function for updating post text information
	*/

	public function editPostFeedsbyid($post_info) {
		$post_id = $post_info['post_id'];
		$user_id = $post_info['userid'];
		$data = array();
		$data['post_text'] = $post_info['post_text'];
		$data['updated_at'] = Carbon::now();
		\DB::table('posts')->where('user_id', $user_id)->where('post_id', $post_id)->update($data);
		return true;
	}

	/*
		     * This is the function for getting media based on user id with pagination
	*/

	public function getMediafeedsbyid($post_info) {
		$user_id = $post_info['user_id'];
		$access_token = $post_info['access_token'];
		$member_id = $post_info['member_id'];
		if (!isset($member_id)) {
			$member_id = 0;
		}
		$feed_type = $post_info['feed_type'];
		$page_no = $post_info['page_no'];

		$start = 0;
		$iPerPage = 10;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$post_media_lists = array();
		$media_type = 'video';
		if ($feed_type == 1) {
			$media_type = 'photo';
		}
		if ($user_id != $member_id) {
			$uBUids = \DB::table('user_connection')->select('friend_id AS uids')
				->where('user_id', $user_id)
				->where('status', 2)
				->get();
			$fBUids = \DB::table('user_connection')->select('user_id AS uids')
				->where('friend_id', $user_id)
				->where('status', 2)
				->get();
			$blockedUids = $uBUids->merge($fBUids)->pluck('uids')->unique()->toArray();
			if (count($blockedUids) > 0) {
				if (in_array($member_id, $blockedUids)) {
					return 'account_blocked';
				}
			}
			$isPrivate = \DB::table('users')->select('*')
				->where('id', $member_id)
				->where('is_private', 1)
				->get();
			if (count($isPrivate) > 0) {
				//this is private account
				$uFollowings = \DB::table('user_connection')->select('*')
					->where('user_id', $user_id)
					->where('friend_id', $member_id)
					->where('status', 1)
					->where('follow', 1)
					->get();
				$uFollowers = \DB::table('user_connection')->select('*')
					->where('user_id', $member_id)
					->where('friend_id', $user_id)
					->where('status', 1)
					->where('follow', 1)
					->get();
				if (count($uFollowings) == 0 && count($uFollowers) == 0) {
					return 'account_private';
				}
			}
		}
		if (!empty($member_id)) {
			$user_id = $member_id;
		}
		$total_media_posts = \DB::table('post_media')
			->join('posts', 'post_media.post_id', '=', 'posts.post_id')
			->where('post_media.media_type', $media_type)
			->where('post_media.user_id', $user_id)
			->where('posts.post_status', 'active')
			->orderBy('post_media.media_id', 'asc')->count();

		$post_media_lists = \DB::table('post_media')
			->select('post_media.*')
			->join('posts', 'post_media.post_id', '=', 'posts.post_id')
			->where('post_media.media_type', $media_type)
			->where('post_media.user_id', $user_id)
			->where('posts.post_status', 'active')
			->orderBy('post_media.media_id', 'asc')->skip($start)->take($iPerPage)->get();

		$result = array();
		if (count($post_media_lists) > 0) {
			foreach ($post_media_lists as $key => $media) {
				if ($media->media_dimension) {
					$mediaDimension = explode('x', $media->media_dimension);
					$mediaWidth = (isset($mediaDimension[0])) ? $mediaDimension[0] : '';
					$mediaHeight = (isset($mediaDimension[1])) ? $mediaDimension[1] : '';
				} else {
					$mediaWidth = $mediaHeight = "";
				}
				$result[] = array(
					'post_id' => $media->post_id,
					'media_id' => $media->media_id,
					'media_name' => url('uploads/images/post/' . $media->media_name),
					'media_image' => url('uploads/images/post/' . $media->media_image),
					'media_size' => $media->media_size,
					'media_dimension' => $media->media_dimension,
					'media_width' => $mediaWidth,
					'media_height' => $mediaHeight,
					'media_mime_type' => $media->media_mime_type,
					'media_extension' => $media->media_extension,
					'media_type' => $media->media_type
				);
			}
		}
		$no_page = ceil($total_media_posts / $iPerPage);
		return array('list' => $result, 'count' => $total_media_posts, 'no_page' => $no_page);
	}

	/*
		     * This is the function for getting Likes for specific post with pagination
	*/

	public function getPostlikelists($post_info) {

		$user_id = $post_info['user_id'];
		$post_id = $post_info['post_id'];
		$page_no = $post_info['page_no'];
		$start = 0;
		$iPerPage = 20;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$like_lists = $total_likes = array();

		$total_likes = \DB::table('post_like')
			->select('post_like.*', 'users.username')
			->leftjoin('users', 'users.id', '=', 'post_like.user_id')
			->where('post_id', $post_id)->count();
		$like_lists = \DB::table('post_like')
			->select('post_like.*', 'users.username', 'users.is_private')
			->leftjoin('users', 'users.id', '=', 'post_like.user_id')
			->where('post_id', $post_id)->skip($start)->take($iPerPage)->get();

		$result = array();
		if (count($like_lists) > 0) {
			foreach ($like_lists as $key => $like_value) {

				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($like_value->created_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$author_pic = '';
				$member_request_check = false;
				$connection_id = "";
				if ($user_id != $like_value->user_id) {
					$follow_exist = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `user_id`="' . $user_id . '" AND `friend_id`="' . $like_value->user_id . '"'));
					$member_request_check = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `user_id`="' . $like_value->user_id . '" AND `friend_id`="' . $user_id . '"AND `status`=3'));

					$follower_check = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `user_id`="' . $user_id . '" AND `friend_id`="' . $like_value->user_id . '"AND `status`=2'));
					$following_check = \DB::select(\DB::raw('SELECT * FROM `user_connection`  WHERE `friend_id`="' . $user_id . '" AND `user_id`="' . $like_value->user_id . '"AND `status`=2'));
				}
				// User Blocked by me - Start
				$blockedbyme = false;
				if (!empty($follower_check) || !empty($following_check)) {
					$blockedbyme = true;
				}
				// User Blocked by me - End
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
				$result[] = array(
					'like_id ' => $like_value->id,
					'user_id' => $like_value->user_id,
					'user_name' => $like_value->username,
					'post_id' => $like_value->post_id,
					'created_at' => $time . ' ago',
					'author_pic' => $like_value->user_id,
					'is_private' => $like_value->is_private,
					'is_follow' => $is_follow,
					'follow_status' => $follow_status,
					'is_block' => $is_block,
					'is_requested' => $is_requested,
					'is_follow_button' => $is_follow_button,
					'blockedbyme' => $blockedbyme,
					'member_request' => $member_request,
					'connection_id' => $connection_id,
				);
			}
		}
		$no_page = ceil($total_likes / $iPerPage);
		return array('list' => $result, 'count' => $total_likes, 'no_page' => $no_page);
	}

	/*
		     * This is the function for getting list of posts with pagination and search option
	*/

	public function getPostlists($post_info) {
		$user_id = $post_info['user_id'];
		$access_token = $post_info['access_token'];
		$page_no = $post_info['page_no'];
		$keyWord = $post_info['keyword'];

		$start = 0;
		$iPerPage = 10;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$post_lists = array();

		$total_media_posts = \DB::table('posts')
			->select('posts.*', 'users.first_name', 'users.last_name', 'users.username')
			->join('users', 'users.id', '=', 'posts.user_id')
			->where(function ($query) use ($keyWord) {
				$query->where('users.username', 'like', '%' . $keyWord . '%')
					->orwhere('users.first_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.last_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.email', 'like', '%' . $keyWord . '%')
					->orwhere('posts.post_text', 'like', '%' . $keyWord . '%');
			})
			->orderBy('post_id', 'desc')->count();
		$post_lists = \DB::table('posts')
			->select('posts.*', 'users.first_name', 'users.last_name', 'users.username')
			->join('users', 'users.id', '=', 'posts.user_id')
			->where(function ($query) use ($keyWord) {
				$query->where('users.username', 'like', '%' . $keyWord . '%')
					->orwhere('users.first_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.last_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.email', 'like', '%' . $keyWord . '%')
					->orwhere('posts.post_text', 'like', '%' . $keyWord . '%');
			})
			->orderBy('post_id', 'desc')->skip($start)->take($iPerPage)->get();

		$result = array();
		if (count($post_lists) > 0) {
			foreach ($post_lists as $key => $posts) {
				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($posts->created_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$getMedia = \DB::table('post_media')->where('post_id', $posts->post_id)->orderBy('media_id', 'asc')->get();
				$iData = array(
					'post_id' => $posts->post_id,
					'user_id' => $posts->user_id,
					'post_text' => $posts->post_text,
					'post_type' => $posts->post_type,
					'post_status' => $posts->post_status,
					'post_like_count' => \bsetecHelpers::lv_count($posts->post_like_count),
					'post_comment_count' => \bsetecHelpers::lv_count($posts->post_comment_count),
					'user_name' => $posts->username,
					'user_first_name' => $posts->first_name,
					'user_last_name' => $posts->last_name,
					'user_image' => url('image/user/' . $posts->user_id),
					'created_at_ago' => $time . ' ago',
					'created_at' => $posts->created_at,
				);
				if (count($getMedia) > 0) {
					$mediaData = $getMedia[0];
					$iData['media_name'] = url('uploads/images/post/' . $mediaData->media_name);
					$iData['media_image'] = ($mediaData->media_type == 'video') ? url('uploads/images/post/' . $mediaData->media_image) : "";
					$iData['media_type'] = $mediaData->media_type;
				}
				$result[] = $iData;
			}
		}
		$no_page = ceil($total_media_posts / $iPerPage);
		return array('list' => $result, 'count' => $total_media_posts, 'no_page' => $no_page);
	}

	/*
		     * This is the function for getting post details response
	*/

	public function getPostdetails($post_info) {
		$user_id = $post_info['user_id'];
		$access_token = $post_info['access_token'];
		$post_id = $post_info['post_id'];

		$post_details = array();

		$post_details = \DB::table('posts')
			->select('posts.*', 'users.first_name', 'users.last_name', 'users.username')
			->join('users', 'users.id', '=', 'posts.user_id')
			->where('post_id', $post_id)
			->get();

		$result = array();
		if (count($post_details) > 0) {
			$posts = $post_details['0'];
			$getMedia = \DB::table('post_media')->where('post_id', $posts->post_id)->orderBy('media_id', 'asc')->get();
			$now = Carbon::now();
			$startTime = Carbon::parse($now);
			$finishTime = Carbon::parse($posts->created_at);
			$time = $finishTime->diffForHumans($startTime, true);
			$status = false;
			if ($posts->post_status == 'active') {
				$status = true;
			}
			$result[] = array(
				'post_id' => $posts->post_id,
				'user_id' => $posts->user_id,
				'post_text' => $posts->post_text,
				'post_type' => $posts->post_type,
				'post_like_count' => $posts->post_like_count,
				'post_comment_count' => $posts->post_comment_count,
				'post_locations' => $posts->post_locations,
				'post_status' => $status,
				'user_name' => $posts->username,
				'user_first_name' => $posts->first_name,
				'user_last_name' => $posts->last_name,
				'user_image' => url('image/user/' . $posts->user_id),
				'created_at_ago' => $time . ' ago',
				'created_at' => $posts->created_at
			);

			if (count($getMedia) > 0) {
				foreach ($getMedia as $key => $media) {
					$video = '';
					if ($media->media_type == 'video') {
						$video = url('uploads/images/post/' . $media->media_image);
					}
					if ($media->media_dimension) {
						$mediaDimension = explode('x', $media->media_dimension);
						$mediaWidth = (isset($mediaDimension[0])) ? $mediaDimension[0] : '';
						$mediaHeight = (isset($mediaDimension[1])) ? $mediaDimension[1] : '';
					} else {
						$mediaWidth = $mediaHeight = "";
					}
					$result[]['media'][$key] = array(
						'media_id' => $media->media_id,
						'media_name' => url('uploads/images/post/' . $media->media_name),
						'media_image' => $video,
						'media_size' => $media->media_size,
						'media_dimension' => $media->media_dimension,
						'media_width' => $mediaWidth,
						'media_height' => $mediaHeight,
						'media_mime_type' => $media->media_mime_type,
						'media_extension' => $media->media_extension,
						'media_type' => $media->media_type,
					);
				}
			}
		}
		return $result;
	}

	/*
		     * This is the functin for getting list of comments inside particular post
	*/

	public function getPostcomments($post_info) {

		$post_id = $post_info['post_id'];
		$page_no = $post_info['page_no'];
		$search_type = $post_info['search_type'];
		$search_text = $post_info['search_text'];

		$start = 0;
		$iPerPage = 20;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$cmts_lists = $total_cmts = array();

		if ($search_type != '' && $search_text != '') {
			if ($search_type == 'all') {
				$total_cmts = \DB::table('post_comment')
					->select('post_comment.*', 'users.username')
					->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
					->where(function ($query) use ($search_text) {
						$query->where('post_comment.desc', 'like', '%' . $search_text . '%')
							->orWhere('users.email', 'like', '%' . $search_text . '%')
							->orWhere('users.username', 'like', '%' . $search_text . '%');
					})
					->where('post_id', $post_id)->count();
				$cmts_lists = \DB::table('post_comment')
					->select('post_comment.*', 'users.username')
					->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
					->where(function ($query) use ($search_text) {
						$query->where('post_comment.desc', 'like', '%' . $search_text . '%')
							->orWhere('users.email', 'like', '%' . $search_text . '%')
							->orWhere('users.username', 'like', '%' . $search_text . '%');
					})
					->where('post_id', $post_id)->orderBy('id', 'desc')->skip($start)->take($iPerPage)->get();
			} elseif ($search_type == 'active') {
				$total_cmts = \DB::table('post_comment')
					->select('post_comment.*', 'users.username')
					->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
					->where(function ($query) use ($search_text) {
						$query->where('post_comment.desc', 'like', '%' . $search_text . '%')
							->orWhere('users.email', 'like', '%' . $search_text . '%')
							->orWhere('users.username', 'like', '%' . $search_text . '%');
					})
					->where('comment_status', 'active')
					->where('post_id', $post_id)->count();
				$cmts_lists = \DB::table('post_comment')
					->select('post_comment.*', 'users.username')
					->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
					->where(function ($query) use ($search_text) {
						$query->where('post_comment.desc', 'like', '%' . $search_text . '%')
							->orWhere('users.email', 'like', '%' . $search_text . '%')
							->orWhere('users.username', 'like', '%' . $search_text . '%');
					})
					->where('comment_status', 'active')
					->where('post_id', $post_id)->orderBy('id', 'desc')->skip($start)->take($iPerPage)->get();
			} elseif ($search_type == 'inactive') {
				$total_cmts = \DB::table('post_comment')
					->select('post_comment.*', 'users.username')
					->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
					->where(function ($query) use ($search_text) {
						$query->where('post_comment.desc', 'like', '%' . $search_text . '%')
							->orWhere('users.email', 'like', '%' . $search_text . '%')
							->orWhere('users.username', 'like', '%' . $search_text . '%');
					})
					->where('comment_status', 'inactive')
					->where('post_id', $post_id)->count();
				$cmts_lists = \DB::table('post_comment')
					->select('post_comment.*', 'users.username')
					->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
					->where(function ($query) use ($search_text) {
						$query->where('post_comment.desc', 'like', '%' . $search_text . '%')
							->orWhere('users.email', 'like', '%' . $search_text . '%')
							->orWhere('users.username', 'like', '%' . $search_text . '%');
					})
					->where('comment_status', 'inactive')
					->where('post_id', $post_id)->orderBy('id', 'desc')->skip($start)->take($iPerPage)->get();
			}
		} elseif (($search_type != '' && $search_text == '') && ($search_type == 'active' || $search_type == 'inactive')) {
			$total_cmts = \DB::table('post_comment')
				->select('post_comment.*', 'users.username')
				->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
				->where('comment_status', $search_type)
				->where('post_id', $post_id)->count();
			$cmts_lists = \DB::table('post_comment')
				->select('post_comment.*', 'users.username')
				->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
				->where('comment_status', $search_type)
				->where('post_id', $post_id)->orderBy('id', 'desc')->skip($start)->take($iPerPage)->get();
		} else {
			$total_cmts = \DB::table('post_comment')
				->select('post_comment.*', 'users.username')
				->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
				->where('post_id', $post_id)->count();
			$cmts_lists = \DB::table('post_comment')
				->select('post_comment.*', 'users.username')
				->leftjoin('users', 'users.id', '=', 'post_comment.user_id')
				->where('post_id', $post_id)->orderBy('id', 'desc')->skip($start)->take($iPerPage)->get();
		}

		$result = array();
		if (count($cmts_lists) > 0) {
			foreach ($cmts_lists as $key => $cmt_value) {

				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($cmt_value->created_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$author_pic = '';

				$status_1 = false;
				$status_2 = true;
				if ($cmt_value->comment_status == 'active') {
					$status_1 = true;
					$status_2 = false;
				}
				$result[] = array(
					'cmt_id' => $cmt_value->id,
					'user_id' => $cmt_value->user_id,
					'user_name' => $cmt_value->username,
					'post_id' => $cmt_value->post_id,
					'cmt_text' => $cmt_value->desc,
					'cmt_status' => $cmt_value->comment_status,
					'created_at' => $time . ' ago',
					'enable_option' => $status_1,
					'disble_option' => $status_2,
					'author_pic' => $cmt_value->user_id,
				);
			}
		}
		$no_page = ceil($total_cmts / $iPerPage);
		return array('list' => $result, 'count' => $total_cmts, 'no_page' => $no_page);
	}

	/*
		     * This is the function for getting List of likes inside particular post
	*/

	public function getPostlikes($post_info) {

		$post_id = $post_info['post_id'];
		$page_no = $post_info['page_no'];
		$start = 0;
		$iPerPage = 20;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$like_lists = $total_likes = array();

		$total_likes = \DB::table('post_like')
			->select('post_like.*', 'users.username')
			->leftjoin('users', 'users.id', '=', 'post_like.user_id')
			->where('post_id', $post_id)->count();
		$like_lists = \DB::table('post_like')
			->select('post_like.*', 'users.username', 'users.state', 'users.country')
			->leftjoin('users', 'users.id', '=', 'post_like.user_id')
			->where('post_id', $post_id)->orderBy('id', 'desc')->skip($start)->take($iPerPage)->get();

		$result = array();
		if (count($like_lists) > 0) {
			foreach ($like_lists as $key => $like_value) {

				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($like_value->created_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$author_pic = '';
				$result[] = array(
					'like_id' => $like_value->id,
					'user_id' => $like_value->user_id,
					'user_name' => $like_value->username,
					'user_state' => $like_value->state,
					'user_country' => $like_value->country,
					'post_id' => $like_value->post_id,
					'created_at' => $time . ' ago',
					'author_pic' => $like_value->user_id,
				);
			}
		}
		$no_page = ceil($total_likes / $iPerPage);
		return array('list' => $result, 'count' => $total_likes, 'no_page' => $no_page);
	}
	/**
	 * This is the function for updating post/comment status to active/inactive from Admin panel
	 */
	public function updateStatus($post_info) {
		$post_type = $post_info['post_type'];
		$post_id = $post_info['post_id'];
		$post_status = $post_info['post_status'];
		$comment_id = $post_info['comment_id'];
		$data = array();
		if ($post_type == 1) {
			$data['post_status'] = $post_status;
			$data['updated_at'] = Carbon::now();
			\DB::table('posts')->where('post_id', $post_id)->update($data);
			$postData = \DB::table('posts')->where('post_id', $post_id)->get();
			if ($post_status == 'inactive') {
				\DB::table('users')->where('id', $postData[0]->user_id)->where('post_count', '>', 0)->decrement('post_count', 1);
			} else {
				\DB::table('users')->where('id', $postData[0]->user_id)->increment('post_count', 1);
			}
		} elseif ($post_type == 2) {
			$comment_id = $post_info['comment_id'];
			$data['comment_status'] = $post_status;
			$data['updated_at'] = Carbon::now();
			\DB::table('post_comment')->where('id', $comment_id)->where('post_id', $post_id)->update($data);
			if ($post_status == 'inactive') {
				\DB::table('posts')->where('post_id', $post_id)->where('post_comment_count', '>', 0)->decrement('post_comment_count', 1);
			} else {
				\DB::table('posts')->where('post_id', $post_id)->increment('post_comment_count', 1);
			}
		}
		return true;
	}

	/*
		     * This is the function for getting member post list  for admin back-end
	*/

	public function getMemberPostlists($post_info) {
		$user_id = $post_info['user_id'];
		$access_token = $post_info['access_token'];
		$page_no = $post_info['page_no'];
		$keyWord = $post_info['keyword'];
		$member_id = $post_info['member_id'];

		$start = 0;
		$iPerPage = 5;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$post_lists = array();

		$total_media_posts = \DB::table('posts')
			->select('posts.*', 'users.first_name', 'users.last_name', 'users.username')
			->join('users', 'users.id', '=', 'posts.user_id')
			->where(function ($query) use ($keyWord) {
				$query->where('users.username', 'like', '%' . $keyWord . '%')
					->orwhere('users.first_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.last_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.email', 'like', '%' . $keyWord . '%')
					->orwhere('posts.post_text', 'like', '%' . $keyWord . '%');
			})
			->where('users.id', $member_id)
			->orderBy('post_id', 'desc')->count();
		$post_lists = \DB::table('posts')
			->select('posts.*', 'users.first_name', 'users.last_name', 'users.username', 'post_media.media_name', 'post_media.media_image')
			->join('users', 'users.id', '=', 'posts.user_id')
			->join('post_media', 'post_media.post_id', '=', 'posts.post_id')
			->where(function ($query) use ($keyWord) {
				$query->where('users.username', 'like', '%' . $keyWord . '%')
					->orwhere('users.first_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.last_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.email', 'like', '%' . $keyWord . '%')
					->orwhere('posts.post_text', 'like', '%' . $keyWord . '%');
			})
			->where('users.id', $member_id)
			->orderBy('post_id', 'desc')->skip($start)->take($iPerPage)->get();

		$result = array();
		if (count($post_lists) > 0) {
			foreach ($post_lists as $key => $posts) {
				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($posts->created_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$result[] = array(
					'post_id' => $posts->post_id,
					'user_id' => $posts->user_id,
					'post_text' => $posts->post_text,
					'post_type' => $posts->post_type,
					'post_status' => $posts->post_status,
					'post_like_count' => \bsetecHelpers::lv_count($posts->post_like_count),
					'post_comment_count' => \bsetecHelpers::lv_count($posts->post_comment_count),
					'user_name' => $posts->username,
					'user_first_name' => $posts->first_name,
					'user_last_name' => $posts->last_name,
					'user_image' => url('image/user/' . $posts->user_id),
					'media' => url('uploads/images/post/' . $posts->media_name),
					'media_image' => url('uploads/images/post/' . $posts->media_image),
					'created_at_ago' => $time . ' ago',
					'created_at' => $posts->created_at,
				);
			}
		}
		$no_page = ceil($total_media_posts / $iPerPage);
		return array('list' => $result, 'count' => $total_media_posts, 'no_page' => $no_page);
	}

	/*
		     * This is the function for getting report types query
	*/

	function getReportTypes() {
		return $postResult = \DB::table('reports')
			->select('*')
			->get();
	}

	/*
		     * This is the function for Inserting Post report
	*/

	function insertPostReport($request) {
		$data = array(
			'user_id' => $request['userid'],
			'post_id' => $request['post_id'],
			'report_id' => $request['report_id'],
			'message' => $request['message'],
			'created_at' => Carbon::now(),
		);

		$userDetails = \DB::table('users')->where('id', $request['userid'])->first();
		$ReportedBy = $userDetails->username;

		$postDetails = \DB::table('posts')
			->select('posts.*', 'users.username as username')
			->join('users', 'users.id', '=', 'posts.user_id')
			->Where('post_id', $request['post_id'])
			->first();
		$PostedBy = $postDetails->username;

		$adminData = \DB::table('users')->where('role', 1)->first();
		$to = $adminData->email;

		$getoptionAll = \DB::table('options')->select('*')->get();
		$optionResult = [
			'app_name' => $getoptionAll[0]->option,
			'logo_url' => $getoptionAll[2]->option,
			'email' => $getoptionAll[1]->option,
		];
		$logoImage = "uploads/images/logo/" . $optionResult['logo_url'];
		$this->commonService->getMail($optionResult['email'], $optionResult['email'], 'Post Report Abuse', ['logo' => $logoImage, 'sitename' => $optionResult['app_name'], 'postedby' => $PostedBy,'reportby' => $ReportedBy,'postmessage' => $data['message'], 'username' => $adminData->username], 'email.post_abuse');
		return \DB::table('post_report')->insertGetId($data);
	}

	/*
		     * This is the function for getting Admin post report list
	*/

	public function getAdminReportLists($request) {
		$user_id = $request['user_id'];
		$access_token = $request['access_token'];
		$page_no = $request['page_no'];
		$keyWord = $request['keyword'];
		$start = 0;
		$iPerPage = 10;
		if (!empty($page_no) && $page_no > 1) {
			$page_no = $page_no - 1;
			$start = $page_no * $iPerPage;
		}
		$total_media_posts = \DB::table('post_report')
			->select('post_report.*', 'reports.types', 'users.first_name', 'users.last_name', 'users.username')
			->join('users', 'users.id', '=', 'post_report.user_id')
			->join('reports', 'reports.report_id', '=', 'post_report.report_id')
			->where(function ($query) use ($keyWord) {
				$query->where('users.username', 'like', '%' . $keyWord . '%')
					->orwhere('users.first_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.last_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.email', 'like', '%' . $keyWord . '%')
					->orwhere('reports.types', 'like', '%' . $keyWord . '%')
					->orwhere('post_report.message', 'like', '%' . $keyWord . '%');
			})
			->orderBy('id', 'desc')->count();
		$post_lists = \DB::table('post_report')
			->select('post_report.*', 'reports.types', 'users.first_name', 'users.last_name', 'users.username')
			->join('users', 'users.id', '=', 'post_report.user_id')
			->join('reports', 'reports.report_id', '=', 'post_report.report_id')
			->where(function ($query) use ($keyWord) {
				$query->where('users.username', 'like', '%' . $keyWord . '%')
					->orwhere('users.first_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.last_name', 'like', '%' . $keyWord . '%')
					->orwhere('users.email', 'like', '%' . $keyWord . '%')
					->orwhere('reports.types', 'like', '%' . $keyWord . '%')
					->orwhere('post_report.message', 'like', '%' . $keyWord . '%');
			})
			->orderBy('id', 'desc')->skip($start)->take($iPerPage)->get();

		$result = array();
		if (count($post_lists) > 0) {
			foreach ($post_lists as $key => $posts) {
				$now = Carbon::now();
				$startTime = Carbon::parse($now);
				$finishTime = Carbon::parse($posts->created_at);
				$time = $finishTime->diffForHumans($startTime, true);
				$result[] = array(
					'post_id' => $posts->post_id,
					'user_id' => $posts->user_id,
					'message' => $posts->message,
					'report_type' => $posts->types,
					'user_name' => $posts->username,
					'user_first_name' => $posts->first_name,
					'user_last_name' => $posts->last_name,
					'user_image' => url('image/user/' . $posts->user_id),
					'created_at_ago' => $time . ' ago',
					'created_at' => $posts->created_at,
				);
			}
		}
		$no_page = ceil($total_media_posts / $iPerPage);
		return array('list' => $result, 'count' => $total_media_posts, 'no_page' => $no_page);
	}

}
