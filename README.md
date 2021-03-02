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
    <img src="https://i.ibb.co/kgDGgBQ/2021-03-01-23-31-40-localhost-979d81ba7a41.png"/>
</p>

<p align="center">
    <img src="https://i.ibb.co/1MkdCK6/2021-03-01-23-31-48-localhost-f118f7c35288.png"/>
</p>

<p align="center">
    <img src="https://i.ibb.co/yQTcR3j/2021-03-01-23-31-55-localhost-a88c63a909c4.png">
</p>

<p align="center">
    <img src="https://i.ibb.co/jVc3C99/2021-03-01-23-31-32-localhost-8347c9e37afa.png">
</p>








