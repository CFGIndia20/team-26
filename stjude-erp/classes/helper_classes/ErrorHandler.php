<?php
class ErrorHandler
{
    protected $errors = [];

    public function addError($error, $key=null, $index=-1)
    {
        if($key)
        {
            $this->errors[$key][] = $index . "=>" . $error;
        }
        else
        {
            $this->errors[] = $index . "=>" . $error;
        }
    }
    public function hasErrors()
    {
        return count($this->all()) ? true : false;
    }
    public function has($key)
    {
        return isset($this->errors[$key]);
    }
    public function all($key = null)
    {
        return isset($this->errors[$key]) ? $this->errors[$key] : $this->errors;
    }
    public function first($key)
    {
        return isset($this->errors[$key]) ? $this->all($key)[0] : false;
    }
}