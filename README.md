# NF-e PHP SDK

Através do emissor de Nota Fiscal da WebmaniaBR®, você conta com a emissão e arquivamento das suas notas fiscais, cálculo automático de impostos, geração do Danfe para impressão e envio automático de e-mails para os clientes. Realize a integração com o seu sistema utilizando a nossa REST API.

- Emissor de NF-e da WebmaniaBR®: [Saiba mais](https://webmaniabr.com/smartsales/nota-fiscal-eletronica/)
- Documentação da REST API: [Visualizar](https://webmaniabr.com/docs/rest-api-nfe/)

## Requisitos

- Contrate um dos planos de Nota Fiscal Eletrônica da WebmaniaBR® a partir de R$29,90/mês: [Assine agora mesmo](https://webmaniabr.com/smartsales/nota-fiscal-eletronica/).
- Realize a integração com o seu sistema.

## Utilização

Execute o Composer:

```php
composer require webmaniabr/nfe
```

Adicione o arquivo autoload.php no topo do seu arquivo, caso não possua o Composer adicione o arquivo NFe.php diretamente:

```php
require_once __DIR__ . '/vendor/autoload.php';
use WebmaniaBR\NFe;
```
OU

```php
require_once __DIR__ . '/src/WebmaniaBR/NFe.php';
```

Antes de executar as funções defina as credenciais de acesso da sua aplicação no arquivo /src/WebmaniaBR/settings.php:

```php
$settings = array(
    'access_token' => '',
    'access_token_secret' => '',
    'consumer_key' => '',
    'consumer_secret' => '',
);
```

Verifique todos os exemplos de utilização no diretório /exemplos/. Segue abaixo a listagem das funções:

- **ajusteNotaFiscal**: Emite uma nota fiscal de ajuste.
- **cancelarNotaFiscal**: Cancelar Nota Fiscal enviada ao SEFAZ.
- **cartaCorrecao**: Corrigir uma Nota Fiscal junto ao SEFAZ.
- **complementarNotaFiscal**: Emite uma Nota Fiscal complementar.
- **consultaNotaFiscal**: Consulta o status da Nota Fiscal enviada para o SEFAZ.
- **devolucaoNotaFiscal**: Emissão de Nota Fiscal de devolução junto ao SEFAZ.
- **emissaoNotaFiscal**: Emissão da Nota Fiscal junto ao SEFAZ, com exemplos para a emissão com detalhamento específicos.
- **inutilizarNumeracao**: Inutilizar sequência de numeração junto ao SEFAZ.
- **retornoNotaFiscal**: Exemplo de retorno da API após a emissão de Nota Fiscal.
- **statusSefaz**: Verifica se o Sefaz está Online ou Offline.
- **validadeCertificado**: Verifica se o Certificado A1 é válido e quantos dias faltam para expirar.

## Suporte

Qualquer dúvida entre em contato na nossa [Central de Ajuda](https://ajuda.webmaniabr.com) ou acesse o [Painel de Controle](https://webmaniabr.com/painel/) para conversar em tempo real no Chat ou Abrir um chamado.
