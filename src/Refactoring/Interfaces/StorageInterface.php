<?php

namespace Refactoring\Interfaces;

interface StorageInterface
{
    /**
     * StorageInterface constructor.
     *
     * @param array $config
     */
    public function __construct(array $config);

    /**
     * @return string
     */
    public function get() : string;

    /**
     * @param string $content
     * @return bool
     */
    public function set(string $content) : bool;

    /**
     * @return bool
     */
    public function clear() : bool;
}
