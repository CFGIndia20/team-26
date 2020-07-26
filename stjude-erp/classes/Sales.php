<?php


class Sales{
    private $table = "sales";
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
            'customer_id'=>[
                'required'=>true,
                'exists'=>'customers.id'
            ],
            'category_id'=>[
                'required'=>true,
                'exists'=>'category.id'
            ],
            'products_id'=>[
                'required'=>true,
                'exists'=>'products.id'
            ],
            'quantity'=>[
                'min'=>1
            ],
            'discount'=>[
                'min'=>0,
                'max'=>100
            ]
        ]);
    }
    public function addSales($data) {
        // Util::dd($data);
        $this->validateData($data);
        
        if(!$this->validator->fails()) {
            try{
                $data_for_invoice = ['customer_id'=>$data['customer_id']];
                //BEGIN TRANSACTION
                $this->database->beginTransaction();
                $invoice_id = $this->database->insert('invoice', $data_for_invoice);
                
                $data_to_be_inserted = [];
                for($i=0; $i<sizeof($data['products_id']); $i++){
                    $data_to_be_inserted['product_id'] = $data['products_id'][$i];
                    $data_to_be_inserted['quantity'] = $data['quantity'][$i];
                    $data_to_be_inserted['discount'] = $data['discount'][$i];
                    $data_to_be_inserted['invoice_id'] = $invoice_id;
                    $this->database->insert($this->table, $data_to_be_inserted);
                }
                $this->database->commit();
                Util::redirect("invoice.php?id={$invoice_id}");

            }catch(Exception $e) {
                $this->database->rollBack();
                return ADD_ERROR;
            }
        }
        else
        {
            return VALIDATION_ERROR;
        }
    }
}