<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Model : Pages
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model {

	/*
		     * This is the function for getting Page list with filter, sort options.
			 * It will be called while admin viewing page list from admin panel.
	*/
	public function pagesaction($page, $filter, $perPage) {
		//get all data from pages table
		$datacount = \DB::table('pages')->get();
		$totalCount = count($datacount);
		$sort = 'id';
		$order = 'DESC';
		$start = $page == 1 ? 0 : $perPage * ($page - 1);
		$order = $order == "asc" && $order == "" ? 'ASC' : $order;

		if ($filter != "") {
			$resultDataCount = \DB::table('pages')
				->where(function ($query) use ($filter) {
					$query->where('title', 'like', '%' . $filter . '%')
						->orwhere('alias', 'like', '%' . $filter . '%')
						->orwhere('status', 'like', '%' . $filter . '%')
						->orwhere('created_at', 'like', '%' . $filter . '%');
				})->orderBy($sort, $order)->get();
			$totalCount = count($resultDataCount);

			$resultData = \DB::table('pages')
				->where(function ($query) use ($filter) {
					$query->where('title', 'like', '%' . $filter . '%')
						->orwhere('alias', 'like', '%' . $filter . '%')
						->orwhere('status', 'like', '%' . $filter . '%')
						->orwhere('created_at', 'like', '%' . $filter . '%');
				})->skip($start)->take($perPage)->orderBy($sort, $order)->get();
		} else {
			$resultData = \DB::table('pages')
				->skip($start)->take($perPage)->orderBy($sort, $order)->get();
		}

		if (count($resultData) > 0) {
			foreach ($resultData as $key => $g_value) {
				$result[] = array(
					'id' => $g_value->id,
					'title' => $g_value->title,
					'alias' => $g_value->alias,
					'status' => $g_value->status,
					'meta_key' => $g_value->meta_key,
					'meta_desc' => $g_value->meta_desc,
					'updated_at' => $g_value->updated_at,
					'created_at' => $g_value->created_at,
				);
			}
		}

		$result = count($resultData) == 0 ? [] : $result;
		return array('result' => $result, 'totalcount' => $totalCount);
	}

}
