<?php

namespace Refactoring\Interfaces;


interface AppInterface
{
    /**
     * AppInterface constructor.
     *
     * @param array $config <array with settings for app>
     */
    public function __construct($config);

    /**
     * Main method
     *
     * @return bool
     */
    public function run();
}
