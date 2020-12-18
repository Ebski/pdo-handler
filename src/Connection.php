<?php

namespace Ebski\PdoHandler;

/**
 * Class Connection
 *
 * @package PdoHandler
 */
class Connection
{
    /**
     * @param string $host
     * @param string $port
     * @param string $schema
     * @param string $user
     * @param string $pass
     * @param string $charset
     */
    public function __construct(
        private string $host,
        private string $port,
        private string $schema,
        private string $user,
        private string $pass,
        private string $charset
    ) {}

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getSchema(): string
    {
        return $this->schema;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }
}