<?php
namespace Apps\Models;
class Post
{
    public function getAll()
    {
        return [
            ["id" => 2, "title" => "Hello World!", "body" => "My Second Post!"],
            ["id" => 1, "title" => "Hello World!", "body" => "My First Post!"],
        ];
    }
}
