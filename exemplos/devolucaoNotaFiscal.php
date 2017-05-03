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
$natureza_operacao = 'Devolução de venda de produção do estabelecimento';
$ambiente = '1'; // 1 - Produção ou 2 - Homologação
$codigo_cfop = '2.202';
//$classe_imposto = 'REF1637'; // Obrigatório caso não informado o Código CFOP
$produtos = array( 2, 3 ); // Obrigatório para devolução parcial

$response = $webmaniabr->devolucaoNotaFiscal( $chave, $natureza_operacao, $ambiente, $codigo_cfop, $classe_imposto, $produtos );

// Retorno
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

    echo '<h2>NF-e de devolução emitida com sucesso.</h2>';

    $status = (string) $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
    $nfe = (int) $response->nfe; // número da NF-e
    $serie = (int) $response->serie; // número de série
    $recibo = (int) $response->recibo; // número do recibo
    $chave = $response->chave; // número da chave de acesso
    $xml = (string) $response->xml; // URL do XML
    $danfe = (string) $response->danfe; // URL do Danfe (PDF)
    $log = $response->log;

    print_r($response);
    exit();

}
