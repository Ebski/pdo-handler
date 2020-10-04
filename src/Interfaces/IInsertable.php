<?php

namespace Ebski\PdoHandler\Interfaces;

/**
 * Class IInsertable
 *
 * @package PdoHandler\Interfaces
 */
interface IInsertable
{
    /**
     * Get values for a database insert
     *
     * @return array
     */
    public function getInsertValues(): array;
}