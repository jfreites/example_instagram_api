<?php

session_start();

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

define("CLIENT_ID", "TU_ID_CLIENTE");
define("CLIENT_SECRET", "TU_SECRET_KEY");
define("REDIRECT_URL", "http://localhost:9000/confirm.php");

$code = $_GET['code'];

$client = new Client();

$response = $client->post('https://api.instagram.com/oauth/access_token', [
    'form_params' => [
      'client_id' => CLIENT_ID,
      'client_secret' => CLIENT_SECRET,
      'grant_type' => 'authorization_code',
      'redirect_uri' => REDIRECT_URL,
      'code' => $code
    ]
]);

$body = json_decode($response->getBody(true));


$accessToken = $body->access_token;
$user = $body->user;

$_SESSION['auth'] = $accessToken;

header('Location: index.php');
exit(1);

