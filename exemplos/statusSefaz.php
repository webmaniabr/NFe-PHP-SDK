<?php

header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../vendor/autoload.php';
use WebmaniaBR\NFe;

$settings = array(
    'oauth_access_token' => '',
    'oauth_access_token_secret' => '',
    'consumer_key' => '',
    'consumer_secret' => '',
);

$webmaniabr = new NFe($settings);
$response = $webmaniabr->statusSefaz();

if (isset($response->error)){
    
    echo '<h2>Erro: '.$response->error.'</h2>';
    exit();
    
} else {

    if ($response){

        echo '<h2>Sefaz: Online</h2>';

    } else {

        echo '<h2>Sefaz: Offline</h2>';

    }
    
}