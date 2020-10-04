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
    protected PDO $connection;

    protected PDOUtils $pdoUtils;

    /**
     * @param PDO $connection
     * @param PDOUtils $pdoUtils
     */
    public function __construct(PDO $connection, PDOUtils $pdoUtils = null)
    {
        $this->connection = $connection;
        $this->pdoUtils = $pdoUtils ?? new PDOUtils();
    }

    public function beginTransaction(): void
    {
        $this->connection->beginTransaction();
    }

    public function commitTransaction(): void
    {
        $this->connection->commit();
    }

}