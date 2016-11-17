<?php

session_start();

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

define("CLIENT_ID", "0e60bda7e475412188323fe22fde5f2b");
define("CLIENT_SECRET", "ae2c135c3ca44890befe4c8bff3523e0");
define("REDIRECT_URL", "http://localhost:9000/confirm.php");

if ($_SESSION['auth']) {

  // Fetch images by tag 'inktober'
  $endpoint = 'tags/inktober/media/recent?access_token='.$_SESSION['auth'];
  //$endpoint = 'media/search?lat=19.432608&lng=-99.133209&access_token='.$token;

  $client = new GuzzleHttp\Client(['base_uri' => 'https://api.instagram.com/v1/']);

  $request = new Request('GET', $endpoint);

  $response = $client->send($request);

  $content = json_decode($response->getBody());

  $items = $content->data;

  if (!$items) {
    echo 'No existing media for provided location';
  }

  foreach ($items as $item) {
    echo '<p><img src="'.$item->images->low_resolution->url.'"></p>';
    echo '<p>Pie de foto: '.$item->caption->text.'</p>';
    echo '<p>Filtros: '.$item->filter.'</p>';
    echo '<ul>Tags:';
    foreach ($item->tags as $tag) {
      echo '<li>'.$tag.'</li>';
    }
    echo '</ul>';
    echo '<p>Usuario: '.$item->caption->from->username.'</p>';
    echo '<p>Localidad: '.is_null($item->location) ? 'N/A' : $item->location.'</p>';
  }


} else {
  header('Location: request_auth.php');
  exit(1);
}
