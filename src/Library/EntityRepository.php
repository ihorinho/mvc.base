<?php

namespace Library;

/**
 * Class EntityRepository
 * @package Library
 */
abstract class EntityRepository
{
    /**
     * @var
     */
    protected $pdo;

    /**
     * @param \PDO $pdo
     * @return $this
     */
    public function setPDO(\PDO $pdo)
    {
        $this->pdo = $pdo;
        return $this;
    }
}