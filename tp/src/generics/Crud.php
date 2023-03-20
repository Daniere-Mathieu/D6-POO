<?php

namespace generics;

use \PDO;
use utils\{Verification, Database};

/**
 * this class is a generic class for basic database interaction like the CRUD and get the pagination
 * thid class take origin from the abstract class AbstractCrud
 * @template T
 */
class Crud
{
    /**
     * name of the class with the namespace of the class like models\User
     */
    protected string $className;

    protected PDO $pdo;

    /**
     * the methods construct is execute when the class is create
     */
    public function __construct()
    {
        // i assign the value of the class with the function get_called_class()
        $this->className = get_called_class();
        $this->pdo = Database::getPDO();
    }

    /**
     * this private methods allow to get the name of the class without the namespace
     */
    private function getShortName()
    {
        // the ReflectionClass is a class that return data about the current class
        // this class have a function that return the name of the class without namespace
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * $id int id of the object
     * $option string value of the column to get
     * @return T| bool
     */
    public function get(int $id, string $option = "*"): mixed
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $query = $this->pdo->prepare('SELECT ' . $option . ' FROM ' . strtolower($this->getShortName()) . ' WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchObject($this->className);
    }

    /**
     * $startID int id of the first object
     * $limit int number of object to get
     * $option string value of the column to get
     * @return array| bool
     */
    public function getAll(int $startID = 1, int $limit = 15, string $option = "*"): array | bool
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $query = $this->pdo->prepare('SELECT ' . $option . ' FROM ' . strtolower($this->getShortName()) . ' WHERE id >= :startId LIMIT :limitValue;');
        $query->bindParam(':startId', $startID);
        $query->bindParam(':limitValue', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function insert(array $data, array $keys = []): bool
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) || !Verification::arrayKeysExistAndNotEmpty($keys, $data)) return false;
        $param = '';


        $valueParam = '';
        foreach ($keys as $key) {
            if ($param != '') {
                $param .= ',';
            }
            $param .= '`' . $key . '`';

            // value param compute
            if ($valueParam != '') {
                $valueParam .= ', ';
            }
            $valueParam .= ':' . $key;
        };
        $sqlRequest = 'INSERT INTO ' . strtolower($this->getShortName()) . ' (' . $param . ') VALUES (' . $valueParam . ')';
        $query = $this->pdo->prepare($sqlRequest);
        return $query->execute($data);
    }

    public function update(int $id, array $data, array $keys): bool
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) || !Verification::arrayKeysExistAndNotEmpty($keys, $data)) return false;
        $setClause = '';
        foreach ($keys as $key) {
            if ($setClause != '') {
                $setClause .= ', ';
            }
            $setClause .= $key . ' = :' . $key;
        }
        $query = $this->pdo->prepare('UPDATE ' . strtolower($this->getShortName()) . ' SET ' . $setClause . ' WHERE id = :id');
        $query->bindParam(':id', $id);

        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $query->bindParam(':' . $key, $data[$key]);
            }
        }
        return $query->execute();
    }

    public function delete(int $id): bool
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $query = $this->pdo->prepare('DELETE FROM ' . strtolower($this->getShortName()) . ' WHERE id = :id');
        $query->bindParam(':id', $id);
        return $query->execute();
    }

    /**
     * this private method allow to count the total count of specific value in database
     * @param PDO $pdo PDO object use to count in the database
     * @return int number of user register in the database
     */
    private function count(): int
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;

        $query = $this->pdo->prepare('SELECT COUNT(*) FROM ' . strtolower($this->getShortName()));
        $query->execute();
        return $query->fetch()[0];
    }

    /**
     * this function is use to get the total of page avaiable
     * @param PDO $pdo PDO object use to query the count
     * @param int $limit limit of element display per page
     * @return int number of page
     */
    public function getPagination(int $limit): int
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $count = $this->count();
        return intVal(ceil($count / $limit));
    }

    public function getByEmail(string $email, string $option = '*'): mixed
    {
        $query = $this->pdo->prepare('SELECT ' . $option . ' FROM ' . strtolower($this->getShortName()) . ' WHERE email = :email');
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetchObject($this->className);
    }

    /**
     * @return bool true if value doesn't exist in database and false for the rest
     */
    public function notExistByValue(string $key, string $value): bool
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $query = $this->pdo->prepare('SELECT * FROM ' . strtolower($this->getShortName()) . ' WHERE ' . $key . ' = :value');
        $query->bindParam(':value', $email);
        $query->execute();
        if ($query->rowCount() > 0) {
            return false;
        }
        return true;
    }
}
