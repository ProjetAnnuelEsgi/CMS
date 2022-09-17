<?php

namespace App\Controller;

use App\Core\View;
use PDO;

class Installer
{
    public  $file = 'conf.inc.php';

    private static $pdoInstance;

    public function createTables($data)
    {
        if (!empty($data)) {
            extract($data);
        }

        $sqlFile = file_get_contents('full_db.sql');
        self::$pdoInstance->exec($sqlFile);

        return true;
    }

    public function checkData()
    {
        if (isset($_POST) && count($_POST) == 7) {
            $this->createConfFile($_POST);
        }
    }

    public function createConfFile()
    {
        if (!empty($_POST)) {
            extract($_POST);
        }

        $message = "Une erreur est parvenue pendant l\'installation, verifié bien les données saisies.";

        try {
            self::$pdoInstance = new PDO(
                "mysql:host=$dbhost;port=$dbport;dbname=$dbname",
                $dbuser,
                $dbpassword
            );
        } catch (\Exception $e) {

            echo "<script>;
                alert('$message');
                document.location = '/installer'
            </script>";
            die();
        };

        $contents =
            "<?php" . PHP_EOL
            . PHP_EOL . "define('DBUSER', '$dbuser') ;"
            . PHP_EOL . "define('DBPWD', '$dbpassword') ;"
            . PHP_EOL . "define('DBNAME', '$dbname') ;"
            . PHP_EOL . "define('DBHOST', '$dbhost') ;"
            . PHP_EOL . "define('DBPORT', '$dbport') ;"
            . PHP_EOL . "define('DBDRIVER', 'mysql') ;"
            . PHP_EOL . "define('DBPREFIXE', 'esgi_') ;"
            . PHP_EOL . "define('ONLINE_DOMAIN', 'http://fedcms.fr') ;"
            . PHP_EOL . "define('LOCAL_DOMAIN', 'http://localhost') ;"
            . PHP_EOL . "define('SITE_NAME', '$siteName') ;" . PHP_EOL
            . PHP_EOL . "define('MAILER_HOST', 'smtp.mailtrap.io') ;"
            . PHP_EOL . "define('MAILER_SMTP_AUTH', true) ;"
            . PHP_EOL . "define('MAILER_PORT', 2525) ;"
            . PHP_EOL . "define('MAILER_SMTP_USERNAME', 'f3f926d42a08da') ;"
            . PHP_EOL . "define('MAILER_SMTP_PASSWORD', 'd74d8657ef0801') ;"
            . PHP_EOL . "define('MAIL_FROM_ADDRESS', 'cdeft.lalg@gmail.com') ;"
            . PHP_EOL . "define('MAIL_FROM_USER', 'CMS-PA') ;"
            . PHP_EOL;

        file_put_contents($this->file, $contents);

        $contents = PHP_EOL . "/" . $siteName . ":" . PHP_EOL .
            "   controller: navbar" . PHP_EOL .
            "   action: index";
        file_put_contents('routes.yml', $contents, FILE_APPEND);

        $this->createTables($_POST);

        header("location: /");
    }


    public function install()
    {
        new View("install-user");
    }
}
