<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Credenciais de acesso
 */
include __DIR__.'/../src/WebmaniaBR/settings.php';

/**
* Informações da Carta de Correção
*
* A Carta de Correção Eletrônica (CC-e) é um evento legal e tem por objetivo
* corrigir algumas informações da NF-e que já foi emitida.
*/
$chave = '00000000000000000000000000000000000000000000';
$correcao = 'Exemplo: O CFOP correto é 5.102 referente a revenda tributada no mesmo estado.';

/**
* Solicitação da Carta de Correção
*/
$webmaniabr = new NFe($settings);
$response = $webmaniabr->cartaCorrecao( $chave, $correcao );

/**
* Retorno
*/
if (isset($response->error)){

  echo '<h2>Erro: '.$response->error.'</h2>';
  exit();

} else {

  echo '<h2>Resultado da Carta de Correção:</h2>';

  $status = (string) $response->status; // aprovado ou reprovado
  $xml = (string) $response->xml; // URL do XML
  $dacce = (string) $response->dacce; // URL do Danfe (PDF)
  $log = $response->log; // Log de retorno do SEFAZ

  print_r($response);
  exit();

}
