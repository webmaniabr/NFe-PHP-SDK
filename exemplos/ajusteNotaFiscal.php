<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Informações da Nota Fiscal Eletrônica
 * Verificar emissaoNotaFiscal.php
 *
 * A Nota Fiscal de Ajuste é destinada somente para fins específicos de escrituração
 * contábil para empresas de Lucro Normal ou Presumido, não representando saída ou entrada
 * de produtos. Utilizado para nota de crédito de ICMS como transferência, ressarcimento
 * ou restituição do ICMS.
 */
$data = array(
    'operacao' => 1, // Tipo de Operação da Nota Fiscal
    'natureza_operacao' => 'CREDITO ICMS S/ ESTOQUE',  // Natureza da Operação
    'codigo_cfop' => 2.949, // Código CFOP de ajuste
    'valor_icms' => 1000.00, // Valor do ICMS a ser ajustado
    'ambiente' => 2, // Identificação do Ambiente do Sefaz
    'cliente' => array( // Informações do cliente
        'cpf' => '000.000.000-00', // Número do CPF
        'nome_completo' => 'Nome completo', // Nome completo
        'endereco' => 'Av. Brg. Faria Lima', // Endereço de entrega dos produtos
        'complemento' => 'Escritório', // Complemento do endereço de entrega
        'numero' => 1000, // Número do endereço de entrega
        'bairro' => 'Itaim Bibi', // Número do endereço de entrega
        'cidade' => 'São Paulo', // Cidade do endereço de entrega
        'uf' => 'SP', // Estado do endereço de entrega
        'cep' => '00000-000', // CEP do endereço de entrega
        'telefone' => '(00) 0000-0000', //Telefone do cliente
        'email' => 'nome@email.com' // E-mail do cliente para envio da NF-e
    )
);

//Emissão de Nota Fiscal de ajuste
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->ajusteNotaFiscal( $data );

// Retorno
if (!isset($response->error)){

    echo '<h2>Ajuste de Nota Fiscal Eletrônica.</h2>';

    $uuid = (string) $response->uuid; // Número único de identificação
    $status = (string) $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
    $nfe = (int) $response->nfe; // Número da NF-e
    $serie = (int) $response->serie; // Número de série
    $recibo = (int) $response->recibo; // Número do recibo
    $chave = $response->chave; // Número da chave de acesso
    $xml = (string) $response->xml;  // URL do XML
    $danfe = (string) $response->danfe; // URL do Danfe (PDF)
    $log = $response->log; // Log de retorno do SEFAZ

    print_r($response);
    exit();

} else {

    echo '<h2> Erro: '.$response->error.'</h2>';

    if(isset($response->log)){
        echo '<h2>Log:</h2>';
        echo '<ul>';

        foreach($response->log as $errors){
            foreach($errors as $erro) {
                echo '<li>'.$erro.'</li>';
            }
        }

        echo '</ul>';
    }

    exit();

}
