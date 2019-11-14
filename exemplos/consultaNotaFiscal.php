<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
* Consulta de Nota fiscal
*
* Atenção: Somente é permitido consultar a chave da nota fiscal emitida pelo
* emissor da WebmaniaBR, não sendo possível consultar nota fiscal de terceiro
* ou emitida em outro sistema.
*/
$chave = '00000000000000000000000000000000000000000000';

/**
* Solicitação da consulta
*/
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->consultaNotaFiscal( $chave );

/**
* Retorno
*/
if (isset($response->error)){

  echo '<h2>Erro: '.$response->error.'</h2>';
  exit();

} else {

  echo '<h2>Resultado da Consulta:</h2>';

  $uuid = (string) $response->uuid; // Número único de identificação da Nota Fiscal
  $status = (string) $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
  $nfe = (int) $response->nfe; // Número da NF-e
  $serie = (int) $response->serie; // Número de série
  $recibo = (int) $response->recibo; // Número do recibo
  $chave = $response->chave; // Número da chave de acesso
  $xml = (string) $response->xml; // URL do XML
  $danfe = (string) $response->danfe; // URL do Danfe (PDF)
  $log = $response->log; // Log do Sefaz

  print_r($response);
  exit();

}
