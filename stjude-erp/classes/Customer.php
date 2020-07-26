<?php
class Customer
{
    private $table = "customers";
    private $columns = ['id', 'first_name', 'last_name', 'gst_no', 'phone_no', 'email_id', 'gender', 'address', 'town'];
    protected $di;
    private $database;
    private $address;
    private $validator;
    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
        $this->address = $this->di->get('address');
    }
    public function getValidator()
    {
        return $this->validator;
    }
    public function validateData($data, $id=0)
    {
        $this->validator = $this->di->get('validator');
        $this->validator = $this->validator->check($data, [
            'first_name'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>20,
            ],
            'last_name'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>20,
            ],
            'phone_no'=>[
                'required'=>true,
                'minlength'=>10,
                'maxlength'=>10,
                'unique'=>$this->table.".".$id
            ],
            'email_id'=>[
                'required'=>true,
                'email'=>true,
                'maxlength'=>40,
                'unique'=>$this->table.".".$id
            ],
            'gender'=>[
                'required'=>true
            ]
        ]);
    }
    public function addCustomer($data)
    {
        //VALIDATE DATA
        $this->validateData($data);

        //INSERT DATA IN DATABASE
        if(!$this->validator->fails())
        {
            try {
                $this->database->beginTransaction();
                $data_to_be_inserted = [
                    'first_name'=>$data['first_name'],
                    'last_name'=>$data['last_name'],
                    'phone_no'=>$data['phone_no'],
                    'email_id'=>$data['email_id'],
                    'gender'=>$data['gender']
                ];
                $customer_id = $this->database->insert($this->table, $data_to_be_inserted);
                $address_id = $this->address->addAddress($data);
                
                $query = "INSERT INTO `address_customer` (`address_id`, `customer_id`) VALUES ({$address_id}, {$customer_id})";
                $this->database->query($query);

                $this->database->commit();
                return ADD_SUCCESS;
            }catch(Exception $e) {
                $this->database->rollBack();
                return ADD_ERROR; 
            }
        }
        return VALIDATION_ERROR;
    }
    public function getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length)
    {
        $query = "SELECT `customers`.id, `customers`.first_name, `customers`.last_name, `customers`.phone_no, `customers`.email_id, `customers`.gender, `address`.block_no, `address`.street, `address`.city, `address`.pincode, `address`.state, `address`.country, `address`.town  FROM `{$this->table}`, `address_customer`, `address` WHERE `{$this->table}`.deleted = 0 AND `address`.deleted = 0 AND `{$this->table}`.id = `address_customer`.customer_id AND `address_customer`.address_id = `address`.id";
        $totalRowCountQuery = "SELECT COUNT(*) AS total_count FROM `{$this->table}`, `address_customer`, `address` WHERE `{$this->table}`.deleted = 0 AND `address`.deleted = 0 AND `address`.deleted = 0 AND `{$this->table}`.id = `address_customer`.customer_id AND `address_customer`.address_id = `address`.id";
        $filteredRowCountQuery = "SELECT COUNT(*) AS total_count FROM `{$this->table}`, `address_customer`, `address` WHERE `{$this->table}`.deleted = 0 AND `address`.deleted = 0 AND `address`.deleted = 0 AND `{$this->table}`.id = `address_customer`.customer_id AND `address_customer`.address_id = `address`.id";

        if($search_parameter != null)
        {
            $query .= " AND (first_name LIKE '%{$search_parameter}%' OR last_name LIKE '%{$search_parameter}%' OR gst_no LIKE '%{$search_parameter}%' OR phone_no LIKE '%{$search_parameter}%' OR email_id LIKE '%{$search_parameter}%' OR gender LIKE '%{$search_parameter}%' OR `address`.block_no LIKE '%{$search_parameter}%' OR `address`.street LIKE '%{$search_parameter}%' OR `address`.city LIKE '%{$search_parameter}%' OR `address`.pincode LIKE '%{$search_parameter}%' OR `address`.state LIKE '%{$search_parameter}%' OR `address`.country LIKE '%{$search_parameter}%' OR `address`.town LIKE '%{$search_parameter}%')";
            $filteredRowCountQuery .= " AND (first_name LIKE '%{$search_parameter}%' OR last_name LIKE '%{$search_parameter}%' OR gst_no LIKE '%{$search_parameter}%' OR phone_no LIKE '%{$search_parameter}%' OR email_id LIKE '%{$search_parameter}%' OR gender LIKE '%{$search_parameter}%' OR `address`.block_no LIKE '%{$search_parameter}%' OR `address`.street LIKE '%{$search_parameter}%' OR `address`.city LIKE '%{$search_parameter}%' OR `address`.pincode LIKE '%{$search_parameter}%' OR `address`.state LIKE '%{$search_parameter}%' OR `address`.country LIKE '%{$search_parameter}%' OR `address`.town LIKE '%{$search_parameter}%')";
        }

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
        $basePages = BASEPAGES;
        for($i=0; $i<$numRows; $i++)
        {
            $subArray = [];
            $subArray[] = $start+$i+1;
            $subArray[] = $fetchedData[$i]->first_name . " " . $fetchedData[$i]->last_name;
            $subArray[] = $fetchedData[$i]->phone_no;
            $subArray[] = $fetchedData[$i]->email_id;
            $subArray[] = $fetchedData[$i]->gender;
            $subArray[] = $fetchedData[$i]->block_no . ", " . $fetchedData[$i]->street . ", " . $fetchedData[$i]->city . ", " . $fetchedData[$i]->pincode . ", " . $fetchedData[$i]->state . ", " . $fetchedData[$i]->country;
            $subArray[] = $fetchedData[$i]->town;
            $subArray[] = <<<BUTTONS
<a href="{$basePages}edit-customer.php?id={$fetchedData[$i]->id}" class='btn btn-outline-primary btn-sm edit'><i class="fas fa-pencil-alt"></i></a>
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
    public function getCustomerByID($id, $fetchMode = PDO::FETCH_OBJ)
    {
        $query = "SELECT * FROM `customers`, `address_customer`, `address` WHERE `customers`.deleted = 0 AND `address`.deleted = 0 AND `customers`.id = {$id} AND `address_customer`.customer_id = {$id} AND `address_customer`.address_id = `address`.id";
        $result = $this->database->raw($query, $fetchMode);
        return $result;
    }
    public function update($data, $id)
    {
        $data_to_be_updated = [
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'phone_no'=>$data['phone_no'],
            'email_id'=>$data['email_id'],
            'gender'=>$data['gender'] 
        ];
        $this->validateData($data_to_be_updated, $id);
        
        if(!$this->validator->fails())
        {
            try {
                $this->database->beginTransaction();
                $this->database->update($this->table, $data_to_be_updated, "id = {$id}");

                $query = "SELECT address_id FROM `address_customer` WHERE `customer_id` = {$id}";
                $address = $this->database->raw($query);
                $this->address->update($data, $address[0]->address_id);

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

            $query = "SELECT address_id FROM `address_customer` WHERE `customer_id` = {$id}";
            $address = $this->database->raw($query);
            $this->address->delete($address[0]->address_id);

            $sql = "DELETE FROM `address_customer` WHERE `customer_id` = {$id} AND `address_id` = {$address[0]->address_id}";
            $this->database->query($sql);

            $this->database->commit();
            return DELETE_SUCCESS;
        }catch(Exception $e){
            $this->database->rollBack();
            return DELETE_ERROR;
        }
    }
    public function getCustomerWithEmail($email_id){
        return $this->database->readData('customers', ['id', 'email_id'], "email_id = '{$email_id}' and deleted=0");
    }
}

