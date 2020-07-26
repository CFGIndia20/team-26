<?php


class Session
{
    public static function checkSession(){
        return session_status() == PHP_SESSION_ACTIVE;
    }
    public static function startSesion(){
        if(!self::checkSession()){
            session_start();
        }
    }
    public static function destroySesion(){
        if(self::checkSession()){
            session_destroy();
        }
    }
    public static function setSession($key, $value){
        self::startSesion();
        $_SESSION[$key] = $value;
    }
    public static function getSession($key) {
        if(self::hasSession($key))
        {
            return $_SESSION[$key];
        }
        return null;
    }
    public static function hasSession($key){
        if(self::checkSession() && isset($_SESSION[$key]))
        {
            return true;
        }
        return false;
    }
    public static function unsetSession($key){
        if(self::hasSession($key))
        {
            unset($_SESSION[$key]);
        }
    }
}

