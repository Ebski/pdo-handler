<?php

namespace Ebski\PdoHandler\Interfaces;

/**
 * Class IUpdatable
 *
 * @package PdoHandler\Interfaces
 */
interface IUpdatable
{
    /**
     * Get values for a database update
     *
     * @return array
     */
    public function getUpdateValues(): array;
}