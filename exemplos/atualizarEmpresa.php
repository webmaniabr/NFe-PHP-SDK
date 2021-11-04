<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Atualizar dados da empresa
 *
 * Atenção: As informações da sua empresa devem ser igual
 * ao Cadastro Nacional da Pessoa Jurídica da Receita Federal.
 */

$data = array(
    'cnpj' => '00.000.000/0000-00',
    'razao_social' => 'Nome da empresa LTDA',
    'nome_fantasia' => 'Nome da empresa',
    'ie' => '0000000000',
    'unidade_empresa' => 'matriz',
    'email' => 'email',
    'subdominio' => 'nfe.meudominio.com.br',
    'url_notificacao' => 'http://meudominio.com/retorno.php',
    'logomarca' => 'http://meudominio.com.br/logomarca.jpg'
);

// Solicita a atualização dos dados
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->atualizarEmpresa( $data );

// Retorno
if (!isset($response->error)){

    $sucess = (string) $response->success;

    echo "<h2>Resultado da atualização: {$sucess}</h2>";

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
