<?php

class Request {

    public static function pathInfo(){
        if(isset($_SERVER['REQUEST_URI'])){
            return $_SERVER['REQUEST_URI'];
        }
        else {
            return '';
        }
    }
}