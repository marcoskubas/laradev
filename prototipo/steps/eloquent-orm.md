
# ELOQUENT ORM

## Relacionamento Através De

```
->hasManyThrough()
```

## Relacionamento de N para N

```
$table = 'posts';

public function categories(){
    return $this->belongsToMany(Category::class, 'post_category', 'post', 'category');
}
```

## Gestão de Tabela Pivô

Adiciona uma categoria ao post

```
$post-categories()->attach([3]);
```

Remove uma categoria do post

```
$post-categories()->detach([3]);
```

Sincroniza categorias de um post

```
$post-categories()->sync([5, 10]);
```

Sincroniza categorias de um post sem remover os existentes

```
$post-categories()->syncWithoutDetaching([5, 6, 7]);
```

## Relacionamento Polimórfico

```php
class Comment extends Model{

    protected $fillable = ['content'];

    public function item(){
        return $this->morphTo();
    }

}

class Post extends Model{

    public function comments(){
        return $this->morphMany(Comment::class, 'item');
    }

}

class User extends Model{

    public function comments(){
        return $this->morphMany(Comment::class, 'item');
    }

}

class PostController{

    public function show($id){
        $post = Post::find($id);
        $post->comments()->create(['content' => 'Teste de comentário']);
        $comments = $post->comments()->get();
        if($comments){
            foreach($comments as $comment){
                echo "Comentário: #{$comment->id} {$comment->content}<br>";
            }
        }
    }
}

class UserController{

    public function show($id){
        $user = User::find($id);
        $user->comments()->create(['content' => 'Teste de comentário User']);
        $comments = $user->comments()->get();
        if($comments){
            foreach($comments as $comment){
                echo "Comentário: #{$comment->id} {$comment->content}<br>";
            }
        }
    }
}

```

```
Table comments

| id | content                  | item_type      | item_id |
------------------------------------------------------------
| 1  | Teste de comentário      | App\Post       | 1       |
| 2  | Teste de comentário User | App\User       | 2       |

2 registros

```

## Definindo Escopos

```php
class User extends Model{

    public function scopeStudents($query){
        return $query->where('level', '<=', 5);
    }

    public function scopeAdmins($query){
        return $query->where('level', '>', 5);
    }
}

class UserController{

    public function index(){
        $students = User::students()->get();
        $admins   = User::admins()->get();
    }

}
```

## Acessor e Mutator

```php
class Post extends Model{
    public function getCreatedAtAttribute(){
        return date('d/m/Y H:i', strtotime($this->createad_at));
    }
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug']  = str_slug($value);
    }
}

class PostController{

    public function show($id){
        $post = Post::find($id);
        echo "#{$post->id} Título: {$post->title}<br>";
        echo "Data de criação: {$post->createdAt} <br>";

        $post->title = 'Título de teste do meu artigo!';
        $post->save();

        echo "#{$post->id} Título: {$post->title}<br>";

    }

}
```

## Filtro de Collections

https://laravel.com/docs/5.7/collections

https://laravel.com/docs/5.7/eloquent-collections

## Serialização de Modelo

```php
class User {
    protected $hidden = ['password', 'remember_token', 'level'];

    protected $visible = ['name', 'email'];

    protected $appends = ['admin'];

    public function getAdminAttribute(){
        return ($this->attributes['level'] > 5 ? true : false);
    }
}

class UserController{

    public function index(){
        $users = User:all();
        var_dump($users->makeVisible('created_at')->toArray()));
        var_dump($users->makeHidden('created_at')->toJson(JSON_PRETTY_PRINT)));
    }
}
```
