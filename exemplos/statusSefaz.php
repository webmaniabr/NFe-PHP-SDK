<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Credenciais de acesso
 */
include __DIR__.'/../src/WebmaniaBR/settings.php';

/**
 * Status do Sefaz
 *
 * OBS: A utilização do endpoint deve ser realizada como demonstrativo do Status do
 * Sefaz em sua plataforma, sendo necessário trabalhar com cache de ao menos 10 minutos.
 * Não é necessário realizar a requisição antes da emissão de cada Nota Fiscal,
 * porque este procedimento é realizado de forma automática em todos os endpoints.
 */
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
