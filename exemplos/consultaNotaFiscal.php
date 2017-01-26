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
$ambiente = '1'; // 1 - Produção ou 2 - Homologação
$response = $webmaniabr->consultaNotaFiscal( $chave, $ambiente );

if (isset($response->error)){

    echo '<h2>Erro: '.$response->error.'</h2>';
    exit();

} else {

    echo '<h2>Resultado da Consulta:</h2>';

    $status = (string) $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
    $nfe = (int) $response->nfe; // número da NF-e
    $serie = (int) $response->serie; // número de série
    $recibo = (int) $response->recibo; // número do recibo
    $chave = (int) $response->chave; // número da chave de acesso
    $xml = (string) $response->xml; // URL do XML
    $danfe = (string) $response->danfe; // URL do Danfe (PDF)
    $log = $response->log;

    print_r($response);
    exit();

}
