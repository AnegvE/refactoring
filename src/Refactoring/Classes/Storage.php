<?php

namespace Refactoring\Classes;

use Refactoring\Interfaces\StorageInterface;

class Storage implements StorageInterface
{
    /** @var string $name */
    protected $name;

    /** @var string $user */
    protected $user;

    /** @var string $pass */
    protected $pass;

    public function __construct(array $config)
    {
        if (empty($config['name'])
            || empty($config['user'])
            || empty($config['pass'])
        ) {
            throw new \InvalidArgumentException('Wrong config for Storage!');
        }

        $this->name = $config['name'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
    }

    public function get() : string
    {
        return file_get_contents($this->getFilePath());
    }

    public function set(string $content) : bool
    {
        $result = file_put_contents($this->getFilePath(), $content, FILE_APPEND);

        return (false !== $result);
    }

    public function clear(): bool
    {
        $result = file_put_contents($this->getFilePath(), '');

        return (false !== $result);
    }

    protected function getFilePath() : string
    {
        return DIR_APP . '/' . $this->name;
    }
}
