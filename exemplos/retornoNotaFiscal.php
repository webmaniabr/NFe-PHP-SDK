<?php

header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../vendor/autoload.php';
use WebmaniaBR\NFe;

/**
 * Ao informar o parâmetro url_notificacao será enviado
 * um retorno no formato POST para a URL especificada.
 *
 * IMPORTANTE: O retorno deve ser tratado pela série
 * e número de nota fiscal e não pela chave, porque
 * a chave pode ser alterada quando a nota é emitida
 * no modo em contingência.
 */

$status = (string) $_POST['status']; // aprovado, reprovado, cancelado, processamento ou contingencia
$nfe = (int) $_POST['nfe']; // número da NF-e
$serie = (int) $_POST['serie']; // número de série
$recibo = (int) $_POST['recibo']; // número do recibo
$chave = $_POST['chave']; // número da chave de acesso
$xml = (string) $_POST['xml']; // URL do XML
$danfe = (string)$_POST['danfe']; // URL do Danfe (PDF)
$data = $_POST['data'];
$log = $_POST['log'];

/**
 * Informações que podem ser coletadas pelo retorno Data,
 * sendo as mesmas informações que foram enviadas no
 * momento da emissão da nota fiscal.
 *
 * Mais informações consulte a documentação da API.
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
