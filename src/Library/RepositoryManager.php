<?php

namespace Library;

/**
 * Class RepositoryManager
 * @package Library
 */
class RepositoryManager{

    /**
     * @var array
     */
    private $repositories = [];
    /**
     * @var
     */
    private $pdo;

    /**
     * @param \PDO $pdo
     * @return $this
     */
    public function setPDO(\PDO $pdo)
    {
        $this->pdo = $pdo;
        return $this;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function getRepository($entity)
    {
        if (empty($this->repositories[$entity])) {
            $repository = "\\Model\\Repository\\{$entity}Repository";

            $repository = new $repository();
            $repository->setPDO($this->pdo);
            $this->repositories[$entity] = $repository;
        }

        return $this->repositories[$entity];
    }
}