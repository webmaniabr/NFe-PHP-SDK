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
$response = $webmaniabr->validadeCertificado();

if (isset($response->error)){
    
    echo '<h2>Erro: '.$response->error.'</h2>';
    exit();
    
} else {

    if ($response > 45){

        echo '<h2>Certificado Digital A1 válido por '.$response.' dias.</h2>';

    } elseif ($response < 45 && $response >= 1){

        echo '<h2>Emita um novo Certificado Digital A1 - vencerá em '.$response.' dias.</h2>';

    } else {

        echo '<h2>Certificado Digital A1 vencido. Emita um novo para continuar operando.</h2>';

    }
    
}