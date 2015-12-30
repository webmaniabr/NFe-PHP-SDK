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
$chave = '45150819652219000198550990000000011442380343';
$motivo = 'Cancelamento por motivos administrativos.';
$response = $webmaniabr->cancelarNotaFiscal( $chave, $motivo );

if (isset($response->error)){
    
    echo '<h2>Erro: '.$response->error.'</h2>';
    
    if (isset($response->log)){
        
        echo '<h2>Log:</h2>';
        echo '<ul>';
        
        foreach ($response->log as $erros){
            foreach ($erros as $erro) {
                echo '<li>'.$erro.'</li>';
            }
        }
        
        echo '</ul>';
        
    }
    
    exit();
    
} else {

    echo '<h2>Resultado do Cancelamento:</h2>';
    
    $status = (string) $response->status;
    $xml = (string) $response->xml;
    $log = $response->log;
    
    print_r($response);
    exit();
    
}