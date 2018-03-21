<?php

namespace Refactoring\Classes;

use Refactoring\Interfaces\StorageInterface;

class Storage implements StorageInterface
{
    private $name;
    private $user;
    private $pass;

    public function __construct(array $config)
    {
        $this->name = $config['name'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
    }

    public function get() : string
    {
        return file_get_contents($this->name);
    }

    public function set(string $content) : bool
    {
        $result = file_put_contents(DIR_APP . '/' . $this->name, $content, FILE_APPEND);

        return (false === $result);
    }
}
