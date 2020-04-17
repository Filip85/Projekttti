<?php

class Session {
    private static $sessionStarted = false;

    public static function start() {
        if(self::$sessionStarted == false) {
            self::$sessionStarted = true;
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;

    }

    public static function get($key){
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        else {
            return false;
        }
    }

    public static function stop() {
        if(self::$sessionStarted == true) {
            self::$sessionStarted = false;
            session_destroy();
            unset($_SESSION['username']);
        }
    }

    /*public static function loggedIn($session) {
        header('Location: /profile');
    }*/
}