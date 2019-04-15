<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Credenciais de acesso
 */
include __DIR__.'/../src/WebmaniaBR/settings.php';

/**
* Informações da Nota Fiscal Eletrônica
*/
$chave = '00000000000000000000000000000000000000000000';
$natureza_operacao = 'Devolução de venda de produção do estabelecimento';
$codigo_cfop = '2.202';
$produtos = [2, 3]; // Número sequencial dos produtos
$quantidade = [5, 1]; // Ex.: Produto 2 = 5 unidades / Produto 3 = 1 unidade
$ambiente = '2'; // 1 - Produção ou 2 - Homologação

/**
* Solicitar devolução
*/
$webmaniabr = new NFe($settings);
$response = $webmaniabr->devolucaoNotaFiscal( $chave, $natureza_operacao, $ambiente, $codigo_cfop, $classe_imposto, $produtos );

/**
* Retorno
*/
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
