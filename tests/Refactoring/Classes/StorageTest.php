<?php

use PHPUnit\Framework\TestCase;
use Refactoring\Classes\Storage;

class StorageTest extends TestCase
{
    protected $storage_name = 'storage_test.db';

    public function testInitializationWithEmptyConfig()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Storage([]);
    }
    public function testInitializationWithEmptyName()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Storage([
            'name' => '',
            'user' => 'test',
            'pass' => 'test',
        ]);
    }

    public function testInitializationWithEmptyUser()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Storage([
            'name' => $this->storage_name,
            'user' => '',
            'pass' => 'test',
        ]);
    }

    public function testInitializationWithEmptyPass()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Storage([
            'name' => $this->storage_name,
            'user' => 'test',
            'pass' => '',
        ]);
    }

    public function testClear()
    {
        $storage = new Storage([
            'name' => $this->storage_name,
            'user' => 'test',
            'pass' => 'test',
        ]);

        self::assertEquals(true, $storage->clear());

        self::assertEquals('', $storage->get());
    }

    public function testSetAndGet()
    {
        $storage = new Storage([
            'name' => $this->storage_name,
            'user' => 'test',
            'pass' => 'test',
        ]);

        $storage->clear();

        $test_content = 'text';

        self::assertEquals(true, $storage->set($test_content));

        self::assertEquals($test_content, $storage->get());
    }
}
