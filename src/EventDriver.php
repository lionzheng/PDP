<?php
/**
 * 事件驱动模型
 * 简介：观察者模式的另一种形态，观察者相当于监听器，被观察者相当于事件源
 * 目的：事件源产生事件，监听器监听事件
 * 总结：事件发生-事件处理模型
 * 组成：监听器，事件源，事件源管理器
 * User: lionzheng
 * Date: 2018/10/16
 * Time: 15:04
 *
 * 类似观测者设计模式
 * 应用实例： 1、拍卖的时候，拍卖师观察最高标价，然后通知给其他竞价者竞价。
 *           2、西游记里面悟空请求菩萨降服红孩儿，菩萨洒了一地水招来一个老乌龟，这个乌龟就是观察者，他观察菩萨洒水这个动作。
 * 优点： 1、观察者和被观察者是抽象耦合的。
 *        2、建立一套触发机制。
 * 缺点： 1、如果一个被观察者对象有很多的直接和间接的观察者的话，将所有的观察者都通知到会花费很多时间。
 *        2、如果在观察者和观察目标之间有循环依赖的话，观察目标会触发它们之间进行循环调用，可能导致系统崩溃。
 *        3、观察者模式没有相应的机制让观察者知道所观察的目标对象是怎么发生变化的，而仅仅只是知道观察目标发生了变化。
 */

/**
 * 监听器
 * Class EventListener
 */
class EventListener
{
    protected $name = '';

    public function handleEvent($msg)
    {
        echo "{$this->name} 阅读了 : $msg \n";
    }
}

/**
 * 事件源 - 时间载体
 * Class EventObject
 */
class EventSource
{
    protected $eventName;
    protected $eventData;

    public function getEventName()
    {
        return $this->eventName;
    }

    public function getEventData()
    {
        return $this->eventData;
    }

}

/**
 * 事件管理器
 * Class EventManager
 */
class EventManager
{
    private static $eventList = [];

    /**
     * 绑定事件
     */
    function attachListener(EventSource $eventObject, EventListener $listener)
    {
        //一个事件名绑定多个监听器
        self::$eventList[$eventObject->getEventName()][] = $listener;
    }

    /**
     * 解除绑定事件
     */
    public function detach(EventSource $eventObject)
    {
        unset(self::$eventList[$eventObject->getEventName()]);
    }

    /**
     * 触发事件
     */
    public function fire(EventSource $eventObject)
    {
        foreach (self::$eventList as $attachEventName => $listenerList) {
            //匹配监听列表
            if ($eventObject->getEventName() == $attachEventName) {
                foreach ($listenerList as $eventListener) {
                    $eventListener->handleEvent($eventObject->getEventData());
                }
            }
        }
    }
}

/**
 * 写入操作的一个事件监听器
 * Class WriterListener
 */
class WriterListener extends EventListener
{
    public function __construct($name)
    {
        $this->name = $name;
    }
}

/**
 * 一个写的事件
 * Class WriteEvent
 */
class Writer extends EventSource
{
    public function __construct($eventName, $eventData)
    {
        $this->eventName = $eventName;
        $this->eventData = $eventData;
        echo "$eventName 发布了新作 $eventData\n";
        echo "---------------------------------\n";

    }
}

function main()
{
    //初始化管理器
    $eventManager = new EventManager();
    //初始化听众
    $listener1 = new WriterListener('lion');
    $listener2 = new WriterListener('2哈');
    $listener3 = new WriterListener('aiwen');
    $listener4 = new WriterListener('yuan');
    //初始化作者
    $writer1 = new Writer('郭敬明', '小时代');
    $writer2 = new Writer('莫言', '人间正道是沧桑');

    $eventManager->attachListener($writer1, $listener1);
    $eventManager->attachListener($writer2, $listener2);
    $eventManager->attachListener($writer2, $listener3);
    $eventManager->attachListener($writer2, $listener4);

    $eventManager->fire($writer1);
    $eventManager->fire($writer2);

}

main();