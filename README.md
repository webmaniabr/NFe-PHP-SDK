# NF-e PHP SDK

Emissão automática de Nota Fiscal Eletrônica através da REST API de Nota Fiscal Eletrônica da WebmaniaBR®. Emita as suas Notas Fiscais realizando a integração com o seu sistema.

Documentação: https://webmaniabr.com/docs/rest-api-nfe/

## Requisitos

- Escolha um plano que se adeque as necessidades da sua empresa. Para saber mais: https://webmaniabr.com/start/nota-fiscal-eletronica/
- Obtenha as credenciais de acesso da sua aplicação.
- Realize a integração com o seu sistema.

## Utilização

Execute o Composer e adicione o require no topo do seu arquivo:

```php
require_once __DIR__ . '/vendor/autoload.php';
use WebmaniaBR\NFe;
```

Antes de executar as funções, defina as credenciais da sua aplicação:

```php
$settings = array(
    'oauth_access_token' => '',
    'oauth_access_token_secret' => '',
    'consumer_key' => '',
    'consumer_secret' => '',
);
```

Verifique todos os exemplos de utilização no diretório /exemplos/. Segue abaixo a listagem das funções:

- **statusSefaz**: Verifica se o Sefaz está Online ou Offline.
- **validadeCertificado**: Verifica se o Certificado A1 é válido e quantos dias faltam para expirar.
- **emissaoNotaFiscal**: Emissão da Nota Fiscal junto ao SEFAZ.
- **consultaNotaFiscal**: Consulta o status da Nota Fiscal enviada para o SEFAZ.
- **cancelarNotaFiscal**: Cancelar Nota Fiscal enviada ao SEFAZ.
- **inutilizarNumeracao**: Inutilizar sequência de numeração junto ao SEFAZ.

## Suporte

Qualquer dúvida estamos à disposição e abertos para melhorias e sugestões, em breve teremos um fórum para discussões. Qualquer dúvida entre em contato na nossa Central de Atendimento: https://webmaniabr.com/atendimento/.
