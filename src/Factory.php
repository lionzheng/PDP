<?php
/**
 * 工厂模式
 * Created by PhpStorm.
 * User: zhengliru
 * Date: 2018/11/1
 * Time: 11:28
 * 应用实例： 1、您需要一辆汽车，可以直接从工厂里面提货，而不用去管这辆汽车是怎么做出来的，以及这个汽车里面的具体实现。
 *           2、Hibernate 换数据库只需换方言和驱动就可以。
 * 优点：   1、一个调用者想创建一个对象，只要知道其名称就可以了。
 *         2、扩展性高，如果想增加一个产品，只要扩展一个工厂类就可以。
 *         3、屏蔽产品的具体实现，调用者只关心产品的接口。
 * 缺点：每次增加一个产品时，都需要增加一个具体类和对象实现工厂，使得系统中类的个数成倍增加，在一定程度上增加了系统的复杂度，同时也增加了系统具体类的依赖。这并不是什么好事。
 *
 */

//step 1 : 创建一个接口
interface Shape
{
    function draw();
}

//step 2 创建实现接口的实体类
class Rectangle implements Shape
{
    public function draw()
    {
        printf("Inside  " . __CLASS__ . "::" . __FUNCTION__ . " () method. \n");
    }
}

class Circle implements Shape
{
    public function draw()
    {
        printf("Inside  " . __CLASS__ . "::" . __FUNCTION__ . " () method. \n");
    }
}

//step 3 创建一个工厂，生成基于给定信息的实体类的对象
class ShapeFactory
{
    public function getShape(string $shapeType): Shape
    {
        if (strlen($shapeType) == 0) {
            return null;
        }
        if ($shapeType == 'Circle') {
            return new Circle();
        } elseif ($shapeType == 'Rectangle') {
            return new Rectangle();
        }
        return null;
    }
}

//step 4 使用该工厂，通过传递类型信息来获取实体类的对象
function main()
{
    $shapeFactory = new ShapeFactory();
    //获取circle的对象，并调用他的draw方法
    $shape1 = $shapeFactory->getShape('Circle');
    $shape1->draw();
    //获取rectangle的对象，并调用他的draw方法
    $shape2 = $shapeFactory->getShape('Rectangle');
    $shape2->draw();
}

main();