<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
* Informações da Nota Fiscal Eletrônica
* Verificar emissaoNotaFiscal.php
*/
$data = array();

/**
* Produtos - Com detalhamento específico de Medicamento e de matérias-primas farmacêuticas
* A array dos produtos devem ser montadas de acordo com as informações
* do produto no Banco de Dados da sua plataforma
*/
$data['produtos'] = array(
  array(
    'nome' => 'Nome do produto', // Nome do produto
    'codigo' => 'nome-do-produto', // Código do produto
    'ncm' => '6109.10.00', // Código NCM
    'cest' => '28.038.00', // Código CEST
    'quantidade' => 1, // Quantidade de itens
    'unidade' => 'UN', // Unidade de medida da quantidade de itens
    'peso' => '0.500', // Peso em KG. Ex: 800 gramas = 0.800 KG
    'origem' => 0, // Origem do produto
    'medicamento' => array(
      'codigo_anvisa' => '1234567891234', // Código de Produto da ANVISA
      'pmc' => '10.00' // Preço máximo consumidor
    ),
    'rastro' => array(
      'lote' => '0001', // Número do Lote do produto
      'quantidade' => '1', // Quantidade de produto no Lote
      'data_fabricacao' => '0000-00-00', // Data de fabricação/produção
      'data_validade' => '0000-00-00', // Data de validade
      'codigo_agregacao' => '00000' // Código de Agregação
    ),
    'subtotal' => '29.90', // Preço unitário do produto - sem descontos
    'total' => '29.90', // Preço total (quantidade x preço unitário) - sem descontos
    'tributos_federais' => '10.00', // Alíquota aproximada dos tributos federais
    'tributos_estaduais' => '10.00', // Alíquota aproximada dos tributos estaduais
    'impostos' => array(
      'icms' => array(
        'codigo_cfop' => '6.102', // Código Fiscal de Operações e Prestações (CFOP)
        'situacao_tributaria' => '102', // Código da situação tributária
      ),
      'ipi' => array(
        'situacao_tributaria' => '99', // Código da situação tributária
        'codigo_enquadramento' => '999', // Código de enquadramento
        'aliquota' => '0.00', // Alíquota IPI
      ),
      'pis' => array(
        'situacao_tributaria' => '99', // Código da situação tributária
        'aliquota' => '0.00', // Alíquota PIS
      ),
      'cofins' => array(
        'situacao_tributaria' => '99', // Código da situação tributária
        'aliquota' => '0.00', // Alíquota COFINS
      )
    )
  )
);

/**
* Informações do Pedido
* Verificar emissaoNotaFiscal.php
*/
$data['pedido'] = array();

// Emissão
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->emissaoNotaFiscal( $data );

// Retorno
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

    echo '<h2>NF-e enviada com sucesso.</h2>';

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
