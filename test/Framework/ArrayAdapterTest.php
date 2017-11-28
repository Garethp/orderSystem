<?php

namespace OrderSystem\Test\Framework;

use OrderSystem\Framework\Persistence\Adapters\ArrayAdapter;
use PHPUnit\Framework\TestCase;

class ArrayAdapterTest extends TestCase
{
    public function testGet()
    {
        $adapter = new ArrayAdapter(['test' => 'testValue']);

        self::assertSame('testValue', $adapter->get('test'));
    }

    public function testGetAll()
    {
        $adapter = new ArrayAdapter(['test', 'secondTest']);

        self::assertSame(['test', 'secondTest'], $adapter->getAll());
    }

    public function testSet()
    {
        $adapter = new ArrayAdapter();

        $adapter->set('test', 'testValue');
        self::assertSame('testValue', $adapter->get('test'));

        $adapter->set('test', 'newTestValue');
        self::assertSame('newTestValue', $adapter->get('test'));
    }

    public function testHas()
    {
        $adapter = new ArrayAdapter();

        self::assertFalse($adapter->has('test'));

        $adapter->set('test', true);
        self::assertTrue($adapter->has('test'));
    }

    public function testDelete()
    {
        $adapter = new ArrayAdapter(['test' => 'test']);

        $adapter->delete('test');
        self::assertFalse($adapter->has('test'));
    }
}