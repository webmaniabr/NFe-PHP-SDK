<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Status do Sefaz
 *
 * OBS: A utilização do endpoint deve ser realizada como demonstrativo do Status do
 * Sefaz em sua plataforma, sendo necessário trabalhar com cache de ao menos 10 minutos.
 * Não é necessário realizar a requisição antes da emissão de cada Nota Fiscal,
 * porque este procedimento é realizado de forma automática em todos os endpoints.
 */
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$status = $webmaniabr->statusSefaz();

if (!isset($status->error)){

    if ($status){

        echo '<h2>Sefaz: Online</h2>';

    } else {

        echo '<h2>Sefaz: Offline</h2>';

    }

} else {

    echo '<h2>Erro: '.$status->error.'</h2>';
    exit();

}
