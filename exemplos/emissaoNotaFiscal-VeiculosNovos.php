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
* Verificar emissaoNotaFiscal.php
*/
$data = array();

/**
* Produtos - Com detalhamento específico de Veículos Novos
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
    'veiculos_novos' => array(
      'tipo_operacao' => 1, // Tipo da operação
      'chassi' => '0000000000000000000000', // Chassi do Veículo
      'cor' => 'A1', // Cor
      'cor_descricao' => 'Descrição da Cor', // Descrição da Cor
      'cv' => '100', // Potência Motor (CV)
      'cilindrada' => '1000', // Cilindradas
      'peso_liquido' => '2.5000', // Peso líquido
      'peso_bruto' => '2.5000', // Peso bruto total
      'serie' => '00001', // 	Serial (série)
      'tipo_combustivel' => '16', // Tipo de combustível
      'numero_motor' => '00001', // Número de motor
      'cmt' => '2.000', // Capacidade Máxima de Tração
      'dist' => '150', // Distância entre eixos
      'ano_modelo' => '2019', // Ano Modelo de Fabricação
      'ano_fabricacao' => '2018', // Ano de Fabricação
      'tipo_pintura' => '1', //	Tipo de Pintura
      'tipo_veiculo' => '06', // Tipo de Veículo
      'especie_veiculo' => '1', // Espécie de Veículo
      'vin' => 'N', // Condição do VIN
      'condicao_veiculo' => '1', // Condição do veículo
      'marca_modelo' => '00001', // Código Marca Modelo
      'cor_denatran' => '04', // Código da Cor do DENETRAN
      'lotacao' => '5', // Capacidade máxima de lotação
      'restricao' => '0' // Restrição
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
$webmaniabr = new NFe($settings);
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
