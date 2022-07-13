<?php

namespace App\Controller;

use App\Core\Sql;
use App\Model\Page;

abstract class PageServices
{
    public static function findAuthor(){
        $query = "SELECT user_id FROM esgi_author LEFT JOIN esgi_page ON esgi_page.author_id = esgi_author.id WHERE esgi_page.author_id = :author_id";

        // $toto = new Page();
        // $toto->getInstance();

        try {
            $sql = Sql::getInstance();
            $stmt = $sql->dbh->prepare($query);
            // var_dump($stmt);
        } catch (\Throwable $th) {
            // var_dump($th);
        }
        // var_dump($th);
        // die;


        // $pdoInstance  = Sql::getInstance();
        // $queryPrepared = $pdoInstance->getPDO()->prepare($query);

        // $queryPrepared->bindValue(":author_id", 1);
        // $queryPrepared->execute();

        // var_dump($queryPrepared->fetchAll());

        // return $queryPrepared->fetchAll();  
    }

}