<?php

require_once(dirname(__FILE__) . 'quick_curl.php');

$mail_offset = 0; // Demo
//$mail_offset = 1; // Live

/////// Setup a session
// Set options
$ip_address = isset($_SERVER['remote_addr']) ? $_SERVER['remote_addr'] : '127.0.0.1';
$agent = 'Bens shit';
$url = 'http://api.guerrillamail.com/ajax.php?f=get_email_address&ip=' . $ip_address . '&agent=' . urlencode($agent);

$curl_return = curl_get($url);
//var_dump($curl_return);
$json = json_decode($curl_return->body);


/////// Register an email with the session.
// Set options
$sid_token = $json->sid_token;
$email = 'bbb+testcaptcha4';
$url = 'https://www.guerrillamail.com/ajax.php?f=set_email_user&email_user=' . $email . '&sid_token=' . $sid_token;

$curl_return = curl_get($url);
$json = json_decode($curl_return->body);

////// Get Email List.
// Set options.
$url = 'https://www.guerrillamail.com/ajax.php?f=check_email&sid_token=' . $sid_token . '&seq=0';

$curl_return = curl_get($url);
$json = json_decode($curl_return->body);
$mail_id = $json->list[$mail_offset]->mail_id;


/////// Get email contents.
// Set options
$url = 'https://www.guerrillamail.com/ajax.php?f=fetch_email&sid_token=' . $sid_token . '&email_id=' . $mail_id;

$curl_return = curl_get($url);
$json = json_decode($curl_return->body);
var_dump($json->mail_body);
