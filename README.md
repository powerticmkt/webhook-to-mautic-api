# webhook-to-mautic-api

Captura informações de uma requisição GET e envia para o Mautic

**Para facilitar o deploy a pasta vendor está inclusa.**

# Configuração

Altere o arquivo `credentials.php` e insira uma chave de segurança além do endereço, usuário e senha do seu mautic:

```php
// Coloque aqui a sua chave de segurança (invente uma chave e utilize quando acionar os scripts)
$secure = "25dgdg437257ddg28672dg357686";

// a url do seu mautic
$mauticUrl    = 'https://mkt.seumautic.com';

// login do Basic Authentication (crie um usuário ou utilize um existente)
$credentials  = array(
  'userName'   => 'nome do usuario',
  'password'   => 'senha do usuario'
);
```

# Testes

Você pode testar os scripts no seu computador utilizando o servidor web que é
embutido no php:

```bash
 php -S localhost:9000 random-owner.php
```

# Endpoints


Configure este script em um subdomínio ou dentro de uma pasta no mautic:

https://mkt.seumautic.com.br/suapasta

**Importante: Não coloque este script na pasta raíz do Mautic!!!**


## add-dnc.php

Adiciona um lead em "Não entre em contato"

Utilize este desse modo:

`https://mkt.seumautic.com.br/suapasta/add-dnc.php?email=luiz@powertic.com&key=25dgdg437257ddg28672dg357686`


## remove-dnc.php

Remove um lead do "Não entre em contato"

Utilize este desse modo:

`https://mkt.seumautic.com.br/suapasta/remove-dnc.php?email=luiz@powertic.com&key=25dgdg437257ddg28672dg357686`


## clear-points.php

Zera os pontos de um contato

Utilize este desse modo:

`https://mkt.seumautic.com.br/suapasta/clear-points.php?email=luiz@powertic.com&key=25dgdg437257ddg28672dg357686`



## add-points.php

Adiciona uma quantidade de pontos aos pontos exitentes de um contato

Utilize este desse modo:

`https://mkt.seumautic.com.br/suapasta/add-points.php?email=luiz@powertic.com&points=10&key=25dgdg437257ddg28672dg357686`



## remove-points.php

Subtrai uma quantidade de pontos aos pontos exitentes de um contato

Utilize este desse modo:

`https://mkt.seumautic.com.br/suapasta/add-points.php?email=luiz@powertic.com&points=10&key=25dgdg437257ddg28672dg357686`



## random-owner.php

Atribui um proprietário aleatório para um lead caso não possua nenhum.

Utilize este desse modo:

`https://mkt.seumautic.com.br/suapasta/random-owner.php?email=luiz@powertic.com&key=25dgdg437257ddg28672dg357686`
