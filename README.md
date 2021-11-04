<p align="center">
  <img src="https://wmbr.s3.amazonaws.com/img/logo_webmaniabr_github.png">
</p>

# NF-e PHP SDK

Através do emissor de Nota Fiscal da WebmaniaBR®, você conta com a emissão e arquivamento das suas notas fiscais, cálculo automático de impostos, geração do Danfe para impressão e envio automático de e-mails para os clientes. Realize a integração com o seu sistema utilizando a nossa REST API.

- Emissor de Nota Fiscal WebmaniaBR®: [Saiba mais](https://webmaniabr.com/nota-fiscal-eletronica/)
- Documentação REST API: [Visualizar](https://webmaniabr.com/docs/rest-api-nfe/)

## Requisitos

- Contrate um dos planos de Nota Fiscal Eletrônica da WebmaniaBR® a partir de R$32,90/mês: [Teste 30 dias grátis!](https://webmaniabr.com/nota-fiscal-eletronica/).
- Instale o [Composer](https://getcomposer.org/)
- Realize a integração com o seu sistema.

## Endpoints

A SDK está disponível para todos os recursos da versão **3.7.0** da API de Nota Fiscal [(changelog)](https://ajuda.webmaniabr.com/hc/pt-br/articles/360013266171).

<p align="center">
  <img src="https://wmbr.s3.amazonaws.com/img/endpoints_nfe_nfce.jpg">
</p>

## Utilização
Instale o módulo da WebmaniaBR® via composer ou baixe nosso repositório e utilize a classe NFe.php que se encontra dentro de src/WebmaniaBR/:

```php
composer require webmaniabr/nfe
```

Após executar o composer, adicione o require no topo do seu arquivo. Caso tenha baixado manualmente, importe o arquivo NFe.php diretamente na sua aplicação:

```php
require_once __DIR__ . '/vendor/autoload.php';
use WebmaniaBR\NFe;
```

Caso esteja usando algum framework, como por exemplo o Laravel, instale o módulo da WebmaniaBR® via composer e referencie o seguinte namespace em seu controller:

```php
use WebmaniaBR\NFe;
```

Dessa forma, a classe NFe já pode ser instanciada e utilizada conforme a sua necessidade!
Informe as suas credenciais de acesso diretamente no método construtor da classe NFe:

```php
$this->webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
```

E pronto, sua plataforma já está pronta para se comunicar com a API da WebmaniaBR®.
Para emitir uma NF-e por exemplo, deve ser utilizado o método ``` emissaoNotaFiscal( $data ) ```:

```php
$response = $this->webmaniabr->emissaoNotaFiscal( $data );

if (!$response->error) {

    echo $response->uuid; // Número único de identificação da Nota Fiscal
    echo $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
    echo $response->nfe; // Número da NF-e
    echo $response->serie; // Número de série
    echo $response->recibo; // Número do recibo
    echo $response->chave; // Número da chave de acesso
    echo $response->xml; // URL do XML
    echo $response->danfe; // URL do Danfe (PDF)
    echo $response->log; // Log do Sefaz

} else {

    echo 'Ocorreu um erro: ' . $resp->error;

}
```

## Suporte

Qualquer dúvida entre em contato na nossa [Central de Ajuda](https://ajuda.webmaniabr.com) ou acesse o [Painel de Controle](https://webmaniabr.com/painel/) para conversar em tempo real no Chat ou Abrir um chamado.
