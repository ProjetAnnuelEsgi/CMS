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
            $sql = "UPDATE " . $this->table . " SET " . implode(", ", $update) . " WHERE id=" . $this->getId();
        }

        $queryPrepared = self::$pdoInstance->prepare($sql);
        $queryPrepared->execute($columns);
    }

    // e.g $user = $user->findOne(['email' => $email]);
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

    public function findAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $queryPrepared = self::$pdoInstance->prepare($query);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll();
    }

    public function attemptLogin($email)
    {
        $query = "SELECT * FROM $this->table WHERE email = :email";
        $queryPrepared  = self::$pdoInstance->prepare($query);

        $queryPrepared->bindValue(":email", $email);

        $queryPrepared->execute();
        $user = $queryPrepared->fetchObject(get_called_class());

        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id=" . $id;
        $queryPrepared = self::$pdoInstance->prepare($query);
        $queryPrepared->execute();

        return $queryPrepared;
    }

    public function specificAdminUsers($adminId)
    {
        $query = "SELECT * FROM esgi_user LEFT JOIN " . $this->table . " ON esgi_user.id =" . $this->table . ".user_id WHERE " .  $this->table . ".admin_id =" . $adminId;
        $queryPrepared = self::$pdoInstance->prepare($query);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll();
    }

    public function panelUsers($panelId, $id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE panel_id= " . "'$panelId' AND id != '$id'";
        $queryPrepared = self::$pdoInstance->prepare($query);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll();
    }

    public function panelPages($panelId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE page_panelId= " . "'$panelId'";
        $queryPrepared = self::$pdoInstance->prepare($query);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll();
    }

    public function panelArticles($panelId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE article_panelId= " . "'$panelId'";
        $queryPrepared = self::$pdoInstance->prepare($query);
        $queryPrepared->execute();

        return $queryPrepared->fetchAll();
    }
}
