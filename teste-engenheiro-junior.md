# Teste para vaga de Engenheiro full stack Junior

Nesse teste analisaremos seu conhecimento geral, velocidade de desenvolvimento e capacidade de melhoria.

## Descrição

Aplicação desenvolvida como parte do teste prático para a vaga em questão. Sendo uma aplicação de cadastro de pedidos de compras, composta por uma Api desenvolvida com Laravel e o FrontEnd por NuxtJs.

Principais recursos:

* Api
* Autenticação com o Sanctum
* Repository Pattern
* CRUD de clientes
* CRUD de produtos
* CRUD de pedidos

## Instruções

Tenha o Php 8.2, Docker, Docker-compose instalados e rodando na máquina.

Acesse a pasta <strong>backend</strong> end e rode os comandos

```sh

$ cp .env.example .env

$ sail up -d

$ sail composer install

$ sail artisan key:generate

```

Projeto rodando e banco conectado, agora rode as migrations e as seeders

```sh
$ sail artisan migrate

$ sail artisan db:seed

```

Tudo pronto, a api já está rodando
Agora suba só rodar o frontend

```sh

$ cd ../frontend

$ npm install

$ npm run dev

```
