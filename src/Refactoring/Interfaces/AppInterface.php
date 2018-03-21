<?php

namespace Refactoring\Interfaces;

interface AppInterface
{
    /**
     * AppInterface constructor.
     *
     * @param array $config <array with settings for app>
     * @param StorageInterface $db
     */
    public function __construct(array $config, StorageInterface $db);

    /**
     * Main method
     *
     * @return bool
     */
    public function run() : bool;
}
