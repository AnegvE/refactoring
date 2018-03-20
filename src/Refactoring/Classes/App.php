<?php

namespace Refactoring\Classes;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7 as Guzzle;
use Refactoring\Interfaces\AppInterface;

/**
 * Class App
 *
 * @property array $config
 * @property Db $db
 */
class App implements AppInterface
{
    public $config;
    public $db;

    /**
     * App constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->db = new Db($config['db']['baza'], $config['db']['login'], $config['db']['pass']);
    }

    /**
     * @return bool
     */
    public function run()
    {
        $result_send = $this->actionSendEmail(3);

        $result_write = $this->actionWriteToDb();

        return $result_send && $result_write;
    }

    /**
     * @param int $value
     * @return bool
     */
    public function actionSendEmail($value)
    {
        return (new Sender())->send($value);
    }

    /**
     * @return bool
     */
    public function actionWriteToDb()
    {
        $content = $this->getSiteContent($this->config['http']['url']);
        $this->db->write($content);

        return true;
    }


    /**
     * @param string $uri_string
     * @return string
     */
    protected function getSiteContent($uri_string)
    {
        $client = new GuzzleClient();
        $uri = new Guzzle\Uri($uri_string);

        $response = $client->get($uri);

        return $response->getBody()->getContents();
    }
}
