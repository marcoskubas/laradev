
# SERVIÇOS ESSENCIAIS

## Enviando E-mail

```
php artisan make:mail welcomeYakso

php artisan vendor:publish --tag=laravel-mail

php artisan make:controller MailController
```

## Fila e Processamento de Jobs

Cria a migrationa da tabela job

```
php artisan queue:table

php artisan migrate
```

Processa a fila

```
php artisan queue:work
```

Cria um job

```
php artisan make:job welcomeYakso
```

