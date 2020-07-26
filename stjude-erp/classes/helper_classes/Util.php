<?php

class Util
{
    private static $baseURL;
    public function __construct(DependencyInjector $di)
    {
        self::$baseURL = $di->get('config')->get('base_url');
    }

    public static function redirect($filePath){
        header("Location: " . (self::$baseURL . "views/pages/$filePath"));
    }
    public static function dd($var = "") {
        die(var_dump($var));
    }
    public static function createCSRFToken() {
        Session::setSession('csrf_token', uniqid().rand());
        Session::setSession('token_expire', time() + 3600);
    }
    public static function verifyCSRFToken($data){
        return (isset($data['csrf_token']) 
            && Session::hasSession('csrf_token') 
            && $data['csrf_token'] == Session::getSession('csrf_token') 
            && Session::getSession('token_expire') > time());
    }
}