<?php

namespace Ebski\PdoHandler;

use PDO;

/**
 * Class Connector
 *
 * @package PdoHandler
 */
abstract class Connector
{
    protected static PDO $pdo;

    /**
     * Establishes and returns an active database connection.
     *
     * @param Connection|null $connection
     * @return PDO
     */
    public static function conn(Connection $connection = null): PDO
    {
        if (!$connection) {
            $connection = static::getDefaultConnection();
        }

        if (!isset(static::$pdo)) {
            $dbHost = $connection->getHost();
            $dbPort = $connection->getPort();
            $dbSchema = $connection->getSchema();
            $dbUser = $connection->getUser();
            $dbPass = $connection->getPass();
            $dbCharset = $connection->getCharset();
            $dbString = "mysql:host=$dbHost;port=$dbPort;dbname=$dbSchema;charset=$dbCharset";
            $dbOptions = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            static::$pdo = new PDO($dbString, $dbUser, $dbPass, $dbOptions);
        }
        return static::$pdo;
    }

    /**
     * @return Connection
     */
    abstract protected static function getDefaultConnection(): Connection;
}