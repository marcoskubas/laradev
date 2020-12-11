

# Versionamento de Banco de Dados

utf8mb4 - Para armazenamento de emojis, caso contrário dá para usar somente utf8 normalmente

## Criando Migration

```
php artisan make:migration create_posts --create=posts
php artisan make:migration add_column_posts_title --table=ṕosts
php artisan make:model Posts -m
```

## Modelagen tabela completa

```
php artisan migrate

```

Solução Para UTF8MB4

Em AppServiceProvider 

use Illuminate\Support\Facades\Schema;

```
public function boot(){
    Schema::defaultStringLength(191);
}
```

```
php artisan make:migration add_column_posts_slug --table=posts
```

## Relacionamentos

Cria Controller e Migration juntamente com a Model

```
php artisan make:model Categories -rm
php artisan make:migration constraint_posts_categories --table=posts
```

$table->foreign('category')->references('id')->on('categories')->onDelete('RESTRICT');

## Usuário Administrador

```
php artisan make:migration insert_user_admin
```

## Controle de Migrações

Forcing Migration Production

```
php artisan migrate --force
php artisan migrate:rollback --step=1
php artisan migrate:refresh --step=1
php artisan migrate:fresh (Drop all tables)
```

## Criando Seeder

```
php artisan make:seeder UsersTableSeeder
php artisan db:seed
php artisan db:seed --class=UsersTableSeeder
```

```
php artisan migrate:refresh --seed
```

