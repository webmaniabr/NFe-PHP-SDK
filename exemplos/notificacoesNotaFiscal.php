<?php

header('Content-Type: text/html; charset=utf-8');

/**
 * Ao informar o parâmetro url_notificacao será enviado
 * um retorno no formato POST para a URL especificada.
 * 
 * Method: POST
 * Content-type: x-www-form-urlencoded
 *
 * IMPORTANTE: Cada Nota Fiscal possui um número único 
 * de identificação chamado de UUID, este número deve ser 
 * utilizado para recepcionar e identificar a Nota Fiscal 
 * para atualizar as informações no seu banco de dados.
 */

$uuid = (string) $_POST['uuid']; // Número único de identificação da Nota Fiscal
$status = (string) $_POST['status']; // aprovado, reprovado, cancelado, processamento ou contingencia
$motivo = (string) $_POST['motivo']; // Motivo do status
$nfe = (int) $_POST['nfe']; // Número da NF-e
$serie = (int) $_POST['serie']; // Número de série
$recibo = (int) $_POST['recibo']; // Número do recibo
$chave = (string) $_POST['chave']; // Número da chave de acesso
$modelo = (string) $_POST['modelo']; // Modelo da Nota Fiscal
$xml = (string) $_POST['xml']; // URL do XML
$danfe = (string) $_POST['danfe']; // URL do Danfe (PDF)
$log = $_POST['log']; // Log de retorno do Sefaz
$data = $_POST['data']; // Informações enviadas para emissão da Nota Fiscal

/**
 * Informações que podem ser coletadas pelo retorno Data,
 * sendo as mesmas informações que foram enviadas no
 * momento da emissão da nota fiscal. Retorno das informações
 * para simples conferência.
 */

$ID = $data['ID']; // Número do pedido
$total = $data['pedido']['total']; // Total do pedido
$frete = $data['pedido']['frete']; // Total do frete
$cpf = $data['cliente']['cpf']; // CPF do cliente
$cnpj = $data['cliente']['cnpj']; // CNPJ do cliente
$pedido = $data['pedido']; // Array com informações do pedido
$cliente = $data['cliente']; // Array com informações do cliente
$produtos = $data['produtos']; // Array com informações dos produtos

exit();
