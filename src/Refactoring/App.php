<?php

namespace Refactoring;

/**
 * Class App
 *
 * @property array $config
 * @property Db $db
 */
class App
{
    public $config;
    public $db;

    public function __construct($config)
    {
        $this->config = $config;
        $this->db = new Db($config['db']['baza'], $config['db']['login'], $config['db']['pass']);
    }

    public function run()
    {
        $result_send = $this->actionSendEmail(3);

        $result_write = $this->actionWriteToDb();

        return $result_send & $result_write;
    }

    public function actionSendEmail($value)
    {
        return (new Sender())->send($value);
    }

    public function actionWriteToDb()
    {
        // send http response fto remote destination
        $CH = curl_init($this->config['http']['url']);
        curl_setopt($CH, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($CH);
        curl_close($CH);

        //store in pseudo db
        $this->db->write($content);

        return true;
    }
}
