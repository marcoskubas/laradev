
# QUERY BUILDER

## Construtor de Query

```php

 DB::table('users')->latest()->get();
 DB::table('users')->oldest()->get();

```

## Consulta Bruta Raw

```php

 DB::table('users')
    ->selectRaw('users.id, users.name, CASE WHEN users.status = 1 THEN "ATIVO" ELSE "INATIVO" END status_description')
    ->whereRaw('(SELECT COUNT(1) FROM address a WHERE a.user = users.id) > 2')
    ->orderByRaw('update_at - created_at ', 'ASC')
    ->get();

DB::raw("SELECT id, name FROM users");

```

## Compreendendo o Chunk

```php 

DB::table('users')->where('id', '<', 500)->orderBy('id', 'ASC')->chunk(100, function($users){
    foreach($users as $user){
        echo "#{$user->id} {$user->name} <br>";
    }

    echo "Encerrou um ciclo <br>";
});

```

## Clausula Where com ParseString

```php 

$usesr = DB::table('users')
    ->whereIn('users.status', [0,1])
    ->whereNotIn('users.status', [0,1])
    ->whereNull('users.name')
    ->whereNotNull('users.name')
    ->whereColumn('users.created_at', '=', 'users.update_at')
    ->whereDate('users.update_at', '>', '2020-12-01')
    ->whereDay('users.update_at', '=', '01')
    ->whereMonth('users.update_at', '=', '12')
    ->whereYear('users.update_at', '=', '2020')
    ->whereTime('users.update_at', '>', '17:00')
    ->get();

foreach($users as $user){
    echo "#{$user->id} {$user->name} <br>";
}


```

