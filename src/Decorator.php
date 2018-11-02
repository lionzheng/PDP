<?php
/**
 * 装饰者模式
 * Created by PhpStorm.
 * User: zhengliru
 * Date: 2018/11/1
 * Time: 16:20
 *
 * 应用实例：
 *  1、孙悟空有 72 变，当他变成"庙宇"后，他的根本还是一只猴子，但是他又有了庙宇的功能。
 *  2、不论一幅画有没有画框都可以挂在墙上，但是通常都是有画框的，并且实际上是画框被挂在墙上。在挂在墙上之前，画可以被蒙上玻璃，装到框子里；这时画、玻璃和画框形成了一个物体。
 * 优点：装饰类和被装饰类可以独立发展，不会相互耦合，装饰模式是继承的一个替代模式，装饰模式可以动态扩展一个实现类的功能。
 * 缺点：多层装饰比较复杂。
 */

//step 1 : 创建一个接口
interface Shape
{
    function draw();
}

//step 2 : 创建实现接口的实体类
class Rectangle implements Shape
{
    public function draw()
    {
        printf("Shape :Rectangle\n");
    }
}

class Circle implements Shape
{
    public function draw()
    {
        printf("Shape :Circle\n");
    }
}

//step 3 ：创建实现了Shape接口的抽象装饰类
abstract class ShapeDecorator implements Shape
{
    protected $decoratedShape;

    public function __construct(Shape $decoratedShape)
    {
        $this->decoratedShape = $decoratedShape;
    }

    //类似递归
    public function draw()
    {
        $this->decoratedShape->draw();
    }
}

//step 4 创建拓展ShapeDecorator类的实体装饰类
class RedShapeDecortor extends ShapeDecorator
{
    function __construct(Shape $decoratedShape)
    {
        $this->decoratedShape = $decoratedShape;
    }

    public function draw()
    {
        parent::draw();
//        throw new Exception("Exception End ： Border Color: Red\n");
        printf("Border Color: Red\n");
    }

}

class GreenShapeDecortor extends ShapeDecorator
{
    function __construct(Shape $decoratedShape)
    {
        $this->decoratedShape = $decoratedShape;
    }

    public function draw()
    {
        parent::draw();
        throw new Exception("Exception End ： Border Color: Green\n");
        printf("Border Color: Green\n");
    }

}
class BlueShapeDecortor extends ShapeDecorator
{
    function __construct(Shape $decoratedShape)
    {
        $this->decoratedShape = $decoratedShape;
    }

    public function draw()
    {
        parent::draw();
        printf("Border Color: Blue\n");
    }

}

function main()
{
    //画圈圈
//    $circle = new Circle();
//
//    //画圈圈初始化，搭配颜色装饰画红色，接着再装饰一个绿色。
//    $shapeDecortor = new RedShapeDecortor($circle);
//    $shapeDecortor = new GreenShapeDecortor($shapeDecortor);
//    $shapeDecortor->draw();

    //优点，类内部可使用异常中断。
    //画矩形
    $rectangle = new Rectangle();
    //画矩初始化，搭配颜色装饰画红色，接着再装饰一个绿色。
    $shapeDecortor = new RedShapeDecortor($rectangle);
    $shapeDecortor = new GreenShapeDecortor($shapeDecortor);
    $shapeDecortor = new BlueShapeDecortor($shapeDecortor);
    try {
        $shapeDecortor->draw();
    } catch (Exception $e) {
        printf($e->getMessage() . "\n");
    }
    //todo 拓展：可再配合工厂模式，生产装饰器。
}

main();