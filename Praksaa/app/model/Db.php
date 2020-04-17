<?php


class Db{
    protected static $instance = null;

    public static function getInstance() {
        $configs = App::config();

        if(self::$instance === null) {
            try {
                $db = "mysql:host=" . $configs['servername'] . ";dbname=" . $configs['dbname'] . ";charset=" . $configs['charset'];
                self::$instance = new PDO($db, $configs['username'], $configs['password']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connect failed: " . $e->getMessage();
            }
        }
        return self::$instance;    //extends PDO -> new self
    }
}
