<?php

namespace App\Controller;

use App\Core\View;
use PDO;

class Installer
{
    public  $file = 'conf.inc.php';

    public function searchForDb($id, $array)
    {
        foreach ($array as $key => $val) {
            if ($val['Database'] === $id) {
                return $val['Database'];
            }
        }
        return null;
    }

    public function searchForTable($id, $array)
    {
        $t = [];
        foreach ($array as $key => $val) {
            array_push($t, $val[$id]);
        }
        return $t;
    }

    public function createdbAndTable()
    {
        $bdd = new PDO(
            "mysql:host=database;port=3306;dbname=" . 'mvcdocker2',
            'root',
            'fedcms2022'
        );

        $createDbSql = "CREATE DATABASE IF NOT EXISTS mvcdocker2 ";

        $bdd->query($createDbSql);

        $sqlFile = file_get_contents('full_db.sql');
        $bdd->exec($sqlFile);
        return true;
    }


    public function checkData()
    {

        $contents =
            "<?php" . PHP_EOL
            . PHP_EOL . "define('DBUSER', 'root') ;"
            . PHP_EOL . "define('DBPWD', 'fedcms2022') ;"
            . PHP_EOL . "define('DBNAME', 'mvcdocker2') ;"
            . PHP_EOL . "define('DBHOST', 'database') ;"
            . PHP_EOL . "define('DBPORT', '3306') ;"
            . PHP_EOL . "define('DBDRIVER', 'mysql') ;"
            . PHP_EOL . "define('DBPREFIXE', 'esgi_') ;"
            . PHP_EOL . "define('ONLINE_DOMAIN', 'http://fedcms.fr') ;"
            . PHP_EOL . "define('LOCAL_DOMAIN', 'http://localhost') ;" . PHP_EOL
            . PHP_EOL . "define('MAILER_HOST', 'smtp-relay.sendinblue.com') ;"
            . PHP_EOL . "define('MAILER_SMTP_USERNAME', 'lawson.earvin@gmail.com') ;"
            . PHP_EOL . "define('MAILER_PORT', 58) ;"
            . PHP_EOL . "define('MAILER_SMTP_PASSWORD', 'bIhVv2RA7gKWXYdN') ;"
            . PHP_EOL . "define('MAILER_SMTP_AUTH', true) ;"
            . PHP_EOL . "define('MAIL_FROM_ADDRESS', 'cdeft.lalg@gmail.com') ;"
            . PHP_EOL . "define('MAIL_FROM_USER', 'CMS-PA') ;"
            . PHP_EOL;

        file_put_contents($this->file, $contents);

        $data = $this->createdbAndTable();
    }


    public function install()
    {
        $f = file_get_contents($this->file);
        if (!empty($f)) {
            header("location: /home");
        }
        $this->checkData();
        new View("install-user");
    }
}
