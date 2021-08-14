<?php
class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        $conn = 'mysql:host='. $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
            $information_tbl = "CREATE TABLE `information_tbl` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `master_id` varchar(255) NOT NULL,
                `target_id` varchar(255) NOT NULL,
                `ip_address` varchar(255) NOT NULL,
                `country` varchar(255) NOT NULL,
                `country_code` varchar(255) NOT NULL,
                `region_name` varchar(255) NOT NULL,
                `city` varchar(255) NOT NULL,
                `time_zone` varchar(255) NOT NULL,
                `lat` varchar(255) NOT NULL,
                `lon` varchar(255) NOT NULL,
                `isp` varchar(255) NOT NULL,
                `os` varchar(255) NOT NULL,
                `browser` varchar(255) NOT NULL,
                `device` varchar(255) NOT NULL,
                `date` date NOT NULL
              )";
            $users_tbl = "CREATE TABLE `users_tbl` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `master_id` varchar(15) NOT NULL,
                `target_id` varchar(15) NOT NULL,
                `redirect_link` varchar(255) NOT NULL,
                `date` date NOT NULL
              )";

            
            try {
                $tblname_users_tbl = 'users_tbl';
                $x = $this->dbHandler->prepare("DESCRIBE $tblname_users_tbl");
                $x->execute();
                $row = $x->fetch();
            } catch (Exception $e) {
                $this->query($users_tbl);
                $this->execute();
            }
            try {
                $tblname_information_tbl = 'information_tbl';
                $x = $this->dbHandler->prepare("DESCRIBE `$tblname_information_tbl`");
                $x->execute();
                $row = $x->fetch();
            } catch (Exception $e) {
                $this->query($information_tbl);
                $this->execute();
            }
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function bind($parameter, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
            $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        return $this->statement->execute();
    }

    public function resutlSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        $this->execute();
        return $this->statement->rowCount();
    }
}
