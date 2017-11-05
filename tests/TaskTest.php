<?php
/**
 * Created by PhpStorm.
 * User: chico_percedes
 * Date: 2017-11-04
 * Time: 8:21 PM
 *
 * Add a TaskTest class to verify that your task Task accepts property
 * values that meet the form validation rules, and rejects ones that don't.
 */

require __DIR__ . '/Bootstrap.php';
require_once '../application/Task.php';

class TaskTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider priorityProvider
     */
    public function testPriority($mName, $vPass)
    {
        $taskTest = new Task();
        $methodName = $mName;
        $valueToPass = $vPass;
        $result = $taskTest->__set($methodName, $valueToPass);
        $this->assertEquals('Success', $result);
    }

    public function priorityProvider(){
        return [
            ['Priority', 0],
            ['Priority', 3],
            ['Priority', 7],
            ['Priority', 2]

        ];
    }

    /**
     * @dataProvider toDoProvider
     */
    public function testToDoName($mName, $vPass)
    {
        $taskTest = new Task();
        $methodName = $mName;
        $valueToPass = $vPass;
        $result = $taskTest->__set($methodName, $valueToPass);
        $this->assertEquals('Success', $result);
    }

    public function toDoProvider(){
        return [
            ['ToDoName', 'asdf@'],
            ['ToDoName', 'Mario H'],
            ['ToDoName', 'SSSSSSSSSSSSSSS'],
            ['ToDoName', '@#$123'],
            ['ToDoName', 'Love is Love']

        ];
    }

    /**
     * @dataProvider sizeProvider
     */
    public function testSize($mName, $vPass)
    {
        $taskTest = new Task();
        $methodName = $mName;
        $valueToPass = $vPass;
        $result = $taskTest->__set($methodName, $valueToPass);
        $this->assertEquals('Success', $result);
    }

    public function sizeProvider(){
        return [
            ['Size', 0],
            ['Size', 3],
            ['Size', 7],
            ['Size', 2]
        ];
    }

    /**
     * @dataProvider groupProvider
     */
    public function testGroup($mName, $vPass)
    {
        $taskTest = new Task();
        $methodName = $mName;
        $valueToPass = $vPass;
        $result = $taskTest->__set($methodName, $valueToPass);
        $this->assertEquals('Success', $result);
    }

    public function groupProvider(){
        return [
            ['Group', 0],
            ['Group', 3],
            ['Group', 5],
            ['Group', 2],
            ['Group', 8]
        ];
    }
}