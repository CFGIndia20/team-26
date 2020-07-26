<?php
class Address
{
    private $table = "address";
    private $columns = ['id', 'block_no', 'street', 'city', 'pincode', 'state', 'country', 'town'];
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
    public function validateData($data)
    {
        $this->validator = $this->di->get('validator');
        $this->validator = $this->validator->check($data, [
            'block_no'=>[
                'required'=>true,
                'minlength'=>1,
                'maxlength'=>30,
            ],
            'street'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>25,
            ],
            'city'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>25
            ],
            'pincode'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>6
            ],
            'state'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>25
            ],
            'country'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>25
            ],
            'town'=>[
                'required'=>true,
                'minlength'=>2,
                'maxlength'=>25
            ],
        ]);
    }
    public function addAddress($data)
    {
        //VALIDATE DATA
        $this->validateData($data);

        //INSERT DATA IN DATABASE
        if(!$this->validator->fails())
        {
            try {
                $data_to_be_inserted = [
                    'block_no'=>$data['block_no'],
                    'street'=>$data['street'],
                    'city'=>$data['city'],
                    'pincode'=>$data['pincode'],
                    'state'=>$data['state'],
                    'country'=>$data['country'],
                    'town'=>$data['town']
                ];
                $address_id = $this->database->insert($this->table, $data_to_be_inserted);
                return $address_id;
            }catch(Exception $e) {
                $this->database->rollBack();
                return ADD_ERROR; 
            }
        }
        return VALIDATION_ERROR;
    }
    
    public function getAddressByID($id, $fetchMode = PDO::FETCH_OBJ)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = {$id} AND deleted = 0";
        $result = $this->database->raw($query, $fetchMode);
        return $result;
    }
    public function update($data, $id)
    {
        $data_to_be_updated = [
            'block_no'=>$data['block_no'],
            'street'=>$data['street'],
            'city'=>$data['city'],
            'pincode'=>$data['pincode'],
            'state'=>$data['state'],
            'country'=>$data['country'],
            'town'=>$data['town']
        ];
        $this->validateData($data_to_be_updated);
        
        if(!$this->validator->fails())
        {
            try {
                $updateStatus = $this->database->update($this->table, $data_to_be_updated, "id = {$id}");
                return $updateStatus;
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
            $this->database->delete($this->table, "id = {$id}");
            return DELETE_SUCCESS;
        }catch(Exception $e){
            $this->database->rollBack();
            return DELETE_ERROR;
        }
    }

}

