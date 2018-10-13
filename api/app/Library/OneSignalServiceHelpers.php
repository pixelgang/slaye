<?php
/**
 * Company : Bsetec
 * Product: Instasocial
 * Library : Middleware library file which is going to communicate from Laravel to OneSignal via CURL 
 * Email : support@bsetec.com
 * Copyright © 2018 BSEtec. All rights reserved.
 */
class OneSignalServiceHelpers{
    /**
     * Send new notification with provided data.
     *
     * Application authentication key and ID must be set.
     *
     * @param array $data => Push notification related input data
     *
     * @return array => Returns response from OneSignal api.
     */
    public static function sendPushNotification($playerId, $data = array()) {
        /* One Signal App Id */
        $oData = \DB::table('options')->where('option_key', 'onesignal_appid')->first();
		$oAppId = $oData->option;
		$appId = $oAppId;
        if (empty($data) || empty($playerId))
            return;
        $content = array(
            "en" => $data['message']
        );
        $headings = array(
            "en" => ($data['title']) ? $data['title'] : 'InstaSocial'
        );
        $iosBatch = (int) (isset($data['ios_badgeCount'])) ? $data['ios_badgeCount']:0;
        $inputD = array(
            'app_id' => $appId,
            'include_player_ids' => $playerId,
            'headings' => $headings,
            'contents' => $content,
            'data' => $data,
            'ios_badgeType' => 'SetTo',
            'ios_badgeCount' => $iosBatch
        );
        echo '<pre>';
        print_r(json_encode($inputD));
        $reponse = \OneSignalServiceHelpers::curlExecutePost(json_encode($inputD), '/notifications');
        return $reponse;
    }
    /**
     * This is the POST method curl function for communicating to OneSignal api.
     */
    public static function curlExecutePost($data, $apiName) {
        /* One Signal Api url */
        $apiUrl = 'https://onesignal.com/api/';
        /* One Signal App key */
        $oData = \DB::table('options')->where('option_key', 'onesignal_appkey')->first();
		$oAppKey = $oData->option;
        $apiKey = $oAppKey;
        /* api version - v1 */
        $version = 'v1';
        $query_url = $apiUrl . $version . $apiName;
        $ch = curl_init();
        // set url 
        curl_setopt($ch, CURLOPT_URL, $query_url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $apiKey));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // $output contains the output string 
        $output = curl_exec($ch);
        // close curl resource to free up system resources
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }
    /**
     * This is the GET method curl function for communicating to OneSignal api.
     */
    public function getNotifications($offset = 0, $limit = 10) {
        $url = $apiUrl . $version . "/notifications?app_id=" . $appId . "&limit=" . $limit . "&offset=" . $offset . "&view_notification_type=api";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic " . $apiKey,
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;
    }

}
