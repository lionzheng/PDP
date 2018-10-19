<?php
/**
 * Created by PhpStorm.
 * User: zhengliru
 * Date: 2018/10/19
 * Time: 11:56
 */

class A
{
    const C_O_S_T = 'C_VAL';
    public $pubV = 1;
    public $proV = 2;
    public $priV = 3;

    public function func1($callFunc = '')
    {
        if (is_callable($callFunc)) {
            $callFunc($this);
        }
    }

    protected function func2()
    {
    }

    private function func3()
    {
    }
}

class B
{
    public function __construct()
    {
        echo __CLASS__ . ' - : - ';
        var_dump(get_called_class());//调用的函数，这里输出 Reflect而不是B
        echo __CLASS__ . ' - : - ';
    }
}

class Reflect extends B
{
    function __construct()
    {
        parent::__construct();
        $a = new ReflectionClass('A');
        echo "ReflectionClass \n";
        var_dump(
            $a,
            $a->getName(),
//            $a->getConstants(),
//            $a->getDefaultProperties(),
//            $a->getMethods(),
            get_called_class()
        // todo 通过反射获取各种属性 ....
        );
        $aClass = new A();
        echo "func1 callback \n";
        $aClass->func1(function ($e) {
            var_dump($e);
            echo __CLASS__ . __FUNCTION__ . "\n";
            echo "----------------- call end \n";
        });
    }

}

new Reflect();