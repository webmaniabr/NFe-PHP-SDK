<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
* Informações da Carta de Correção
*
* A Carta de Correção Eletrônica (CC-e) é um evento legal e tem por objetivo
* corrigir algumas informações da NF-e que já foi emitida.
*/
$chave_uuid = '00000000000000000000000000000000000000000000'; // Chave ou UUID
$correcao = 'Exemplo: O CFOP correto é 5.102 referente a revenda tributada no mesmo estado.';
//$ambiente = '1'; // 1 - Produção | 2 - Homologação
//$evento = '1'; // Número do evento (1 a 20)
//$url_notificacao = 'https://meudominio.com/retorno.php'; // URL de Notificação

/**
* Solicitação da Carta de Correção
*/
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->cartaCorrecao( $chave_uuid, $correcao, $ambiente, $evento, $url_notificacao );

/**
* Retorno
*/
if (!isset($response->error)){

  echo '<h2>Resultado da Carta de Correção:</h2>';

  $status = (string) $response->status; // aprovado ou reprovado
  $xml = (string) $response->xml; // URL do XML
  $dacce = (string) $response->dacce; // URL do Danfe (PDF)
  $log = $response->log; // Log de retorno do SEFAZ

  print_r($response);
  exit();

} else {

  echo '<h2>Erro: '.$response->error.'</h2>';
  exit();

}
