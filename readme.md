#Sistema de Agenda em Laravel

###Requisitos
	- PHP >= 7.2.5
	- composer
	- MySql

###Startando o projeto
	No MySql
	```CREATE USER laravel```
	```CREATE DATABASE agenda```

	No projeto
	```cp .env.example .env```
	
	Alterar variáveis conforme a configuração desejada

	Gerar chave
	```php artisan key:generate```

	Executar migrations
	```php artisan migrate```

	Popular base de dados
	```php artisan db:seed```

	```composer dumpautoload```

	```php artisan serve```