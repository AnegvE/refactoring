<?php

/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/3/17
 * Time: 11:00 AM
 */
class App
{

    const configPath = __DIR__ . '/config.ini';

    public $db;

    public function __construct()
    {
        $config = parse_ini_file(self::configPath, true);
        $this->db = new BAZA($config['db']['baza'], $config['db']['login'], $config['db']['pass']);
    }

    public function doIt($value)
    {
        //read data from global application config
        $config = parse_ini_file(self::configPath, true);

        // send http response fto remote destination
        $CH = curl_init($config['http']['url']);
        curl_setopt($CH, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($CH);
        curl_close($CH);

        //store in pseudo db
        $this->db->write($content);
        // notify if
        if ($value >= 3 && $value < 6) {
            $this->sendEmail('test@gmail.com', 'admin@provectus.com', 'Your Value is too low');
        } elseif ($value > 6) {
            if ($value == 7) {
                $this->sendEmail('test@gmail.com', 'admin@provectus.com', 'Your Value equals to 7');
            }
        }
        return true;
    }

    private function sendEmail($to, $from, $body)
    {
        printf("Email has been send to %s From %s.\r\n\r\n Notify you about %s", $to, $from, $body);
    }
}

class BAZA
{
    public $db;
    public $user;
    public $pass;

    public function __construct($db, $user, $pass)
    {
        $this->db = $db;
        $this->user = $user;
    }

    public function read()
    {
        return file_get_contents($this->db);
    }

    public function write($content)
    {
        return file_put_contents($this->db, $content, FILE_APPEND);
    }
}

$app = new App();
$app->doIt(3);