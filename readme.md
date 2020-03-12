# Sistema de Agenda em Laravel

## Requisitos

-   Docker >= 18.09

## Startando o projeto

Comece configurando o .env

### `cp .env.example .env`

    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=laraveluser
    DB_PASSWORD=suasenha

Após configurar o .env, na raíz rode

### `docker-compose up -d`

Após instalar os containers, executar os seguintes comandos:

Gerar a chave de aplicação

### `docker-compose exec app php artisan key:generate`

Se prefir cachear as configs

### `docker-compose exec app php artisan config:cache`

Configurando o MySQL

### `docker-compose exec db bash`

Dentro do container db gerar a senha do root

### `mysql -u root -p`

Adaptar as informações conforme o que está no .env

### `GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'your_laravel_db_password';`

Atualize o MySQL

### `FLUSH PRIVILEGES;`

### `EXIT;`

Saia do container com segurança

### `ctrl + p + q`

Migre as tabelas para o MySQL

### `docker-compose exec app php artisan migrate`

Rode o seed para popular as tabelas

### `docker-compose exec app php artisan seed`
