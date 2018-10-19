<?php
/**
 * php 反射类的使用
 * Created by PhpStorm.
 * User: zhengliru
 * Date: 2018/10/19
 * Time: 11:56
 */

class A{
    const C_O_S_T = 'C_VAL';
    public $pubV = 1;
    public $proV = 2;
    public $priV = 3;
    public function func1(){}
    protected function func2(){}
    private function func3(){}
}

class Reflect
{
    function __construct()
    {
        $a = new ReflectionClass('A');
        var_dump(
            $a,
            $a->getName(),
            $a->getConstants(),
            $a->getDefaultProperties(),
            $a->getMethods()
            // todo 通过反射获取各种属性 ....
            );
    }

}

new Reflect();