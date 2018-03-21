<?php

namespace Refactoring\Classes;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7 as Guzzle;
use Refactoring\Interfaces\AppInterface;
use Refactoring\Interfaces\StorageInterface;

/**
 * Class App
 *
 * @property array $config
 * @property StorageInterface $storage
 */
class App implements AppInterface
{
    public $config;
    public $storage;

    public function __construct(array $config, StorageInterface $storage)
    {
        $this->config = $config;
        $this->storage = $storage;
    }

    public function run() : bool
    {
        $result_send = $this->actionSendEmail(3);

        $result_write = $this->actionWriteToDb();

        return $result_send && $result_write;
    }

    public function actionSendEmail($value) : bool
    {
        return (new Sender())->send($value);
    }

    public function actionWriteToDb() : bool
    {
        $content = $this->getSiteContent($this->config['http']['url']);
        $this->storage->set($content);

        return true;
    }

    protected function getSiteContent(string $uri_string) : string
    {
        $client = new GuzzleClient();
        $uri = new Guzzle\Uri($uri_string);

        $response = $client->get($uri);

        return $response->getBody()->getContents();
    }
}
