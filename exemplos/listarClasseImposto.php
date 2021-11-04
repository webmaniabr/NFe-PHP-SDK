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
$response = $webmaniabr->classeImposto( array(), 'GET' );

if (!isset($response->error)){

    echo '<h2>Classe de impostos</h2>';
    echo '<h3>Total encontrado: '.count($response).'</h3>';

    if ( is_array($response) && count($response) > 0 ){

        foreach ($response as $classe_imposto){

            $referencia = (string) $classe_imposto->referencia; // Código de referência da Classe de Imposto
            $descricao = (string) $classe_imposto->descricao; // Descrição da Classe de Imposto
            $data = $classe_imposto->data; // Data da criação da Classe de Imposto

        }

    } else {

        echo '<p>Nenhuma classe de imposto cadastrada.</p>';

    }

    print_r($response);
    exit();

} else {

    echo '<h2>Erro: '.$response->error.'</h2>';
    exit();

}
