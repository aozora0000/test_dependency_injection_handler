# test_dependency_injection_handler
このファイル群はテスト用です。

LaravelのDIコンテナの様に、引数のタイプヒンティングを利用して自動で引数にインスタンスを与えるというハンドラーを実装しています。

- １段目はメソッドを指定し引数を処理して起動
- ２段目からはコンストラクタを指定し引数を処理、自身に投げる

という仕様になっています。

現在一段目に対して通常の引数は取れない状態になっています。

尚、二段目以降はメソッドに対して引数は取れる状態になっています。

詳細は```src/Apps/Handler.php```を参照してください。

##### 例(コントローラーからモデルを呼び出し)
```php
use \Apps\Controllers\IndexController;
Apps\Handler::InjectionHandler(IndexController::class, "getIndex");

# IndexController.php
use \Apps\Model\Post;
class IndexController {
    public function getIndex(Post $post)
    {
        return $post::all();
    }
}
```

##### 例(コントローラーからサービスを呼び出し、サービス内でモデルを利用する)
```php
use \Apps\Controllers\IndexController;
Apps\Handler::InjectionHandler(IndexController::class, "getIndex");

# IndexController.php
use \Apps\Services\PostSerivice;
class IndexController
{
    pubilc function getIndex(PostService $service)
    {
        try {
            return json_encode($service->get());
        } catch(\Exception $e) {
            return abort(404, $e->getMessage());
        }
    }
}

# PostService.php
use \Apps\Models\Post;
class PostSerivice
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function get()
    {
        $posts = $model::all();
        if($post) {
            return iterator_to_array($posts);
        }
        throw new \Exception("Post Not Found!");
    }
}
```
