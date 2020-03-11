# Sistema de Agenda em Laravel

### Requisitos
- PHP >= 7.2.5
- composer
- MySQL

### Startando o projeto
No MySQL
```bash
CREATE USER laravel
CREATE DATABASE agenda
```

No projeto
```bash
composer install
```bash
```cp .env.example .env
```

Alterar variáveis conforme a configuração desejada

Gerar chave
```bash
php artisan key:generate
```

Executar migrations
```bash
php artisan migrate
```

Popular base de dados
```bash
php artisan db:seed
```
```bash
composer dumpautoload
```
```bash
php artisan serve
```
