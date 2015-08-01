<?php
namespace Apps;
use ReflectionClass;

class Handler {
    public static function InjectionHandler($class, $method = "__construct") {
        $class = new ReflectionClass($class);
        // 指定されたメソッドが無い場合、インスタンスを返す。
        if(!$class->hasMethod($method)) {
            return $class->newInstance();
        }
        $params = $class->getMethod($method)->getParameters();

        // 引数がある場合は、タイプヒンティングを引数に自身を呼び出し返す。
        if(!empty($params)) {
            $params = array_map(function($param) {
                if($param->getClass() instanceof ReflectionClass) {
                    return Handler::InjectionHandler($param->getClass()->name);
                }
            }, $params);
            // コンストラクタの場合にはインスタンスに引き渡し実行、それ以外の場合にはインスタンス起動後メソッドに引き渡し返す。
            if($method === "__construct") {
                return $class->newInstanceArgs($params);
            } else {
                return call_user_func_array(array($class->newInstance(), $method), $params);
            }
        }
        // 引数がない場合は、指定されたインスタンスを起動・メソッドを返す。
        else {
            // コンストラクタの場合にはインスタンスを返す。
            if($method === "__construct") {
                return $class->newInstance();
            }
            // メソッド指定の場合にはコンストラクタを起動後、メソッドを返す。
            else {

                return call_user_func(array($class->newInstance(), $method));
            }
        }
    }
}
