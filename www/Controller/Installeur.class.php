<?php

namespace App\Controller;

use App\Core\Sql;
use App\Core\View;
use App\Model\User;
use mysqli;

class Installeur extends Sql
{

    public function install()
    {
       $test = $this->ifDatabaseexist();
        echo $test;


    }

}
