<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
* Informações da Nota Fiscal Eletrônica
*/
$chave_uuid = '00000000000000000000000000000000000000000000'; // Chave ou UUID
$natureza_operacao = 'Devolução de venda de produção do estabelecimento'; // Natureza da Operação
$ambiente = '1'; // 1 - Produção | 2 - Homologação
$classe_imposto = 'REF000000'; // Para Notas Fiscais emitidas com Classe de Imposto (Classe de imposto de devolução)
$codigo_cfop = '2.202'; // Para Notas Fiscais emitidas com Impostos via API (Código CFOP de devolução)
$produtos = [2, 3]; // Número sequencial dos produtos
$quantidade = [5, 1]; // Ex.: Produto 2 = 5 unidades / Produto 3 = 1 unidade
//$volume = ''; // Quantidade de volumes transportados
//$informacoes_fisco = ''; // Informações ao Fisco
//$informacoes_complementares = ''; // Informações Complementares ao Consumidor
//$url_notificacao = 'https://meudominio.com/retorno.php'; // URL de notificação

/**
* Solicitar devolução
*/
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->devolucaoNotaFiscal( $chave_uuid, $natureza_operacao, $ambiente, $codigo_cfop, $classe_imposto, $produtos, $volume, $informacoes_fisco, $informacoes_complementares, $url_notificacao );

/**
* Retorno
*/
if (!isset($response->error)){

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

} else {

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

}
