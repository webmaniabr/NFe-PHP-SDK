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
$data = array(
  //"referencia" => 'REF0000000', // Código de referência da Classe de Imposto (para editar)
  "descricao" => "Classe de impostos para Saída de produtos de revenda",
  "icms" => array(
    array(
      "tipo_tributacao" => "simples_nacional",
      "cenario" => "saida_dentro_estado",
      "tipo_pessoa" => "fisica",
      "codigo_cfop" => "5102",
      "situacao_tributaria" => "102"
    ),
    array(
      "tipo_tributacao" => "simples_nacional",
      "cenario" => "saida_fora_estado",
      "tipo_pessoa" => "fisica",
      "codigo_cfop" => "6102",
      "situacao_tributaria" => "102"
    ),
    array(
      "tipo_tributacao" => "simples_nacional",
      "cenario" => "saida_dentro_estado",
      "tipo_pessoa" => "juridica",
      "codigo_cfop" => "5102",
      "situacao_tributaria" => "102"
    ),
    array(
      "tipo_tributacao" => "simples_nacional",
      "cenario" => "saida_fora_estado",
      "tipo_pessoa" => "juridica",
      "codigo_cfop" => "6102",
      "situacao_tributaria" => "102"
    ),
  ),
  "ipi" => array(
    array(
      "cenario" => "padrao",
      "tipo_pessoa" => "fisica",
      "situacao_tributaria" => "99",
      "codigo_enquadramento" => "999",
      "aliquota" => "0.00"
    ),
    array(
      "cenario" => "padrao",
      "tipo_pessoa" => "juridica",
      "situacao_tributaria" => "99",
      "codigo_enquadramento" => "999",
      "aliquota" => "0.00"
    )
  ),
  "pis" => array(
    array(
      "cenario" => "padrao",
      "tipo_pessoa" => "fisica",
      "situacao_tributaria" => "99",
      "aliquota" => "0.00"
    ),
    array(
      "cenario" => "padrao",
      "tipo_pessoa" => "juridica",
      "situacao_tributaria" => "99",
      "aliquota" => "0.00"
    )
  ),
  "cofins" => array(
    array(
      "cenario" => "padrao",
      "tipo_pessoa" => "fisica",
      "situacao_tributaria" => "99",
      "aliquota" => "0.00"
    ),
    array(
      "cenario" => "padrao",
      "tipo_pessoa" => "juridica",
      "situacao_tributaria" => "99",
      "aliquota" => "0.00"
    )
  )
);

/**
* Solicitação do cancelamento
*/
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->classeImposto( $data, 'POST' );

/**
* Retorno
*/
if (!isset($response->error)){

  echo '<h2>Classe de imposto criada/editada com sucesso!</h2>';

  $referencia = (string) $response->referencia; // Código de referência da Classe de Imposto
  $descricao = (string) $response->descricao; // Descrição da Classe de Imposto
  $data = $response->data; // Data da criação da Classe de Imposto

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
