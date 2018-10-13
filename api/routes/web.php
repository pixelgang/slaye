<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * File : router 
 * Use : To create the Api url for mobile application
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', 'ApiController@getIndex');
$router->post('/user/register', 'UserController@postRegister');
$router->post('/user/login', 'UserController@postLogin');
$router->post('/fileupload', 'UtilityController@postUploadfile');
$router->post('/feed_fileuploads', 'UtilityController@postFeedfileUpload');
$router->get('/profile/avatar/{userid}', 'UtilityController@getProfileAvatar');
$router->post('/socialfileupload', 'UtilityController@postSocialUploadfile');
$router->post('/user/forgotpassword', 'UserController@postForgotpassword');
$router->post('/user/adminforgotpwd', 'UserController@postAdminforgotpassword');
$router->post('/user/oauth', 'UserController@postOauth');
$router->get('/metainfo', 'UtilityController@getMetainfo');
$router->get('image/{type}/{name}', 'UtilityController@getImage');
$router->get('/admin/general', 'UserController@getGeneralData');
$router->get('/admin/getmaildata', 'UserController@getMailSettingData');
$router->get('/admin/getmailtemplate', 'UserController@getMailTemplateData');

$router->group(['middleware' => ['auth']], function () use ($router) {
	$router->get('/admin/dashboard-details', 'DashboardController@getDashboardDetails');
	$router->get('/admin/post-user-count', 'DashboardController@getAdminpostusercount');

	$router->put('/user/profile', 'UserController@postEditprofile');
	$router->get('/user/profileinfo', 'UserController@getProfileinfo');
	$router->post('/user/change_password', 'UserController@postChangepassword');
	$router->put('/user/settings', 'UserController@postSettings');
	$router->get('/user/user_list', 'UserController@getUser_list');
	$router->get('/adminuser/user_list', 'UserController@getadminuserlist');
	$router->post('/user/follow_unfollow_block', 'UserController@postFollowunfollowblock');
	$router->get('/user/block_list', 'UserController@getBlock_list');
	$router->get('/user/following_list', 'UserController@getFollowing_list');
	$router->get('/user/followers_list', 'UserController@getFollowers_list');
	$router->get('user/requestlist', 'UserController@getrequestlist');
	$router->post('/user/response_status', 'UserController@postresponsestatus');
	$router->post('/user/delete_user', 'UserController@postDelete_user');
	$router->get('/user/notifications', 'UserController@getNotifications');
	$router->post('/user/notifications_update', 'UserController@postNotificationsupdate');
	$router->post('/user/send_email', 'UserController@postSend_mail');
	$router->post('/post', 'PostController@addPost');
	$router->post('/post/actionbt', 'PostController@postActionpost');
	$router->get('/post/likes', 'PostController@getPostlikes');
	$router->get('/post/comments', 'PostController@getComments');

	$router->get('/post/feeds', 'PostController@getFeeds');
	$router->post('/post/edit-feed', 'PostController@postEditfeed');
	$router->get('/post/media-listing', 'PostController@getMediafeeds');
	$router->get('/report-types', 'PostController@getReportTypes');
	$router->post('/post/report', 'PostController@postReporting');
	$router->get('/admin/post-report-list', 'PostController@getAdminPostReportList');

	$router->get('/admin/pages', 'PagesController@getPagesList');
	$router->post('/admin/pageaction', 'PagesController@postPageAction');
	$router->get('/admin/post-lists', 'PostController@getAdminpostlists');
	$router->get('/admin/post-details', 'PostController@getAdminpostdetails');
	$router->get('/admin/post-comments', 'PostController@getAdminpostcomments');
	$router->get('/admin/post-likes', 'PostController@getAdminpostlikes');
	$router->post('/admin/post-comment-status', 'PostController@postUpdatestatus');

	$router->post('/admin/updateprofile', 'UserController@postUpdateadminprofile');
	$router->get('/admin/memberpostlist', 'PostController@getMemberpostlists');
	$router->get('/admin/user/followers_list', 'UserController@getMemberFollowers_list');
	$router->get('/admin/user/following_list', 'UserController@getMemberFollowing_list');
	$router->post('/admin/user/status_update', 'UserController@userStatusupdate');
	$router->post('/admin/setting', 'UserController@postgeneralSetting');
	$router->post('/admin/mailsetting', 'UserController@postmailSetting');
	$router->post('/admin/mailtemplateupdate', 'UserController@postTemplateUpdate');
});