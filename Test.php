<?php
/**
 * Class Test
 */
class Test
{
    public static $staticVal = '233';

    public function __construct()
    {

        $this->say();
    }

    public function say()
    {
        echo "\n " . static::$staticVal . " \n";
    }
}

class B extends Test
{
    public function __construct()
    {
        echo __CLASS__ . " : ";
        self::$staticVal = '455';
        parent::__construct();

    }
}

class C extends Test
{
    public function __construct()
    {
        echo __CLASS__ . " : ";
        self::$staticVal = '799';
        parent::__construct();
    }
}

new B();
new C();
new B();
