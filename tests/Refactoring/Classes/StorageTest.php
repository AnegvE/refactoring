<?php

use PHPUnit\Framework\TestCase;
use Refactoring\Classes\Storage;

class StorageTest extends TestCase
{
    protected static $storage_name = 'storage_test.db';

    public function initializationParamsProvider()
    {
        return [
            [[]],
            [['name' => '', 'user' => 'test', 'pass' => 'test']],
            [['name' => static::$storage_name, 'user' => '', 'pass' => 'test']],
            [['name' => static::$storage_name, 'user' => 'test', 'pass' => '']],
        ];
    }


    /**
     * @dataProvider initializationParamsProvider
     *
     * @param array $conf
     */
    public function testInitializationWithEmptyConfig($conf)
    {
        $this->expectException(\InvalidArgumentException::class);

        new Storage($conf);
    }

    protected function getStorage()
    {
        return new Storage([
            'name' => static::$storage_name,
            'user' => 'test',
            'pass' => 'test',
        ]);
    }

    public function testClear()
    {
        $storage = $this->getStorage();

        self::assertEquals(true, $storage->clear());

        self::assertEquals('', $storage->get());
    }

    public function testSetAndGet()
    {
        $storage = $this->getStorage();

        $storage->clear();

        $test_content = 'text';

        self::assertEquals(true, $storage->set($test_content));

        self::assertEquals($test_content, $storage->get());
    }

    public static function tearDownAfterClass()
    {
        $storage_path = DIR_APP . DS . static::$storage_name;

        if (file_exists($storage_path)) {
            unlink($storage_path);
        }
    }
}
