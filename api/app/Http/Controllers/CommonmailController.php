<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Controller : Commonmail Controller
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */

namespace App\Http\Controllers;
use App\Http\Controllers;
use App\Models\bsetec;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CommonmailController extends Controller {
	/**
	* Use : Controller using for common mail send function
	* Functionality :
	* >>> We add two condidtion here,
	*	1. If option table have SMTP details mail configuration using laravel smtp details
	*   2. Else php @mail function call
	*/
	public function getMail($fromMail = '', $toMail = '', $subject = '', $data = '', $tempname = '') {
		$appUrl = env('APP_URL');
		if(!empty($data)){
			$data['logo'] = (isset($data['logo']))? $appUrl . $data['logo'] : "";
		}
		$getOptionTable = \DB::table('options')->select('*')->get();
		$email_settings = [
			'smtp_host' => $getOptionTable[5]->option,
			'smtp_port' => $getOptionTable[6]->option,
			'smtp_username' => $getOptionTable[7]->option,
			'smtp_password' => $getOptionTable[8]->option,
			'smtp_secure' => $getOptionTable[9]->option,
		];

		if ($email_settings['smtp_host'] != '' && $email_settings['smtp_port'] != '' && $email_settings['smtp_username'] != '' && $email_settings['smtp_password'] != '') {
			$config = array(
				'driver' => 'smtp',
				'host' => $email_settings['smtp_host'],
				'port' => $email_settings['smtp_port'],
				'from' => array('address' => $fromMail, 'name' => null),
				'encryption' => $email_settings['smtp_secure'],
				'username' => $email_settings['smtp_username'],
				'password' => $email_settings['smtp_password'],
				'sendmail' => '/usr/sbin/sendmail -bs',
				'pretend' => false,
			);
			app('config')->set('mail', $config);
			Mail::send($tempname, $data, function ($message) use ($toMail, $fromMail, $subject) {
				$message->from($fromMail);
				$message->to($toMail)->subject($subject);
				$message->replyTo($fromMail, $fromMail);
			});
		} else {
			$message = view($tempname, $data);
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers .= 'From: ' . $fromMail . ' <' . $fromMail . '>' . "\r\n";
			@mail($toMail, $subject, $message, $headers);
		}
	}

}
