<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
* Cancelar Nota Fiscal
*
* Atenção: Somente poderá ser cancelada uma NF-e cujo uso tenha sido previamente
* autorizado pelo Fisco e desde que não tenha ainda ocorrido o fato gerador, ou seja,
* ainda não tenha ocorrido a saída da mercadoria do estabelecimento. Atualmente o prazo
* máximo para cancelamento de uma NF-e é de 24 horas (1 dia), contado a partir da autorização
* de uso. Caso já tenha passado o prazo de 24 horas ou já tenha ocorrido a circulação da
* mercadoria, emita uma NF-e de devolução para anular a NF-e anterior.
*/
$chave = '00000000000000000000000000000000000000000000';
$motivo = 'Exemplo: Cancelamento por motivos administrativos.';

/**
* Solicitação do cancelamento
*/
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->cancelarNotaFiscal( $chave, $motivo );

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

  echo '<h2>Resultado do Cancelamento:</h2>';

  $status = (string) $response->status;
  $xml = (string) $response->xml;
  $log = $response->log;

  print_r($response);
  exit();

}
