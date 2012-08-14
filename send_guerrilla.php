<?php

$mail_offset = 0; // Demo
//$mail_offset = 1; // Live

function curl_get($url) {

$cookie_file = dirname(__FILE__).'/cookie.txt';
$fp = fopen($cookie_file, "w");
fclose($fp);

    $curl_options = array(
      CURLOPT_URL => $url,
      CURLOPT_FAILONERROR => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,

//      CURLOPT_FORBID_REUSE => TRUE,
//      CURLOPT_FRESH_CONNECT => TRUE,

      CURLOPT_HEADER => TRUE,
      CURLOPT_HTTPGET => TRUE,

      CURLOPT_TIMEOUT => 120,
      
      //CURLOPT_POST => TRUE,
      //CURLOPT_POSTFIELDS => $postfields,
//      CURLOPT_REFERER => 'https://petitions.white',
      CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_4) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.57 Safari/537.1',

      CURLOPT_FOLLOWLOCATION => TRUE,

      CURLOPT_COOKIESESSION => TRUE,
      CURLOPT_COOKIEFILE => $cookie_file,
      CURLOPT_COOKIEJAR => $cookie_file,
    );

    $ch = curl_init();    // create curl resource
    curl_setopt_array($ch, $curl_options);

    $curl_return = new stdClass;
    $curl_return->response = curl_exec($ch); // execute and get response
    $curl_return->header   = substr($curl_return->response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $curl_return->body     = substr($curl_return->response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $curl_return->error    = curl_error($ch);
    $curl_return->info     = curl_getinfo($ch);

curl_close($ch);

return $curl_return;
}


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
