<?php
class Invoice
{
    private $table = "invoice";
    private $columns = ['id', 'customer_id'];
    protected $di;
    private $database;

    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
    }
    
    public function getSupplierByID($id, $fetchMode = PDO::FETCH_OBJ)
    {
        $query = "SELECT * FROM `invoice`, `customers`, `address`, `address_customer`, `products`, `suppliers`, `sales`, `category`, `product_supplier`, `products_selling_rate` WHERE `invoice`.customer_id = `customers`.id AND `address_customer`.customer_id = `customers`.id AND `address_customer`.address_id = `address`.id AND `sales`.product_id = `products`.id AND `products`.category_id = `category`.id AND `product_supplier`.product_id = `products`.id AND `suppliers`.id = `product_supplier`.supplier_id AND `sales`.invoice_id = $id AND `invoice`.id = $id AND `products_selling_rate`.product_id = `products`.id AND `invoice`.deleted = 0";

        $result = $this->database->raw($query, $fetchMode);
        return $result;
    }
}

