cosc
====

Captcha Outsourcing Cannon

Files
====

1. quick_curl.php - An include for reusable curl...its my personal cheat sheet thats faster then learning guzzle.
2. send_guerrilla.php - A standalone script that allows you to get a mail message from the disposable mail service.
3. get_captcha.php - Get a captcha image URL for a specific site and form combination. (Sometimes sitewide)
4. get_userreg_form.php - Get the user registration form tokens for a Drupal site.
5. send_userreg_form.php - Programmatically submit a Drupal user registration form using a previously solved 
                         - captcha and form token.

Usage - quick_curl.php
====

Include quick_curl.php at the top of your script. @see send_guerrilla.php 
  require_once(dirname(__FILE__) . 'quick_curl.php');
  
curl_get($url) - Pass a fully qualified url.
Return - A curl_response object with the following properties:
  $curl_return->response - The Full response.
  $curl_return->header   - Only the response header (As good as curls byte order lets us get).
  $curl_return->body     - Only the body (As good as curls byte order lets us get).
  $curl_return->error    - Curl Errors.
  $curl_return->info     - Extended Curl info.

Usage - send_guerrilla.php
====

For now all you can do is use the send_guerrilla.php file to get the 1st non-default email body for a specified 
email address on the guerrillamail.com disposable email service.

php send_querrilla.php

You'll have to edit the php file to specify you email address in this line:
  $email = 'bbb+testcaptcha4';
Replace bbb+testcaptcha4 with whatever you email address is...leave out the @guerrillamail.com part.

To switch from fetching the demo email to fetching the 1st real email, comment out the Demo line and uncomment 
the Live line. Like below:
  //$mail_offset = 0; // Demo
  $mail_offset = 1; // Live

