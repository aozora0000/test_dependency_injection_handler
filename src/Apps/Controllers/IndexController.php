<?php
namespace Apps\Controllers;
use Apps\Services\PostService;
use Apps\Models\Blog;

class IndexController {
    public function indexAction(PostService $service)
    {
        return $service->all();
    }

    public function getAction(Blog $blog)
    {
        return $blog->name;
    }
}
