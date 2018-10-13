<?php
$getOptionTable = \DB::table('options')->select('*')->get();
$email_settings = [
    'smtp_host' => $getOptionTable[5]->option,
    'smtp_port' => $getOptionTable[6]->option,
    'smtp_username' => $getOptionTable[7]->option,
    'smtp_password' => $getOptionTable[8]->option,
    'smtp_secure' => $getOptionTable[9]->option
];

return array(
  "driver" => env('MAIL_DRIVER', 'smtp'),
  "host" => $email_settings['smtp_host'],
  "port" => $email_settings['smtp_port'],
  "from" => array(
      "address" => $getOptionTable[1]->option,
      "name" => "info"
  ),
  'encryption' => $email_settings['smtp_secure'],
  "username" => $email_settings['smtp_username'],
  "password" => $email_settings['smtp_password'],
  "sendmail" => "/usr/sbin/sendmail -bs",
  "pretend" => false
);
