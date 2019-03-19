# Blog - Docker

Este projeto baseado em [Docker](https://www.docker.com/) e, por isso, é necessário o ter instalado para execução do ambiente.

Utiliza o projeto:

- Ambientum (https://github.com/codecasts/ambientum)

A pasta `./bin` possui diversos scripts utilitários, para configuração, execução e manipulação do ambiente de desenvolvimento da aplicação.

Para configurar e acessar o projeto, execute:

## Primeira execução

```
./bin/config
```
Faz a cópia dos arquivos de configuração.

```
./bin/run
```
Inicia os containers Docker.

```
./bin/mysql
```
Cria o banco de dados.

## Demais execuções

```
./bin/run
```
Inicia os containers Docker.

```
./bin/composer-install
```
Instala as dependências.

```
./bin/artisan key:generate
```
Cria a chave da aplicação.

```
./bin/artisan migrate:fresh --seed
```
Instala as migrações e seeders.

```
./bin/artisan jwt:secret
```
Gera a chave jwt da aplicação.

A aplicação já pode ser acessada via Postman ou outro serviço de acesso a API Restfull. O endpoint Login gera um hash para acesso aos demais endpoints.

```
Exemplo o endpoint POST {HOST}/api/v1/login

Body
Key => email - Value => jonathan.ribeiro@deeds.com.br
Key => password - Value => 123456

Gerou o hash => HQkk2Ivs40honcrnItN6iXgCgNikIcy8
```

Para acessar o demais endpoits é necessário informar o hash acima no cabeçalho.
```
Exemplo o endpoint GET {HOST}/api/v1/produtos
Header => Bearer HQkk2Ivs40honcrnItN6iXgCgNikIcy8
```
