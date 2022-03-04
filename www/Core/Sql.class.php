<?php

namespace App\Core;

abstract class Sql
{
    private static $pdoInstance;
    private $table;


    public function __construct()
    {
        //Se connecter à la bdd avec singleton
        try {
            self::$pdoInstance = new \PDO(
                DBDRIVER . ":host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME,
                DBUSER,
                DBPWD,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]
            );
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }

        //Si l'id n'est pas null alors on fait un update sinon on fait un insert
        $calledClassExploded = explode("\\", get_called_class());
        $this->table = strtolower(DBPREFIXE . end($calledClassExploded));
    }

    public static function getInstance()
    {
        if (!(self::$pdoInstance instanceof self)) {
            self::$pdoInstance = new self();
        }
        return self::$pdoInstance;
    }

    /**
     * @param int $id
     */
    public function setId(?int $id): object
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $id;
        $query = self::$pdoInstance->query($sql);
        return $query->fetchObject(get_called_class());
    }

    public function save()
    {
        $columns = get_object_vars($this);
        $columns = array_diff_key($columns, get_class_vars(get_class()));

        if ($this->getId() == null) {
            $sql = "INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ") 
            VALUES ( :" . implode(",:", array_keys($columns)) . ")";
        } else {
            $update = [];
            foreach ($columns as $column => $value) {
                $update[] = $column . "=:" . $column;
            }
            $sql = "UPDATE " . $this->table . " SET " . implode(",", $update) . " WHERE id=" . $this->getId();
        }

        $queryPrepared = self::$pdoInstance->prepare($sql);
        $queryPrepared->execute($columns);
    }

    public function findOne($where)
    {
        $update = [];
        foreach ($where as $column => $value) {
            $update[] = $column . "=:" . $column;
        }

        $query = "SELECT * FROM $this->table WHERE " . implode(", ", $update);

        $queryPrepared = self::$pdoInstance->prepare($query);

        foreach ($where as $key => $value) {
            $queryPrepared->bindValue(":$key", $value);
        }

        $queryPrepared->execute();

        return $queryPrepared->fetchObject(get_called_class());
    }
}
