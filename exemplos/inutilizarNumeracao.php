<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

$sequencia = '101-109';
$motivo = 'Cancelamento por motivos administrativos.';
$ambiente = '2'; // 1 - Produção ou 2 - Homologação

$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->inutilizarNumeracao( $sequencia, $motivo, $ambiente );

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

    echo '<h2>Resultado da Inutilização:</h2>';

    $xml = (string) $response->xml;
    $log = $response->log;

    print_r($response);
    exit();

}
