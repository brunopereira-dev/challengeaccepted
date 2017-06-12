# Challenge S2 IT

Este desafio foi desenvolvido para S2 IT.
Autor: Bruno Pereira

# Brief Description
Your customer receives two XML models from his partner. This information must be available for both web system and mobile app.

# The challenge
Create a Symfony2 application to manually upload the given XMLs and have an option to process them. Make the processed information available via rest APIs.

# Must have
  - Symfony2, doctrine, composer, mysql.
  - An index page to upload the XML with a button to process it.
  - Rest APIs for the XML data, only the GET methods are needed.
  - README.md with the instructions to install the application (docker is a plus here :) )

# Bonus points
  - Drag and drop upload component
  - Authentication method to the APIs
  - Generated documentation for the APIs
  - Unit/Functional tests

# Instalação

Pré requisitos:
- PHP 5.4+ 
- MySQL ,
- Composer

Após baixar o projeto, executar a instalação das dependências.
```sh
$ php composer.phar install 
```
Alterar as configurações do banco de dados em app/config/config.yml

```sh
parameters:
    database_driver: pdo_mysql
    database_host: [host]
    database_port: [port]
    database_name: [database_name]
    database_user: [user]
    database_password: [pass]
```

Executar os comandos de criação do banco de dados e tabelas.
```sh
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force
```

Executar o servidor.
```sh
$ php app/console server:run
```

Ao iniciar o servidor aparecerá a mensagem de sucesso juntamente com a URL para acessar a aplicação. 
No exemplo abaixo temos http://127.0.0.1:8000.
```sh
[OK] Server running on http://127.0.0.1:8000
```
 
 ## API
Para consumir a API, basta utilizar 
- [host]/api/resources/getpersons
- [host]/api/resources/getships
