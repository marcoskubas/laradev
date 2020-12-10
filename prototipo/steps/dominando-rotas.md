# Preparando Ambiente

## Configurando Projeto
 
 ```
 php artisan app:name LaraDev
 ```
 
## Alteração Idioma ## 
 
 https://github.com/UpInside/laravel-pt-BR
 
## Definindo Rota ##
 
```
  php artisan make:controller PropertyController
```

# Primeiro Contato

```
var_dump($request);
```

* Uso de Slugfy ou UUID para URLs amigáveis e mais seguras;

Forms:
```
<?php method_field('PUT') ?>
```


```
php artisan make:model Property
```

**Verbos de Atualização**:

PUT - Alterações de todo o Objeto
PATCH - Alteração de parte do Objeto

```
Route::match(['get','post'])
```

**Verbos de Deleção e Options**:

OPTIONS - Permite ver nos Headers o que é permitido (Testar no Postman)

**Rotas Resource**:

```
php artisan make:controller PostController --resource
Route::resource('posts');
Route::resource('posts')->only(['index','show']);
Route::resource('posts')->except(['destroy']);

Route::apiResource('users');
php artisan make:controller API\\UserController --api

Route::resourceVerbs([
    'create' => 'cadastro',
    'edit'   => 'editar'
])

```


**Tipos de Chamada**:

```
Route::view('form', 'form');

Route::fallback(function(){

});

Route::redirect('/users/add', url('/form'), 301);

Route::get('/posts', 'PostController@index')->name('posts.index');
Route::redirect('/posts/index', 'PostController@indexRedirect')->name('posts.indexRedirect');

public function indexRedirect(){
    return redirect()->rote('posts.index');
}
```


**Tratamento de Parâmetros**

```
# Parâmetros Obrigatórios
Route::get('/user/{id}/comments/{comment}', function($id, $comment){
    var_dump($id, $comment);
});

# Parâmetros Opcionais e Validação Campo
Route::get('/user/{id}/comments/{comment?}', function($id, $comment = null){
    var_dump($id, $comment);
})->where('id', '[0-9]+');

# Parâmetros Opcionais e Validação Campo
Route::get('/user/{id}/comments/{comment?}', function($id, $comment = null){
    var_dump($id, $comment);
})->where(['id' => '[0-9]+', 'comment' => '[0-9]+']);
```

**Inspecionamento**

```
Route:get('/users/1', 'UserController@inspect')->name('inspect');

public function inspect(){
    $route = Route::current();
    $name = Route::currentRouteName();
    $action = Route::currentRouteAction();

    var_dump($route, $name, $action);
}
```

**Agrupamento**

```
Route::prefix('admin')->group(function(){
    Route::view('form', 'form');
});

Route::name('admin.posts.')->group(function(){
    Route::get('/admin/posts/index', 'PostController@index')->name('index');
    Route::get('/admin/posts/{id}', 'PostController@show')->name('show');
});

# 10 requests by minute
Route::middleware(['throttle:10,1'])->group(function(){
    Route::view('form', 'form');
});

Route::namespace('Admin')->group(function(){
    Route::get('/users', 'UserController@index')->name('index');
});

php artisan make:controller Admin\\UserController --resource

# Complete

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'throttle:10,1', 'as' => 'admin.'], function(){

    Route::resource('users', 'UserController');

});

```

**Route Caching**

Não pode ter rotas Closure (Sem Controllers)

```
php artisan route:cache
php artisan route:clear
```

