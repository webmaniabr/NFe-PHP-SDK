<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
* Informações da Nota Fiscal Eletrônica
*/
$data = array(
  'ID' => 1137, // Número do pedido (opcional)
  'operacao' => 1, // Tipo de Operação da Nota Fiscal
  'natureza_operacao' => 'Venda de produção do estabelecimento', // Natureza da Operação
  'modelo' => 1, // Modelo da Nota Fiscal
  'finalidade' => 1, // Finalidade de emissão da Nota Fiscal
  'ambiente' => 2, // Identificação do Ambiente do Sefaz
  'url_notificacao' => 'http://meudominio.com/retorno.php' // URL de retorno
);

/**
* Informações do Cliente
* As informações do cliente são montados dentro da array cliente conforme 
* mostrado na tabela Informações da Nota Fiscal. Para notas fiscais de importação 
* e exportação é necessário informar o cliente estrangeiro, mais informações.
*/
$data['cliente'] = array(
  'cpf' => '000.000.000-00', // (pessoa fisica) Número do CPF
  'nome_completo' => 'Nome do Cliente', // (pessoa fisica) Nome completo
  'endereco' => 'Av. Brg. Faria Lima', // Endereço de entrega dos produtos
  'complemento' => 'Escritório', // Complemento do endereço de entrega
  'numero' => 1000, // Número do endereço de entrega
  'bairro' => 'Itaim Bibi', // Bairro do endereço de entrega
  'cidade' => 'São Paulo', // Cidade do endereço de entrega
  'uf' => 'SP', // Estado do endereço de entrega
  'cep' => '00000-000', // CEP do endereço de entrega
  'telefone' => '(00) 0000-0000', // Telefone do cliente
  'email' => 'nome@email.com' // E-mail do cliente para envio da NF-e
);

/**
* Produtos
* A array dos produtos devem ser montadas de acordo com as informações
* do produto no Banco de Dados da sua plataforma, abaixo encontra-se
* um exemplo de dois produtos com Classe de Imposto e Imposto Manual
*/
$data['produtos'] = array(
  array(
    'nome' => 'Nome do produto', // Nome do produto
    'codigo' => 'nome-do-produto', // Código do produto (opcional)
    'ncm' => '6109.10.00', // Código NCM
    'cest' => '28.038.00', // Código CEST (opcional)
    'quantidade' => 3, // Quantidade de itens
    'unidade' => 'UN', // Unidade de medida da quantidade de itens
    'peso' => '0.500', // Peso em KG. Ex: 800 gramas = 0.800 KG (opcional)
    'origem' => 0, // Origem do produto
    'subtotal' => '44.90', // Preço unitário do produto - sem descontos
    'total' => '134.70', // Preço total (quantidade x preço unitário) - sem descontos
    'classe_imposto' => 'REF1000' // Classe de Imposto cadastrado no painel WebmaniaBR ou via API no endpoint /1/nfe/classe-imposto/
    //'informacoes_adicionais' => '' // Características do produto (Cor, tamanho, etc)
  ),
  array(
    'nome' => 'Nome do produto', // Nome do produto
    'codigo' => 'nome-do-produto', // Código do produto (opcional)
    'ncm' => '6109.10.00', // Código NCM
    'cest' => '28.038.00', // Código CEST (opcional)
    'quantidade' => 1, // Quantidade de itens
    'unidade' => 'UN', // Unidade de medida da quantidade de itens
    'peso' => '0.500', // Peso em KG. Ex: 800 gramas = 0.800 KG (opcional)
    'origem' => 0, // Origem do produto
    'subtotal' => '29.90', // Preço unitário do produto - sem descontos
    'total' => '29.90', // Preço total (quantidade x preço unitário) - sem descontos
    'tributos_federais' => '10.00', // Alíquota aproximada dos tributos federais
    'tributos_estaduais' => '10.00', // Alíquota aproximada dos tributos estaduais
    'impostos' => array( // Impostos na API
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
      ),
      /*'issqn' => array(
        'codigo_cfop' => '5.933', // Código Fiscal de Operações e Prestações (CFOP)
        'exigibilidade' => '1', // Indicador da exigibilidade do ISS
        'item_servico' => '00.00', // Item da lista de serviços em que se classifica o serviço no padrão ABRASF,
        'incentivo_fiscal' => '2', // Indicador de incentivo Fiscal
        'aliquota' => '5.00' // Alíquota do ISSQN
       )*/
    ),
    /*// Rastreabilidade de produto (opcional)
    'rastro' => array(
      'lote' => "000001", // Número do Lote do produto
      'quantidade' => "100", // Quantidade de produto no Lote
      'data_fabricacao' => "2018-01-01", // Data de fabricação/produção
      'data_validade' => "2018-01-01" // Data de validade
    )*/
  )
);

