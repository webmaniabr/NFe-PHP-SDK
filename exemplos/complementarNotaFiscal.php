<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Informações da Nota Fiscal Complementar
 *
 * A Nota Fiscal Complementar é destinada para acrescentar dados e valores
 * não informados no documento fiscal original. Utilizado para acréscimo no preço
 * e quantidade da mercadoria ou somar valores faltantes dos impostos ICMS, ICMS-ST e IPI.
 *
 * OBS: Deve ser complementado o Preço/Quantidade OU Impostos.
 * OB2: Caso deseje complementar as duas opções devem ser emitidas NF-e separadas.
 */
$data = array(
    'nfe_referenciada' => '00000000000000000000000000000000000000000000',
    'operacao' => 1,
    'natureza_operacao' => 'COMPLEMENTAR',
    'ambiente' => 2,
    'cliente'=> array(
        'cpf' => '000.000.000-00',
        'nome_completo' => 'Nome completo',
        'endereco' => 'Av. Brg. Faria Lima',
        'complemento' => 'Escritorio',
        'numero' => 1000,
        'bairro' => 'Itaim Bibi',
        'cidade' => 'São Paulo',
        'uf' => 'SP',
        'cep' => '00000-000',
        'telefone' => '(00) 0000-0000',
        'email' => 'nome@email.com',
    )
);

/**
* Complementar Preço e/ou quantidade
*/
$data['produtos'] = array(
    array(
        'nome' => 'Nome do produto',
        'codigo' => 'nome-do-produto',
        'ncm' => '6109.10.00',
        'cest' => '28.038.00',
        'quantidade' => 1, // Complementar quantidade
        'unidade' => 'UN',
        'origem' => 0,
        'subtotal' => '29.90', // Complementar preço
        'total' => '29.90', // Complementar preço
        'impostos' => array(
          'icms' => array(
            'codigo_cfop' => '6.102', // Código Fiscal de Operações e Prestações (CFOP)
            'situacao_tributaria' => '102', // Código da situação tributária
          ),
        )
      )
);

/**
* Complementar Impostos (ICMS, ICMS ST e/ou IPI)
*/
$data['impostos'] = array(
  "codigo_cfop" => "6.102", // Código CFOP
  "situacao_tributaria" => "900", // Situação tributária do ICMS
  "bc_icms" => "100.00", // Complementar ICMS
  "valor_icms" => "18.00" // Complementar ICMS
);

//Emissão
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->complementarNotaFiscal( $data );

//Retorno
if (!isset($response->error)){

    echo '<h2>NF-e complementar enviada com sucesso.</h2>';

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
        echo '<h2>Log: </h2>';
        echo '<ul>';

        foreach ($response->log as $errors){
            foreach($errors as $erro){
                echo '<li>'.$erro.'</li>';
            }
        }

        echo '</ul>';
    }

    exit();

}
