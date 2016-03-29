<?php

header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../vendor/autoload.php';
use WebmaniaBR\NFe;

$settings = array(
    'oauth_access_token' => '',
    'oauth_access_token_secret' => '',
    'consumer_key' => '',
    'consumer_secret' => '',
);

$webmaniabr = new NFe($settings);

// Pedido
$data = array(
    'ID' => 123456, // Número do pedido
    'operacao' => 1, // Tipo de Operação da Nota Fiscal
    'natureza_operacao' => 'Venda de produção do estabelecimento', // Natureza da Operação
    'modelo' => 1, // Modelo da Nota Fiscal 
    'emissao' => 1, // Tipo de Emissão da NF-e 
    'finalidade' => 1, // Finalidade de emissão da Nota Fiscal
    'ambiente' => 1, // Identificação do Ambiente do Sefaz 
    'cliente' => array(
        'cpf' => '980.453.164-03', // (pessoa fisica) Número do CPF
        'nome_completo' => 'Miguel Pereira da Silva', // (pessoa fisica) Nome completo
        'endereco' => 'Av. Anita Garibaldi', // Endereço de entrega dos produtos
        'complemento' => 'Sala 809 Royal', // Complemento do endereço de entrega
        'numero' => 850, // Número do endereço de entrega
        'bairro' => 'Ahú', // Bairro do endereço de entrega
        'cidade' => 'Curitiba', // Cidade do endereço de entrega
        'uf' => 'PR', // Estado do endereço de entrega
        'cep' => '80540-180', // CEP do endereço de entrega
        'telefone' => '(41) 4063-9102', // Telefone do cliente
        'email' => 'suporte@webmaniabr.com' // E-mail do cliente para envio da NF-e
    ),
    'pedido' => array(
        'pagamento' => 0, // Indicador da forma de pagamento 
        'presenca' => 2, // Indicador de presença do comprador no estabelecimento comercial no momento da operação 
        'modalidade_frete' => 0, // Modalidade do frete 
        'frete' => '12.56', // Total do frete 
        'desconto' => '10.00', // Total do desconto 
        'total' => '174.60' // Total do pedido - sem descontos
    ),
);

// Produtos
$items = array();
foreach($items as $item):

    $data['produtos'][] = array(
        'nome' => 'Camisetas Night Run', // Nome do produto
        'sku' => 'camisetas-10-milhas', // Código identificador - SKU
        'ncm' => '6109.10.00', // Código NCM
        'cest' => '28.038.00', // Código CEST
        'quantidade' => 3, // Quantidade de itens
        'unidade' => 'UN', // Unidade de medida da quantidade de itens 
        'peso' => '0.500', // Peso em KG. Ex: 800 gramas = 0.800 KG
        'origem' => 0, // Origem do produto 
        'subtotal' => '44.90', // Preço unitário do produto - sem descontos
        'total' => '134.70', // Preço total (quantidade x preço unitário) - sem descontos 
        'classe_imposto' => 'REF1637' // Referência do imposto cadastrado 
    );

endforeach;

// Emissão
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
    
    $status = (string) $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
    $nfe = (int) $response->nfe; // número da NF-e
    $serie = (int) $response->serie; // número de série
    $recibo = (int) $response->recibo; // número do recibo
    $chave = $response->chave; // número da chave de acesso
    $xml = (string) $response->xml; // URL do XML
    $danfe = (string) $response->danfe; // URL do Danfe (PDF)
    $log = $response->log;
    
    print_r($response);
    exit();
    
}