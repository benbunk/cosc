cosc
====

Captcha Outsourcing Cannon


Usage
====

Run testget.php to grab the raw html to your console.

Find the following minimum fields (each form is different):

Make sure this is whatever URL would be normally posted to...it can typically be found in the form
declartion.
$url = '';

'form_build_id' => '',
'captcha_sid' => '',
'captcha_token' => '',
'captcha_response' => 'reCAPTCHA',

See notes in the code on how to get this.
'recaptcha_challenge_field' => '',

Using the notes in the code you can pull up the img url and fill this in manually.
'recaptcha_response_field' => '',

Make sure this is set to whatever the page you're posting to is.
CURLOPT_REFERER => '',


Once the above minimum variables and any required variables are filled in run testsend.php 
and you should have successfully submitted the form.