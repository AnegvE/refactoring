<?php

namespace Refactoring;

class Db
{
    private $name;
    private $user;
    private $pass;

    public function __construct($name, $user, $pass)
    {
        $this->name = $name;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function read()
    {
        return file_get_contents($this->name);
    }

    public function write($content)
    {
        return file_put_contents(__DIR__.'/../../'.$this->name, $content, FILE_APPEND);
    }
}
