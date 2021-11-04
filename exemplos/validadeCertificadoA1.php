<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->validadeCertificado();

if (!isset($response->error)){

    if ($response > 45){

        echo '<h2>Certificado Digital A1 válido por '.$response.' dias.</h2>';

    } elseif ($response < 45 && $response >= 1){

        echo '<h2>Emita um novo Certificado Digital A1 - vencerá em '.$response.' dias.</h2>';

    } else {

        echo '<h2>Certificado Digital A1 vencido. Emita um novo para continuar operando.</h2>';

    }

} else {

    echo '<h2>Erro: '.$response->error.'</h2>';
    exit();

}
