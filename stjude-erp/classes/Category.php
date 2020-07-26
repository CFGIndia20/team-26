<?php
class Category
{
    private $table = "category";
    private $columns = ['id', 'name'];
    protected $di;
    private $database;
    private $validator;
    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
    }
    public function getValidator()
    {
        return $this->validator;
    }
    public function validateData($data, $id=0)
    {
        $this->validator = $this->di->get('validator');
        $this->validator = $this->validator->check($data, [
            'name'=>[
                'required'=>true,
                'minlength'=>3,
                'maxlength'=>20,
                'unique'=>$this->table.".".$id
            ]
        ]);
    }
    public function addCategory($data)
    {
        //VALIDATE DATA
        $this->validateData($data);

        //INSERT DATA IN DATABASE
        if(!$this->validator->fails())
        {
            try {
                $this->database->beginTransaction();
                $data_to_be_inserted = ['name'=>$data['name']];
                $category_id = $this->database->insert($this->table, $data_to_be_inserted);
                $this->database->commit();
                return ADD_SUCCESS;
            }catch(Exception $e) {
                $this->database->rollBack();
                return ADD_ERROR; //ADD_ERROR ka probability kaam hai, tab hi aayega sab database server busy hai ya connection error hai.
            }
        }
        return VALIDATION_ERROR;
    }
    public function getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length)
    {
        $query = "SELECT * FROM {$this->table} WHERE deleted = 0";
        $totalRowCountQuery = "SELECT COUNT(*) as total_count FROM {$this->table} WHERE deleted = 0";
        $filteredRowCountQuery = "SELECT COUNT(*) as total_count FROM {$this->table} WHERE deleted = 0";

        if($search_parameter != null)
        {
            $query .= " AND name LIKE '%{$search_parameter}%'";
            $filteredRowCountQuery .= " AND name LIKE '%{$search_parameter}%'";
        }
        // Util::dd($this->columns[$order_by[0]['column']]);
        if($order_by != null)
        {
            $query .= " ORDER BY {$this->columns[$order_by[0]['column']]} {$order_by[0]['dir']}";
            $filteredRowCountQuery .= " ORDER BY {$this->columns[$order_by[0]['column']]} {$order_by[0]['dir']}";
        }
        else
        {
            $query .= " ORDER BY {$this->columns[0]} ASC";
            $filteredRowCountQuery .= " ORDER BY {$this->columns[0]} ASC";
        }

        if($length != -1)
        {
            $query .= " LIMIT {$start}, {$length}";
        }

        $totalRowCountResult = $this->database->raw($totalRowCountQuery);
        $numberOfTotalRows = is_Array($totalRowCountResult) ? $totalRowCountResult[0]->total_count : 0;

        $filteredRowCountResult = $this->database->raw($filteredRowCountQuery);
        $numberOfFilteredRows = is_Array($filteredRowCountResult) ? $filteredRowCountResult[0]->total_count : 0;

        $fetchedData = $this->database->raw($query);
        $data = [];
        $numRows = is_array($fetchedData) ? count($fetchedData) : 0;
        for($i=0; $i<$numRows; $i++)
        {
            $subArray = [];
            $subArray[] = $start+$i+1;
            $subArray[] = $fetchedData[$i]->name;
            $subArray[] = <<<BUTTONS
<button class='btn btn-outline-primary btn-sm edit' data-id='{$fetchedData[$i]->id}' data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt"></i></button>
<button class='btn btn-outline-danger btn-sm delete' data-id='{$fetchedData[$i]->id}' data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>       
BUTTONS;
            $data[] = $subArray;
        }

        $output = array(
            'draw'=>$draw,
            'recordsTotal'=>$numberOfTotalRows,
            'recordsFiltered'=>$numberOfFilteredRows,
            'data'=>$data
        );
        echo json_encode($output);
    }
    public function getCategoryByID($id, $fetchMode = PDO::FETCH_OBJ)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = {$id} AND deleted = 0";
        $result = $this->database->raw($query, $fetchMode);
        return $result;
    }
    public function update($data, $id)
    {
        $data_to_be_updated = ['name'=>$data['category_name']];
        $this->validateData($data_to_be_updated, $id);
        if(!$this->validator->fails())
        {
            try {
                $this->database->beginTransaction();
                $this->database->update($this->table, $data_to_be_updated, "id = {$id}");
                $this->database->commit();
                return UPDATE_SUCCESS;
            }catch(Exception $e) {
                $this->database->rollBack();
                return UPDATE_ERROR; 
            }
        }
        else
        {
            return VALIDATION_ERROR;   
        }
    }
    public function delete($id)
    {
        try{
            $this->database->beginTransaction();
            $this->database->delete($this->table, "id = {$id}");
            $this->database->commit();
            return DELETE_SUCCESS;
        }catch(Exception $e){
            $this->database->rollBack();
            return DELETE_ERROR;
        }
    }
    public function all(){
        return $this->database->readData($this->table, [], "deleted = 0");
    }
}



/*
 * Multiline String Definition
 * 

$var = <<<PREM
Hello World
This is a multiline string in php
HERE DOC
PREM;
 */