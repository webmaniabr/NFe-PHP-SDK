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
$correcao = 'O CFOP correto é 5.102 referente a revenda tributada no mesmo estado.';
$ambiente = '1'; // 1 - Produção ou 2 - Homologação
$response = $webmaniabr->cartaCorrecao( $chave, $correcao, $ambiente );

if (isset($response->error)){

    echo '<h2>Erro: '.$response->error.'</h2>';
    exit();

} else {

    echo '<h2>Resultado da Carta de Correção:</h2>';

    $status = (string) $response->status; // aprovado ou reprovado
    $xml = (string) $response->xml; // URL do XML
    $dacce = (string) $response->dacce; // URL do Danfe (PDF)
    $log = $response->log;

    print_r($response);
    exit();

}