/**
* Informações do Pedido
*/
$data['pedido'] = array(
  'presenca' => 2, // Indicador de presença do comprador no estabelecimento comercial no momento da operação
  'intermediador' => 0, // Indicador de intermediador/marketplace 
  /*'cnpj_intermediador' => '03.499.243/0001-04', // CNPJ do Intermediador da Transação (opcional)
  'id_intermediador' => 'Mercado Livre', // Identificador cadastrado no intermediador (opcional) */
  'modalidade_frete' => 0, // Modalidade do frete
  'frete' => '12.56', // Total do frete
  'desconto' => '10.00', // Total do desconto
  'total' => '174.60', // Valor total do pedido pago pelo cliente
  'pagamento' => 0, // Indicador da forma de pagamento: 0 - Pagamento à vista ou 1 - Pagamento a prazo
  'forma_pagamento' => [ 15 ], // Meio de pagamento
  'pagamento' => 0, // Indicador da forma de pagamento
  'forma_pagamento' => '15', // Meio de pagamento (15 - Boleto Bancário),
  //'desc_pagamento' => '', // Descrição do Meio de pagamento (Obrigatório para 99 - Outros)
  /*// Informações do pagamento (opcional)
  'valor_pagamento' => '', // Valor do pagamento
  'cnpj_credenciadora' => '', // // CNPJ da Credenciadora de cartão de crédito/débito
  'bandeira' => "", // Bandeira da operadora do cartão de crédito/débito
  'autorizacao' => "", // Número da autorização da operadora de cartão de crédito/débito (NSU)
  'tipo_integracao' => 2 // Tipo de integração para pagamento*/
  //'informacoes_fisco' => '', // Informações ao Fisco
  //'informacoes_complementares' => ''/ // Informações Complementares ao Consumidor
);

/**
* Informações do Transporte (opcional)
* Volumes e pesos a serem transportados
*/
/*$data['transporte'] = array(
  'volume' => 2, // Quantidade de volumes transportados
  'especie' => "CAIXA", // Espécie dos volumes transportados
  'peso_bruto' => "2.500", // Peso bruto dos volumes transportados
  'peso_liquido' => "2.500" // Peso líquido dos volumes transportados
);*/

/**
* Informações do Transportadora (opcional)
* Importante: não é necessário informar a transportadora para envio realizado pelos Correios.
*/
/*$data['transporte'] = array(
  'volume' => 2, // Quantidade de volumes transportados
  'especie' => "CAIXA", // Espécie dos volumes transportados
  'peso_bruto' => "2.500", // Peso bruto dos volumes transportados
  'peso_liquido' => "2.500", // Peso líquido dos volumes transportados
  'cnpj' => "00.000.000/0000-00", // CNPJ da transportadora
  'razao_social' => "Nome da empresa LTDA", // Razão social da tranportadora
  'ie' => "00000000", // Inscrição Estadual da transportadora
  'endereco' => "Av. Brg. Faria Lima", // Endereço da transportadora
  'uf' => "SP", // Estado da transportadora
  'cidade' => "São Paulo", // Cidade da transportadora
  'cep' => "00000-000" // CEP da transportadora
);*/

/**
* Informações da Fatura (opcional)
*/
/*$data['fatura'] = array(
  'numero' => 2, // Número da Fatura
  'valor' => "CAIXA", // Valor Original da Fatura
  'desconto' => "2.500", // Valor do desconto
  'valor_liquido' => "2.500" // Valor Líquido da Fatura
);*/

/**
* Informações das Parcelas (opcional)
*/
/*$data['parcelas'] = array(
  array(
    'vencimento' => '2019-08-01', // Data de vencimento
    'valor' => '87.30' // Valor da parcela
  ),
  array(
    'vencimento' => '2019-08-01', // Data de vencimento
    'valor' => '87.30' // Valor da parcela
  )
);*/

/**
* Informação do Local de Entrega (opcional)
* Somente informar quando o local de entrega
* é diferente do endereço do cliente
*/
/*$data['transporte']['entrega'] = array(
  'cnpj' => "00.000.000/0000-00", // Número do CNPJ
  'razao_social' => "", // Razão Social
  'ie' => "", // Número da Inscrição Estadual
  'uf' => "", // Estado do endereço de entrega
  'cep' => "00000-000", // CEP do endereço de entrega
  'endereco' => "", // Endereço de entrega dos produtos
  'numero' => "", // Número de entrega dos produtos
  'complemento' => "", // Complemento do endereço de entrega
  'bairro' => "", // Bairro do endereço de entrega
  'cidade' => "" // Cidade do endereço de entrega
);*/

/**
* Informação do Local de Retirada (opcional)
* Somente informar quando o local de retirada
* é diferente do endereço do cliente
*/
/*$data['transporte']['retirada'] = array(
  'cnpj' => "00.000.000/0000-00", // Número do CNPJ
  'razao_social' => "", // Razão Social
  'ie' => "", // Número da Inscrição Estadual
  'uf' => "", // Estado do endereço de entrega
  'cep' => "00000-000", // CEP do endereço de entrega
  'endereco' => "", // Endereço de entrega dos produtos
  'numero' => "", // Número de entrega dos produtos
  'complemento' => "", // Complemento do endereço de entrega
  'bairro' => "", // Bairro do endereço de entrega
  'cidade' => "" // Cidade do endereço de entrega
);*/

// Emissão
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->emissaoNotaFiscal( $data );

// Retorno
if (!isset($response->error)){

  echo '<h2>NF-e enviada com sucesso.</h2>';

  $uuid = (string) $response->uuid; // Número único de identificação da Nota Fiscal
  $status = (string) $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
  $motivo = (string) $response->motivo; // Motivo do status
  $nfe = (int) $response->nfe; // Número da NF-e
  $serie = (int) $response->serie; // Número de série
  $modelo = (string) $response->modelo; // Modelo da Nota Fiscal (nfe, nfce, cce)
  $recibo = (int) $response->recibo; // Número do recibo
  $chave = (string)$response->chave; // Número da chave de acesso
  $xml = (string) $response->xml; // URL do XML
  $danfe = (string) $response->danfe; // URL do Danfe (PDF)
  $danfe_simples = (string) $response->danfe_simples; // URL do Danfe Simples (PDF)
  $danfe_etiqueta = (string) $response->danfe_etiqueta; // URL do Danfe Simplificada - Etiqueta (PDF)
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