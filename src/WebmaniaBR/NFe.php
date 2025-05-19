<?php

namespace WebmaniaBR;
use StdClass;

class NFe {

    private $consumerKey        = "";
    private $consumerSecret     = "";
    private $accessToken        = "";
    private $accessTokenSecret  = "";

    function __construct( $consumer_key, $consumer_secret, $access_token, $acccess_token_secret ){

        $this->consumerKey = $consumer_key;
        $this->consumerSecret = $consumer_secret;
        $this->accessToken = $access_token;
        $this->accessTokenSecret = $acccess_token_secret;

    }

    function statusSefaz( $data = null ){

        $data = array();
        $response = $this->connectWebmaniaBR( 'GET', 'https://webmaniabr.com/api/1/nfe/sefaz/', $data );
        if (isset($response->error)) return $response;
        if ($response->status == 'online') return true;
        else return false;

    }

    function validadeCertificado( $data = null ){

        $data = array();
        $response = $this->connectWebmaniaBR( 'GET', 'https://webmaniabr.com/api/1/nfe/certificado/', $data );
        if (isset($response->error)) return $response;
        return $response->expiration;

    }

    function emissaoNotaFiscal( array $data ){

        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/emissao/', $data );
        return $response;

    }

    function consultaNotaFiscal( $chave_uuid ){

        $data = $this->validate_key_uuid( $chave_uuid );

        if (is_object($data) && $data->error){
            return $data->error;
        } 

        $response = $this->connectWebmaniaBR( 'GET', 'https://webmaniabr.com/api/1/nfe/consulta/', $data );
        return $response;

    }

    function cancelarNotaFiscal( $chave_uuid, $motivo ){

        $data = $this->validate_key_uuid( $chave_uuid );

        if (is_object($data) && $data->error){
            return $data->error;
        } 

        $data = array(
            key($data) => $data[key($data)],
            'motivo' => $motivo
        );

        $response = $this->connectWebmaniaBR( 'PUT', 'https://webmaniabr.com/api/1/nfe/cancelar/', $data );
        return $response;

    }

    function inutilizarNumeracao( $sequencia, $motivo, $ambiente, $serie = '', $modelo = '' ){

        $data = array(
            'sequencia' => $sequencia,
            'motivo' => $motivo,
            'ambiente' => $ambiente,
            'serie' => $serie,
            'modelo' => $modelo
        );

        $response = $this->connectWebmaniaBR( 'PUT', 'https://webmaniabr.com/api/1/nfe/inutilizar/', $data );
        return $response;

    }

    function cartaCorrecao( $chave_uuid, $correcao, $ambiente = '', $evento = '', $url_notificacao = '' ){

        $data = $this->validate_key_uuid( $chave_uuid );

        if (is_object($data) && $data->error){
            return $data->error;
        } 

        $data = array(
            key($data) => $data[key($data)],
            'correcao' => $correcao,
            'ambiente' => $ambiente,
            'evento' => $evento,
            'url_notificacao' => $url_notificacao
        );
        
        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/cartacorrecao/', $data );
        return $response;

    }

    function devolucaoNotaFiscal( $chave_uuid, $natureza_operacao, $ambiente, $codigo_cfop = '', $classe_imposto = '', $produtos = array(), $quantidade = array(), $volume = '', $informacoes_fisco = '', $informacoes_complementares = '', $url_notificacao = '' ){

        $data = $this->validate_key_uuid( $chave_uuid );

        if (is_object($data) && $data->error){
            return $data->error;
        } 

        $data = array(
            key($data) => $data[key($data)],
            'natureza_operacao' => $natureza_operacao,
            'ambiente' => $ambiente,
            'codigo_cfop' => $codigo_cfop,
            'classe_imposto' => $classe_imposto,
            'produtos' => $produtos,
            'quantidade'=> $quantidade,
            'volume' => $volume,
            'informacoes_fisco' => $informacoes_fisco,
            'informacoes_complementares' => $informacoes_complementares,
            'url_notificacao' => $url_notificacao
        );

        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/devolucao/', $data );
        return $response;

    }

    function ajusteNotaFiscal( $data ){

        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/ajuste/', $data );
        return $response;

    }

    function complementarNotaFiscal( $data ) {

        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/complementar/', $data);
        return $response;

    }

    function atualizarEmpresa( $data ) {

        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/empresa/', $data);
        return $response;

    }

    function exportarRelatorios( $data ) {

        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/relatorios/', $data);
        return $response;

    }

