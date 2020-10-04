<?php

namespace Ebski\PdoHandler;

use Ebski\PdoHandler\Interfaces\IInsertable;
use Ebski\PdoHandler\Interfaces\IUpdatable;
use PDOStatement;

/**
 * Class PDOUtils
 *
 * @package PdoHandler
 */
class PDOUtils
{
    /**
     * Create a string of question marks usable in an IN query
     * Array [1, 2] will become string (?,?)
     *
     * @param array $parameters
     * @return string
     */
    public function getInQuery(array $parameters): string
    {
        return sprintf('(%s)', implode(',', array_fill(0, count($parameters), '?')));
    }

    /**
     * @param PDOStatement $stmt
     * @param int $offset
     * @param $value
     * @return int
     */
    public function bindValue(PDOStatement $stmt, int $offset, $value): int
    {
        $stmt->bindValue($offset, $value);
        return ++$offset;
    }

    /**
     * @param PDOStatement $stmt
     * @param int $offset
     * @param array $values
     * @return int
     */
    public function bindValues(PDOStatement $stmt, int $offset, array $values): int
    {
        foreach ($values as $value) {
            $offset = $this->bindValue($stmt, $offset, $value);
        }
        return $offset;
    }

    /**
     * Bind the insert values of an object that implements the IInsertable interface
     *
     * @param PDOStatement $stmt
     * @param int $offset
     * @param IInsertable $insertable
     * @return int
     */
    public function bindIInsertableValue(PDOStatement $stmt, int $offset, IInsertable $insertable): int
    {
        foreach ($insertable->getInsertValues() as $value) {
            $offset = $this->bindValue($stmt, $offset, $value);
        }
        return $offset;
    }


    /**
     * Bind the insert values of an array of objects that implements the IInsertable interface
     *
     * @param PDOStatement $stmt
     * @param int $offset
     * @param array $insertables
     * @return int
     */
    public function bindIInsertableValues(PDOStatement $stmt, int $offset, array $insertables): int
    {
        foreach ($insertables as $insertable) {
            $offset = $this->bindIInsertableValue($stmt, $offset, $insertable);
        }
        return $offset;
    }

    /**
     * Get insert values of an object implementing the IInsertable interface
     *
     * @param IInsertable $insertable
     * @return string
     */
    public function getIInsertableInsertValue(IInsertable $insertable): string
    {
        return $this->getInsertValues(count($insertable->getInsertValues()), 1);
    }

    /**
     * Get insert values of an array of objects implementing the IInsertable interface
     *
     * @param IInsertable[] $insertables
     * @return string
     */
    public function getIInsertableInsertValues(array $insertables): string
    {
        return $this->getInsertValues(count($insertables[0]->getInsertValues()), count($insertables));
    }

    /**
     * Bind the update values of an object that implements the IUpdatable interface
     *
     * @param PDOStatement $stmt
     * @param int $offset
     * @param IUpdatable $updatable
     * @return int
     */
    public function bindIUpdatable(PDOStatement $stmt, int $offset, IUpdatable $updatable): int
    {
        foreach ($updatable->getUpdateValues() as $value) {
            $offset = $this->bindValue($stmt, $offset, $value);
        }
        return $offset;
    }

    /**
     * @param int $numberOfParameters
     * @param int $numberOfRecords
     * @return string
     */
    private function getInsertValues(int $numberOfParameters, int $numberOfRecords): string
    {
        $values = sprintf('(%s)', implode(',', array_fill(0, $numberOfParameters, '?')));
        return implode(',', array_fill(0, $numberOfRecords, $values));
    }

}