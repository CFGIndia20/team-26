<?php
class Validator
{
    private $di;
    protected $database;
    protected $errorHandler;
    
    protected $rules = ["required", "minlength", "maxlength", "unique", "email", "exists", "min", "max"];
    protected $messages = [
        "required" => "This :field field is required",
        "minlength" => "This :field field must be a minimum of :satisfier characters",
        "maxlength" => "This :field field must be a maximum of :satisfier characters",
        "email" => "This is not a valid email address", 
        "unique" => "That :field is already taken",
        "exists" => "This :field is invalid! It does not exists",
        "min" => "Minimum value for :field is :satisifer",
        "max" => "Maximum value for :field is :satisifer"
    ];

    /**
     * Validator constructor.
     * @param DependenyInjector $di
     */
    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
        $this->errorHandler = $this->di->get('error_handler');
    }
    public function check($items, $rules)
    {
        foreach($items as $item=>$value)
        {
            if(in_array($item, array_keys($rules)))
            {
                $this->validate([
                    'field'=>$item,
                    'value'=>$value,
                    'rules'=>$rules[$item]
                ]);
            }
        }
        return $this;
    }
    public function fails()
    {
        return $this->errorHandler->hasErrors();
    }
    public function errors()
    {
        return $this->errorHandler;
    }
    private function validate($item)
    {
        /*
         * $item['field'] -> contains the column name which has to be tested for the validation
         * $item['value'] -> contains the value which was inserted by the user in the form
         * $item['rules'] -> it is array of rules to be applied for the specific 'field'
         */
        $field = $item['field'];
        $value = $item['value'];
        foreach($item['rules'] as $rule=>$satisfier)
        {
            $result = call_user_func_array([$this, $rule], [$field, $value, $satisfier]);
            if(is_array($result))
            {
                // Util::dd($result);
                for($i=0; $i<sizeof($result); $i++){
                    $this->errorHandler->addError(str_replace([':field', ':satisfier'], [$field, $satisfier], $this->messages[$rule]), $field, $result[$i]);
                }
            }
            elseif(!$result)
            {
                //store the error in the error handler
                $this->errorHandler->addError(str_replace([':field', ':satisfier'], [$field, $satisfier], $this->messages[$rule]), $field, 0);
            }
        }

    }
    private function required($field, $value, $satisfier)
    {
        if(is_array($value)){
            $empty = array();
            $j = 0;
            for($i=0; $i<sizeof($value); $i++){
                if(empty(trim($value[$i]))){
                    $empty[$j++] = $i;
                }
            }
            // Agar empty hua toh bhejega!
            // Util::dd($empty);
            return $empty;
        }
        return !empty(trim($value));
    }
    private function minlength($field, $value, $satisfier)
    {
        return mb_strlen($value)>=$satisfier;
    }
    private function maxlength($field, $value, $satisfier)
    {
        return mb_strlen($value)<=$satisfier;
    }
    private function unique($field, $value, $satisfier)
    {
        // Here $satisfier will become the tablename and id of the record!
        // $field will become the name of column
        // $value should be unique under the above table and column except the record
        $tableAndID = explode(".", $satisfier);
        $id = trim($tableAndID[1]);
        $satisfier = trim($tableAndID[0]);
        return !$this->database->exists($satisfier, [$field=>$value], $id);
    }
    private function email($field, $value, $satisfier)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    // This function returns true if exists
    private function exists($field, $value, $satisfier)
    {
        $tableAndColName = explode(".", $satisfier);
        $tableName = trim($tableAndColName[0]);
        $colName = trim($tableAndColName[1]);
        if(is_array($value))
        {
            $exists = array();
            $j = 0; 
            for($i=0; $i<sizeof($value); $i++){
                // Util::dd($value[$i]);
                if(!$this->database->exists($tableName, [$colName=>$value[$i]])){
                    $exists[$j++] = $i;
                }
            }
            // Agar exists nai karta hoga toh bhejega!
            // Util::dd($exists);
            return $exists;
        }
        return $this->database->exists($tableName, [$colName=>$value]);
    }
    private function min($field, $value, $satisfier)
    {
        if(is_array($value))
        {
            $min = array();
            $j = 0; 
            for($i=0; $i<sizeof($value); $i++){
                if($value[$i] < $satisfier){
                    $min[$j++] = $i;
                }
            }
            // This will return agar minimum se kaam hua toh
            // Util::dd($min);
            return $min;
        }
        // returns true if proper
        return ($value >= $satisfier ? true : false);
    }
    private function max($field, $value, $satisfier)
    {
        if(is_array($value))
        {
            $max = array();
            $j = 0; 
            for($i=0; $i<sizeof($value); $i++){
                if($value[$i] > $satisfier){
                    $max[$j++] = $i;
                }
            }
            // This will return agar maximum se zyada hua toh
            // Util::dd($max);
            return $max;
        }
        // returns true if proper
        return ($value <= $satisfier ? true : false);
    }
}