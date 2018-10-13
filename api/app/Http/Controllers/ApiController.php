<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Controller : Api Controller
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
namespace App\Http\Controllers;

class ApiController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {

	}
	/** This is the function for render index file to show the document page */
	public function getIndex() {
		return view('api.index');
	}
}
