<?php

function curl_get($url) {

  $cookie_file = dirname(__FILE__).'/cookie.txt';
  $fp = fopen($cookie_file, "w");
  fclose($fp);

  $curl_options = array(
    CURLOPT_URL => $url,
    CURLOPT_FAILONERROR => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,

//    CURLOPT_FORBID_REUSE => TRUE,
//    CURLOPT_FRESH_CONNECT => TRUE,

    CURLOPT_HEADER => TRUE,
    CURLOPT_HTTPGET => TRUE,

    CURLOPT_TIMEOUT => 30,
      
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_4) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.57 Safari/537.1',

    CURLOPT_FOLLOWLOCATION => TRUE,

//    CURLOPT_COOKIESESSION => TRUE,
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

function curl_post($url, $post_fields) {
  $cookie_file = dirname(__FILE__).'/cookie.txt';
  $fp = fopen($cookie_file, "w");
  fclose($fp);

  $curl_options = array(
    CURLOPT_URL => $url,
    CURLOPT_FAILONERROR => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,

//    CURLOPT_FORBID_REUSE => TRUE,
//    CURLOPT_FRESH_CONNECT => TRUE,

    CURLOPT_HEADER => TRUE,
  
    CURLOPT_TIMEOUT => 30,
      
    CURLOPT_POST => TRUE,
    CURLOPT_POSTFIELDS => $post_fields,
    CURLOPT_REFERER => $url,
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_4) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.57 Safari/537.1',

    CURLOPT_FOLLOWLOCATION => TRUE,

//    CURLOPT_COOKIESESSION => TRUE,
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
  
  var_dump(file_get_contents($cookie_file));

  return $curl_return;
}

