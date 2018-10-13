<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Controller : Utility Controller
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;

class UtilityController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/*
		     * This is the function for multiple file upload in user feed.
	*/

	function postFeedfileUpload(Request $request) {
		$rules = array(
			'files' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$image_array = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');
			$video_array = array('video/mp4', 'video/webm', 'video/ogv', 'video/m4v', 'video/x-flv', 'video/flv', 'application/x-mpegURL', 'video/MP2T', 'video/3gpp', 'video/3gp', 'video/x-msvideo', 'video/x-ms-wmv', 'video/quicktime', 'video/MP2T', 'application/x-mpegURL');
			$file_ary = array();
			$file_count = count($request->file('files'));
			$a = ($request->file('files'));
			$finalArray = array();
			$file_count;
			$base = base_path();
			$destinationPath = $base . '/uploads/images/post/';
			for ($i = 0; $i < $file_count; $i++) {
				$sExt = $a[$i]->getClientOriginalExtension();
				$mimeType = $a[$i]->getClientMimeType();
				if ($mimeType == "application/octet-stream") {
					$image_array = array('jpeg', 'jpg', 'gif', 'png');
					$video_array = array('mp4', 'webm', 'ogv', 'm4v', 'x-flv', 'flv', 'x-mpegURL', 'MP2T', '3gpp', '3gp', 'x-msvideo', 'x-ms-wmv', 'quicktime', 'MP2T', 'x-mpegURL');
				}
				if (in_array($mimeType, $image_array) || in_array($mimeType, $video_array)) {
					$fileName = md5(microtime()) . '.' . $sExt;
					$finalArray[$i] = $fileName;
					$a[$i]->move($destinationPath, $fileName);
				} else {
					return response()->json(array('status' => 'false', 'errors' => 'Invalid file'));
				}
			}
			return response()->json(array('status' => 'true', 'fileurl' => $finalArray), 200);
		} else {
			return response()->json(array('status' => 'false', 'errors' => array_values($validator->getMessageBag()->toArray())));
		}
	}

	/*
		     * This function is used for file upload in user avatar, logo & favi-icon upload
	*/

	function postUploadfile(Request $request) {
		if ($request->input('type') == 'fav_icon') {
			$rules = array(
				'file' => 'required|dimensions:width=16,height=16',
			);
		} else {
			$rules = array(
				'file' => 'required',
			);
		}
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$image = Input::file('file');
			$what = getimagesize($image);
			switch (strtolower($what['mime'])) {
			case 'image/png':
				$img_r = imagecreatefrompng($image);
				$source_image = imagecreatefrompng($image);
				$type = '.png';
				break;
			case 'image/jpeg':
				$img_r = imagecreatefromjpeg($image);
				$source_image = imagecreatefromjpeg($image);
				$type = '.jpg';
				break;
			case 'image/gif':
				$img_r = imagecreatefromgif($image);
				$source_image = imagecreatefromgif($image);
				$type = '.gif';
				break;
			default:die('image type not supported');
			}
			$base = base_path();
			if ($request->input('type') == 'avatar') {
				$filename = md5(microtime());
				$destination = $base . '/uploads/images/user/';
			} else if ($request->input('type') == 'post') {
				$filename = md5(microtime());
				$destination = $base . '/uploads/images/user/';
			} else if ($request->input('type') == 'useravatar') {
				$filename = md5(microtime());
				$destination = $base . '/uploads/images/user/';
			} else if ($request->input('type') == 'site_logo' || $request->input('type') == 'fav_icon') {
				$filename = md5(microtime());
				$destination = $base . '/uploads/images/logo/';
			} else {
				$filename = md5(microtime());
				$destination = $base . '/uploads/tmp/';
			}

			$user_data = array();
			$save_path = $filename . $type;
			Image::make($image->getRealPath())->resize($what[0], $what[1])->save($destination . $save_path);
			$user_id = $request->input('user_id');
			if ($request->input('type') == 'useravatar' && $user_id) {
				$update = array();
				$update['profile_pic'] = $save_path;
				\DB::table('users')->where('id', $user_id)->update($update);
				$profile = Users::where('id', $user_id)->first();

				$user_data['first_name'] = $profile->first_name;
				$user_data['last_name'] = $profile->last_name;
				$user_data['username'] = $profile->username;
				$user_data['email'] = $profile->email;
				$user_data['user_id'] = $profile->id;
				$user_data['access_token'] = $profile->password;
				$user_data['state'] = $profile->state ? $profile->state : '';
				$user_data['country'] = $profile->country ? $profile->country : '';
				$user_data['role'] = $profile->role;
				$user_data['is_private'] = $profile->is_private;
				$user_data['is_notify'] = $profile->is_notify;
				$user_data['follower_count'] = $profile->follower_count;
				$user_data['following_count'] = $profile->following_count;
				$user_data['profile_pic'] = \bsetecHelpers::getProfilePicture($user_id, $profile);
			}
			return response()->json(['status' => 'true', 'fileurl' => $save_path, 'user_info' => $user_data]);
		} else {
			return response()->json(['status' => 'false', 'errors' => array_values($validator->getMessageBag()->toArray())]);
		}
	}

	/*
		     * This is the function for Set avatar from Social networking url.
			 * It will called while user register/login with social networking app from mobile application.
	*/

	function postSocialUploadfile(Request $request) {
		$rules = array(
			'url' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$imageURL = $request->url;
			$base = base_path();
			$filename = md5(microtime());
			$image_name = $filename . '.jpg';
			@copy($imageURL, $base . '/uploads/images/user/' . $filename . '.jpg');
			return response()->json(['status' => true, 'imagename' => $image_name]);
		} else {
			return response()->json(['status' => false, 'errors' => array_values($validator->getMessageBag()->toArray())]);
		}
	}

	/*
		     * This function used to getting image for user post, user profile image and site logo & favi image
	*/

	function getImage($type, $name = NULL) {
		$basepath = dirname(dirname(__FILE__));
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$base = str_replace('\app\Http', '', base_path());
			base_path();
		} else {
			$base = str_replace('/app/Http', '', base_path());
			base_path();
		}

		if (strlen($type) == 0 || strlen($name) == 0) {
			$content_type = 'image/png';
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				$destination = $base . '\uploads\images\default.png';
			} else {
				$destination = $base . '/uploads/images/default.png';
			}
		}
		if ($type == 'user') {
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				$destination = $base . '\uploads\images\user\default.png';
			} else {
				$destination = $base . '/uploads/images/user/default.png';
			}
			$content_type = 'image/png';
			$profile = Users::where('id', $name)->first();
			if (strlen($profile->profile_pic) > 0) {
				if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
					$destination = $base . '\uploads\images\user\\' . $profile->profile_pic;
				} else {
					$destination = $base . '/uploads/images/user/' . $profile->profile_pic;
				}
				$content_type = 'image/jpeg';
			}
		}

		if (!file_exists($destination)) {
			$content_type = 'image/png';
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				$destination = $base . '\uploads\images\default.png';
			} else {
				$destination = $base . '/uploads/images/default.png';
			}
		}
		$file = fopen($destination, "rb");
		$size = filesize($destination);
		$content = fread($file, $size);
		fclose($file);

		return response($content)
			->header('Content-Type', $content_type)
			->header('Pragma', 'public')
			->header('Content-Disposition', 'inline; filename="qrcodeimg.png"')
			->header('Cache-Control', 'max-age=60, must-revalidate');
	}

	/* 
		*This function is used to getting pages table details for admin dynamic blog or page creation
	*/

	function getCmspage(Request $request) {
		$data = \DB::table('pages')->where('alias', $request['alias'])->get();
		if (count($data) == 0) {
			return response()->json(['status' => false, 'errorpage' => 404, 'message' => 'Page not found']);
		} else {
			return response()->json(['status' => true, 'data' => $data, 'message' => 'Page found']);
		}
	}

	/*
		     * This function is used to getting meta information for admin back-end page logo, app-name & favi-icon dynamically set functionality.
	*/

	public function getMetainfo(Request $request) {
		$data = array();
		$app_name = \DB::table('options')->get();

		$data['app_name'] = $app_name['0']->option;
		$data['front_logo'] = $app_name['2']->option;
		$data['fav_icon'] = $app_name['3']->option;
		return response()->json(['status' => 'true', 'data' => $data]);
	}

	/*
		     * This is the function for Display Profile Avatar image from userId
			 * It will be used by mobile application. By passing userid, we will show avatar image.
	*/

	public function getProfileAvatar(Request $request, $userid) {
		$profileRec = \DB::table('users')->select('profile_pic', 'gender')->where('id', $userid)->get();
		$profile = $profileRec[0];
		if (strlen($profile->profile_pic) > 0) {
			$imgData = explode('.', $profile->profile_pic);
			$mIndex = count($imgData);
			$mIndex--;
			$sExt = $imgData[$mIndex];
		} else {
			$sExt = 'png';
		}
		$profilePic = \bsetecHelpers::getProfilePicture($userid, $profile);
		switch ($sExt) {
		case 'png':
			$sCntType = 'image/x-png';
			break;
		case 'gif':
			$sCntType = 'image/gif';
			break;
		default:
			$sCntType = 'image/jpeg';
		}
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:" . $sCntType);
		readfile($profilePic);
		exit;
	}

}
