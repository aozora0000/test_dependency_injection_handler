<?php
namespace Apps\Services;
use Apps\Models\Blog;
use Apps\Models\Post;

class PostService
{
    public function __construct(Blog $blog, Post $post)
    {
        $this->blog = $blog;
        $this->post = $post;
    }

    public function all()
    {
        return [
            "name"     => $this->blog->name,
            "posts"    => $this->post->getAll(),
        ];
    }
}
