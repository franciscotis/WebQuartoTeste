# Teste Prático - Web Quarto 

## Aplicação utilizando Laravel e VueJS

## Configurações iniciais
```
    composer install
    npm install
    npm init && npm run-dev
    php artisan key:generate

```
Após isso, com tudo rodando corretamente, é recomendado utilizar o seguinte comando 
para criar um link simbólico para a pasta storage

```
    php artisan storage:link
```

Em seguida, abrir o arquivo .env e informar as configurações do banco de dados:

```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

```

O Banco de Dados utilizado no sistema foi o MYSQL.

O próximo passo agora é rodar as migrations:

```
    php artisan migrate
    
```

## Rodando o projeto

Para rodar o servidor laravel:

```
    php artisan serve
```
O servidor irá rodar na porta :8000.

Para rodar o servidor vuejs:

```
    npm run hot


```

Agora só navegar :grin:	

# Imagens do projeto:

<p align="center">
    <img src="https://ibb.co/Y7dN7Qp"/>
</p>

<p align="center">
    <img src="https://ibb.co/dtRLN6g"/>
</p>

<p align="center">
    <img src="https://ibb.co/QKB3c5w">
</p>

<p align="center">
    <img src="https://ibb.co/q0tmHLL">
</p>