    function manifestacaoDestinatario( $chave, $ambiente, $evento, $justificativa = '' ) {

        $data = array(
            'chave' => $chave,
            'ambiente' => $ambiente,
            'evento' => $evento,
            'justificativa' => $justificativa
        );

        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/manifesta/', $data);
        return $response;

    }

    function classeImposto( $data = array(), $method = 'POST' ) {

        $response = $this->connectWebmaniaBR( $method, 'https://webmaniabr.com/api/1/nfe/classe-imposto/', $data);
        return $response;

    }

    function validate_key_uuid( $key_uuid ){

        $data = [];

        if (strlen(preg_replace("/[^0-9]/", '', $key_uuid)) == 44){
            $data['chave'] = preg_replace("/[^0-9]/", '', $key_uuid);
        } else if (strlen(trim($key_uuid)) == 36) {
            $data['uuid'] = trim($key_uuid);
        } else {
            $response = new StdClass;
            $response->error = 'Informado Chave ou UUID inválido.';
        }

        if ($data){
            return $data;
        } else {
            return $response;
        }

    }

    function connectWebmaniaBR( $request, $endpoint, $data ){

        // Verify cURL
        if (!function_exists('curl_version')){

          $curl_error = new StdClass;
          $curl_error->error = 'cURL não localizado! Não é possível obter conexão na API da WebmaniaBR®. Verifique junto ao programador e a sua hospedagem. (PHP: '.phpversion().')';

          return $curl_error;

        }

        // Set limits
        @set_time_limit( 300 );
        ini_set('max_execution_time', 300);
        ini_set('max_input_time', 300);
        ini_set('memory_limit', '256M');
        if (
            strpos($endpoint, '/sefaz/') !== false ||
            strpos($endpoint, '/certificado/') !== false
        ){
            $timeout = 5;
        } else {
            $timeout = 300;
        }

        // Header
        $headers = array(
          'Cache-Control: no-cache',
          'Content-Type:application/json',
          'X-Consumer-Key: '.$this->consumerKey,
          'X-Consumer-Secret: '.$this->consumerSecret,
          'X-Access-Token: '.$this->accessToken,
          'X-Access-Token-Secret: '.$this->accessTokenSecret
        );

        // Init connection
        $rest = curl_init();
        curl_setopt($rest, CURLOPT_CONNECTTIMEOUT , $timeout);
        curl_setopt($rest, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($rest, CURLOPT_URL, $endpoint);
        curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($rest, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($rest, CURLOPT_CUSTOMREQUEST, $request);
        curl_setopt($rest, CURLOPT_POSTFIELDS, json_encode( $data ));
        curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($rest, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($rest, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($rest, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($rest, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_NONE);
        curl_setopt($rest, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT);

        // Connect to API
        $response = curl_exec($rest);
        $http_status = curl_getinfo($rest, CURLINFO_HTTP_CODE);
        $curl_errno = (int) curl_errno($rest);
        if ($curl_errno){
            $curl_strerror = curl_strerror($curl_errno);
        }
        curl_close($rest);

        // Get cURL errors
        $curl_error = new StdClass;

        if ($curl_errno){

          // Get User IP
          $ip = $_SERVER['CF-Connecting-IP']; // CloudFlare

          if (!$ip){
            $ip = $_SERVER['REMOTE_ADDR']; // Standard
          }
          if (is_array($ip)){
            $ip = $ip[0];
          }

          // cURL errors
          if (!$http_status){
            $curl_error->error = 'Não foi possível obter conexão na API da WebmaniaBR®, possível relação com bloqueio no Firewall ou versão antiga do PHP. Verifique junto ao programador e a sua hospedagem a comunicação na URL: https://webmaniabr.com/api/. (cURL: '.$curl_strerror.' | PHP: '.phpversion().' | cURL: '.curl_version()['version'].')';
          } elseif ($http_status == 500) {
            $curl_error->error = 'Ocorreu um erro ao processar a sua requisição. A nossa equipe já foi notificada, em caso de dúvidas entre em contato com o suporte da WebmaniaBR®. (cURL: '.$curl_strerror.' | HTTP Code: '.$http_status.' | IP: '.$ip.')';
          } elseif (!in_array($http_status, array(401, 403))) {
            $curl_error->error = 'Não foi possível se conectar na API da WebmaniaBR®. Em caso de dúvidas entre em contato com o suporte da WebmaniaBR®. (cURL: '.$curl_strerror.' | HTTP Code: '.$http_status.' | IP: '.$ip.')';
          }
        }

        // Return
        if ( isset($curl_error->error) ) {
            return $curl_error;
        } else {
            return json_decode($response);
        }

    }

}

?>
