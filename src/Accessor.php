<?php

namespace Ebski\PdoHandler;

use PDO;

/**
 * Class Accessor
 *
 * @package PdoHandler
 */
abstract class Accessor
{
    /**
     * @param PDO $connection
     * @param PDOUtils $pdoUtils
     */
    public function __construct(
        protected PDO $connection,
        protected PDOUtils $pdoUtils
    ) {}

    public function beginTransaction(): void
    {
        $this->connection->beginTransaction();
    }

    public function commitTransaction(): void
    {
        $this->connection->commit();
    }

}