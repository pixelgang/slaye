<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Controller : Pages Controller
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Http\Controllers;
use App\Models\Pages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class PagesController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->pages = new Pages();
	}

	/*
		     * This is the function for getting list of pages.
			 * It will called while admin viewing page list from admin panel.
	*/

	public function getPagesList(Request $request) {
		$userID = $request->user_id;
		$perPage = 10;
		if ($userID != "") {
			//check user are admin or not
			$ifAdminUser = \DB::table('users')->select('role')->where('id', $userID)->first();
			if ($ifAdminUser->role == 1) {
				$returnData = $this->pages->pagesaction($request->page, $request->filter, $perPage);
				$totalCount = $returnData['totalcount'];
				$pagedata = $returnData['result'];
				return response()->json(array(
					'status' => true,
					'results' => $pagedata,
					'total' => $totalCount,
				)
					, 200);
			} else {
				return response()->json(array(
					'status' => false,
					'errors' => 'Not admin user',
				), 200);
			}
		} else {
			return response()->json(array(
				'status' => false,
				'errors' => array_values($validator->getMessageBag()->toArray()),
			), 401);
		}
	}

	/*
		     * This is the function for page action.
			 * It will called while admin doing these actions (New, View, Update, Delete) in page from admin panel.
	*/

	public function postPageAction(Request $request) {

		if ($request['action_type'] == 3) {
			\DB::table('pages')->where('id', $request['id'])->delete();
			$result = ['status' => true, 'message' => 'Page has been delete successfully'];
		} else if ($request['action_type'] == 2) {
			$getData = \DB::table('pages')->where('id', $request['id'])->get();
			if (count($getData) > 0) {
				$result = ['status' => true, 'data' => $getData];
			} else {
				$result = ['status' => false];
			}
		} else if ($request['action_type'] == 1) {
			$getId = \DB::table('pages')->select('id')->where('alias', $request['alias'])->get();
			if (count($getId) == 1) {
				$result['status'] = false;
				$result['message'] = 'Alias name is unique';
			} else {
				$insertID = \DB::table('pages')->insertGetId([
					'title' => $request['title'],
					'desc' => $request['desc'],
					'alias' => $request['alias'],
					'meta_key' => $request['meta_key'],
					'meta_desc' => $request['meta_desc'],
					'status' => $request['status'],
					'created_at' => Carbon::now(),
				]);
				$filePath = base_path() . "/pages/" . $request['alias'] . '.html';
				@file_put_contents($filePath, $request['desc']);
				if ($insertID != "") {
					$result = ['status' => true, 'message' => 'Page has been created successfully'];
				} else {
					$result = ['status' => false, 'message' => 'Page Data Not Saved'];
				}
			}
		} else if ($request['action_type'] == 4) {
			$getId = \DB::table('pages')->select('id')->where('alias', $request['alias'])->where('id', '<>', $request['id'])->get();
			if (count($getId) == 1) {
				$result['status'] = false;
				$result['message'] = 'Alias name is unique';
			} else {
				$updates = \DB::table('pages')->where('id', $request['id'])->update([
					'title' => $request['title'],
					'desc' => $request['desc'],
					'alias' => $request['alias'],
					'meta_key' => $request['meta_key'],
					'meta_desc' => $request['meta_desc'],
					'status' => $request['status'],
				]);

				$filePath = base_path() . "/pages/" . $request['alias'] . '.html';
				@file_put_contents($filePath, $request['desc']);
				$result = ['status' => true, 'message' => 'Page has been updated successfully'];
			}
		}

		return response()->json($result, 200);
	}

}
