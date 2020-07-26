<?php


class Config
{
    protected $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = parse_ini_file(__DIR__ . "/../../config.ini");
    }
    public function get(string $key):string
    {
        if(isset($this->config[$key]))
        {
            return $this->config[$key];
        }
        /*
         * TODO: Convert the below die() to appropriate error message 
         */
        die('This config cannot be found: ' . $key);
    }
}