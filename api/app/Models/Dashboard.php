<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model {

	// This is the function for retrun post & user data's

	public function retrunPostUserData($startDate, $endDate) {
		$result['post_count'] = \DB::table('posts')
			->select('posts.created_at')
			->whereBetween('posts.created_at', [$startDate, $endDate])
			->count();
		$result['user_count'] = \DB::table('users')
			->select('users.created_at')
			->whereBetween('users.created_at', [$startDate, $endDate])
			->count();
		return $result;
	}
}
