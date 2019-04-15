<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Credenciais de acesso
 */
 
include __DIR__.'/../src/WebmaniaBR/settings.php';

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