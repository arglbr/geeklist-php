# DEPRECATED

![no-maintenance-intended](https://img.shields.io/maintenance/no/2012?style=plastic)

# Geeklist-PHP

## English

> Deprecated, obsolete & archived.
> 
> Geeklist is out of service until the launch of 2.0 version, what makes this repo useless :-).

### Overview

Geeklist-PHP is a lib to get stuff of a given user at Geeklist, without an API key. If you have an API key, consider using the geekli.st-php (https://github.com/dominikgehl/geekli.st-php) from Dominik Gehl.

### Using it

Without Composer:
```php
<?php
require __DIR__ . '/Geeklist/SPLClassLoader.php';
$classLoader = new \Geeklist\SPLClassLoader('Geeklist', __DIR__);
$classLoader->register();
$card_handler = new \Geeklist\Card('arglbr', \Geeklist\OUTPUT_ARRAY);

```
With PHP Composer (http://getComposer.org):
First of all, append the lines below to your `composer.json` of your project:
```json
   require {
       'arglbr/geeklist-php': 'dev-master';
   }
```

After, instantiate with the Composer autoloader:
```php
<?php
$loader = require 'vendor/autoload.php';
$loader->add('Geeklist', '/path/to/geeklist-php');
$card_handler = new \Geeklist\Card('arglbr', \Geeklist\OUTPUT_ARRAY);

```

This lib is shipped with a file called example1.php who is straightforward. Given a valid username, there are two useful methods:
* `\Geeklist\Card\getAllCards()` => Returns all cards of the given user;
* `\Geeklist\Card\getRandomCard()` => Returns a random cards from all cards of the given username.

### Tests

Generate the build with the following command:
* `phpunit --testdox tests/`.

### Documentation

Generate the documentation as desired:
* `phpdoc -o HTML:Smarty:PHP -dn Geeklist -d Geeklist/ -t doc/`;
* `phpdoc -o HTML:Smarty:PEAR -dn Geeklist -ti 'Documentation for geeklist-php' -d Geeklist/ -t doc/`;
* `phpdoc -o PDF:default:default -dn Geeklist -ti 'Documentation for geeklist-php' -d Geeklist/ -t doc/`.


## Brazilian portuguese

> Depreciado, obsoleto e arquivado.
> 
> A rede Geeklist saiu do ar até o lançamento da versão 2.0, o que torna este repo inútil :-).

### Visão geral

Geeklist-PHP é uma biblioteca que lida com o conteúdo dos cards de um determinado usuário na rede Geeklist, sem a necessidade de uma API. Se você tem acesso a API, considere usar o repositório oferecido pelo Dominik Gehl (https://github.com/dominikgehl/geekli.st-php).

### Usando-a

Sem Composer:
```php
<?php
require __DIR__ . '/Geeklist/SPLClassLoader.php';
$classLoader = new \Geeklist\SPLClassLoader('Geeklist', __DIR__);
$classLoader->register();
$card_handler = new \Geeklist\Card('arglbr', \Geeklist\OUTPUT_ARRAY);

```
Com PHP Composer (http://getComposer.org):
Primeiro, adicione ao arquivo `composer.json` do seu projeto:
```json
   require {
       'arglbr/geeklist-php': 'dev-master';
   }
```

Depois, instancie o handler com o autoloader do Composer:
```php
<?php
$loader = require 'vendor/autoload.php';
$loader->add('Geeklist', '/path/to/geeklist-php');
$card_handler = new \Geeklist\Card('arglbr', \Geeklist\OUTPUT_ARRAY);

```

Junto com a lib há um arquivo chamado example1.php que é bem direto. Dado um usuário válido, existem dois métodos úteis:
* `\Geeklist\Card\getAllCards()` => Retornará todos os cards encontrados deste usuário;
* `\Geeklist\Card\getRandomCard()` => Retornará um cartão de forma aleatória.

### Testes

Gere a build com o seguinte comando:
* `phpunit --testdox tests/`.

### Documentação

Gere a documentação como desejado:
* `phpdoc -o HTML:Smarty:PHP -dn Geeklist -d Geeklist/ -t doc/`;
* `phpdoc -o HTML:Smarty:PEAR -dn Geeklist -ti 'Documentation for geeklist-php' -d Geeklist/ -t doc/`;
* `phpdoc -o PDF:default:default -dn Geeklist -ti 'Documentation for geeklist-php' -d Geeklist/ -t doc/`.

