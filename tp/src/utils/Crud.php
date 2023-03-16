<?php

namespace utils;

use \PDO;

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

    /**
     * the methods construct is execute when the class is create
     */
    public function __construct()
    {
        // i assign the value of the class with the function get_called_class()
        $this->className = get_called_class();
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
     * $pdo PDO object use to get the data in the database
     * $id int id of the object
     * $option string value of the column to get
     * @return T| bool
     */
    public function get(PDO $pdo, int $id, string $option = "*"): mixed
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $query = $pdo->prepare('SELECT '. $option .' FROM ' . strtolower($this->getShortName()) . ' WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchObject($this->className);
    }

    /**
     * $pdo PDO object use to get the data in the database
     * $startID int id of the first object
     * $limit int number of object to get
     * $option string value of the column to get
     * @return array| bool
     */
    public function getAll(PDO $pdo, int $startID = 1, int $limit = 15,string $option = "*"): array | bool
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $query = $pdo->prepare('SELECT '. $option .' FROM ' . strtolower($this->getShortName()) . ' WHERE id >= :startId LIMIT :limitValue;');
        $query->bindParam(':startId', $startID);
        $query->bindParam(':limitValue', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function insert(PDO $pdo, array $value): bool
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $sqlRequest = 'INSERT INTO ' . strtolower($this->getShortName()) . ' (`firstname`, `lastname`, `profilePicture`,`address`,`phoneNumber`,`trigram`) VALUES (:firstname, :lastname, :profilePicture,:address,:phoneNumber,:trigram)';
        $query = $pdo->prepare($sqlRequest);
        return $query->execute($value);
    }
    public function delete(PDO $pdo, int $id): bool
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $query = $pdo->prepare('DELETE FROM ' . strtolower($this->getShortName()) . ' WHERE id = :id');
        $query->bindParam(':id', $id);
        return $query->execute();
    }

    /**
     * this private method allow to count the total count of specific value in database
     * @param PDO $pdo PDO object use to count in the database
     * @return int number of user register in the database
     */
    private function count(PDO $pdo): int
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;

        $query = $pdo->prepare('SELECT COUNT(*) FROM ' . strtolower($this->getShortName()));
        $query->execute();
        return $query->fetch()[0];
    }

    /**
     * this function is use to get the total of page avaiable
     * @param PDO $pdo PDO object use to query the count
     * @param int $limit limit of element display per page
     * @return int number of page
     */
    public function getPagination(PDO $pdo, int $limit): int
    {
        if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args())) return false;
        $count = $this->count($pdo);
        return intVal(ceil($count / $limit));
    }
}