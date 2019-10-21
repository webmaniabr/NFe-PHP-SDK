<p align="center">
  <img src="https://wmbr.s3.amazonaws.com/img/logo_webmaniabr_github.png">
</p>

# NF-e PHP SDK

Através do emissor de Nota Fiscal da WebmaniaBR®, você conta com a emissão e arquivamento das suas notas fiscais, cálculo automático de impostos, geração do Danfe para impressão e envio automático de e-mails para os clientes. Realize a integração com o seu sistema utilizando a nossa REST API.

- Emissor de Nota Fiscal WebmaniaBR®: [Saiba mais](https://webmaniabr.com/nota-fiscal-eletronica/)
- Documentação REST API: [Visualizar](https://webmaniabr.com/docs/rest-api-nfe/)

## Requisitos

- Contrate um dos planos de Nota Fiscal Eletrônica da WebmaniaBR® a partir de R$29,90/mês: [Assine agora mesmo](https://webmaniabr.com/nota-fiscal-eletronica/).
- [Composer](https://getcomposer.org/)
- Realize a integração com o seu sistema.

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

OU

```php
require_once __DIR__ . '/src/WebmaniaBR/NFe.php';
```

Caso esteja usando algum framework, como por exemplo o Laravel, instale o módulo da WebmaniaBR® via composer e o importe para seu controller da seguinte maneira:

```php
use WebmaniaBR\NFe;
```

Informe as credenciais de acesso da sua aplicação no método construtor da classe NFe:

```php
$this->webmaniabr = new NFe('SEU_CONSUMER_KEY', 'SEU_CONSUMER_SECRET', 'SEU_ACCESS_TOKEN', 'SEU_ACCESS_TOKEN_SECRET');
```

E pronto, sua plataforma já está pronta para se comunicar com a API da WebmaniaBR®.
Para emitir uma NF-e por exemplo, deve ser utilizado o método ``` emissaoNotaFiscal( $data ) ```:

```php
$resp = $this->webmaniabr->emissaoNotaFiscal( $data );

if($resp->error) {

   echo 'Ocorreu um erro: ' . $resp->error;

}else{

    echo $response->uuid; // Número único de identificação da Nota Fiscal
    echo $response->status; // aprovado, reprovado, cancelado, processamento ou contingencia
    echo $response->nfe; // Número da NF-e
    echo $response->serie; // Número de série
    echo $response->recibo; // Número do recibo
    echo $response->chave; // Número da chave de acesso
    echo $response->xml; // URL do XML
    echo $response->danfe; // URL do Danfe (PDF)
    echo $response->log; // Log do Sefaz

}
```

Onde ``` $data ``` é um array com os dados da Nota Fiscal, para maiores informações quais dados devem ser enviados, consulte a [documentação](https://webmaniabr.com/docs/rest-api-nfe/#emitir-nfe).

Verifique todos os exemplos de utilização no diretório /exemplos/. Segue abaixo uma listagem dos métodos existentes em nosso módulo e os devidos parâmetros que devem ser informados:

```php
ajusteNotaFiscal( $array ); // Emite uma nota fiscal de ajuste.
```
```php
cancelarNotaFiscal( $chave, $motivo ); // Cancelar Nota Fiscal enviada ao SEFAZ.
```
```php
cartaCorrecao(  $chave, $correcao  ); // Corrigir uma Nota Fiscal junto ao SEFAZ.
```
```php
complementarNotaFiscal( $array ); // Emite uma Nota Fiscal complementar.
```
```php
consultaNotaFiscal( $chave ); // Consulta o status da Nota Fiscal enviada para o SEFAZ.
```
```php
devolucaoNotaFiscal( $chave, $natureza_operacao, $ambiente, $codigo_cfop, $classe_imposto, $produtos ); // Emissão de Nota Fiscal de devolução junto ao SEFAZ.
```
```php
emissaoNotaFiscal( $array ); // Emissão da Nota Fiscal junto ao SEFAZ, com exemplos para a emissão com detalhamento específicos.
```
```php
inutilizarNumeracao( $sequencia, $motivo, $ambiente ); // Inutilizar sequência de numeração junto ao SEFAZ.
```
```php
statusSefaz(); // Verifica se o SEFAZ está Online ou Offline.
```
```php
validadeCertificado(); // Verifica se o Certificado A1 é válido e quantos dias faltam para expirar.
```

## Suporte

Qualquer dúvida entre em contato na nossa [Central de Ajuda](https://ajuda.webmaniabr.com) ou acesse o [Painel de Controle](https://webmaniabr.com/painel/) para conversar em tempo real no Chat ou Abrir um chamado.
