<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/../src/WebmaniaBR/NFe.php';
use WebmaniaBR\NFe;

/**
 * Exportação de relatórios
 */

$data = array(
    'data_inicio' => '2020-01-01', // Data de início do relatório, formato americano: YYYY-MM-DD
    'data_final' => '2020-01-31', // Data final do relatório, formato americano: YYYY-MM-DD
    'modelo' => 'nfe', // Modelo da Nota Fiscal (nfe, nfce, cce)
    'relatorio' => 'xml', // Relatório a ser exportado (csv, xml, danfe)
    'status' => 'emitidas', // Filtrar status das Notas Fiscais (emitidas, canceladas, denegadas, inutilizadas)
    'url_notificacao' => 'http://meudominio.com/retorno.php', // URL de notificação com retorno da URL para download do Relatório
    'ambiente' => '2'
);

// Solicita a exportação dos relatórios
$webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
$response = $webmaniabr->exportarRelatorios( $data );

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

    $uuid = (string) $response->uuid; // Número único de identificação da Nota Fiscal
    $status = (string) $response->status; // processando ou concluido
    $data_inicio = (string) $response->data_inicio;
    $data_final = (string) $response->data_final;
    $modelo = (string) $response->modelo;
    $relatorio = (string) $response->relatorio;
    $total = (string) $response->total; // Total de resultados encontrados

    if ($status === 'processando') {

        $processado = (string) $response->processado; // Progresso da exportação

        echo '<h2>Relatórios solicitados. Exportação ainda não concluída. </h2>';

    } else {

        $url = (string) $response->url; // URL de download
        $expira = (string) $response->expira; // Data de expiração do relatório

        echo '<h2>Exportação concluída com sucesso. </h2>';

    }

    print_r($response);
    exit();

}