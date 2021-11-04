<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
* Manifestação do Destinatário
*
* A Manifestação do Destinatário é um conjunto de eventos que permitem 
* que o destinatário da NFe possa apontar a sua participação comercial 
* descrita no documento fiscal, confirmando e controlando as operações 
* e informações prestadas pelo seu fornecedor, que é o emissor do documento. 
*/

$chave = '00000000000000000000000000000000000000000000'; // Chave da nota fiscal em que o destinatário irá manifestar sua participação
$ambiente = '1'; // 1 - Produção | 2 - Homologação
$evento = '210200'; // Evento correspondente a participação comercial do destinatário na nota fiscal.
$justificativa = ''; // * Obrigatório caso o Evento seja 210240 - Operação não Realizada

$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->manifestacaoDestinatario( $chave, $ambiente, $evento, $justificativa );

/**
* Retorno
*/
if (!isset($response->error)){

  echo '<h2>Resultado da Manifestação do Destinatário:</h2>';

  $uuid = (string) $response->uuid; // // Número único de identificação
  $status = (string) $response->status; // aprovado ou reprovado
  $evento = (string) $response->evento; // Evento da MDe
  $modelo = (string) $response->modelo;
  $xml = (string) $response->xml; // URL do XML
  $log = $response->log; // Log de retorno do SEFAZ

  print_r($response);
  exit();

} else {

  echo '<h2>Erro: '.$response->error.'</h2>';
  exit();

}
