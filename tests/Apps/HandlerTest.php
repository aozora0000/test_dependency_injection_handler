<?php
class HandlerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function handler1()
    {
        $item = \Apps\Handler::InjectionHandler(\Apps\Controllers\IndexController::class, "indexAction");

        $this->assertEquals(['name' => 'TestBlog', 'posts' => [
            ["id" => 2, "title" => "Hello World!", "body" => "My Second Post!"],
            ["id" => 1, "title" => "Hello World!", "body" => "My First Post!"],
        ]], $item);
    }
    /**
     * @test
     */
    public function handler2()
    {
        $blogname = \Apps\Handler::InjectionHandler(\Apps\Controllers\IndexController::class, "getAction");
        $this->assertEquals("TestBlog", $blogname);
    }
}
