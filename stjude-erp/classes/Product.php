<?php


class Product
{
    private $table = "products";
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
            ]
        ]);
    }
    public function addProduct($data) {
        $this->validateData($data);
        if(!$this->validator->fails()) {
            try{
                $table_attr=['name'=>0,'specification'=>0, 'category_id'=>0];
                $data_to_be_inserted = array_intersect_key($data, $table_attr);
                //BEGIN TRANSACTION
                $this->database->beginTransaction();
                $product_id = $this->database->insert($this->table, $data_to_be_inserted);
                $data_for_product_supplier = [];
                $data_for_product_supplier['product_id'] = $product_id;
                foreach ($data['supplier_id'] as $supplier_id) {
                    $data_for_product_supplier['supplier_id'] = $supplier_id;
                    $this->database->insert('product_supplier', $data_for_product_supplier);
                }
                $data_for_selling_table = [];
                $data_for_selling_table['product_id'] = $product_id;
                $this->database->commit();
                return ADD_SUCCESS;

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
    public function getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length)
    {
        $columns = ['products.id', 'products.name', 'products.specification', 'category.name', 'suppliers.name'];
        $query = "SELECT products.id, products.name as product_name, products.specification, products.quantity, category.name as category_name, GROUP_CONCAT(CONCAT(suppliers.first_name, suppliers.last_name) SEPARATOR ' | ') as supplier_name, products_selling_rate.selling_rate FROM products_selling_rate INNER JOIN (SELECT product_id FROM (SELECT product_id FROM products_selling_rate) as temp GROUP BY temp.product_id) as max_date_table ON max_date_table.product_id = products_selling_rate.product_id INNER JOIN products ON products.id = products_selling_rate.product_id INNER JOIN category ON category.id = products.category_id INNER JOIN product_supplier ON product_supplier.product_id = products.id INNER JOIN suppliers ON suppliers.id = product_supplier.supplier_id WHERE products.deleted = 0";

        $groupBy = " GROUP BY products.id";

        $totalRowCountQuery = "SELECT COUNT(*) as total_count FROM ((SELECT products.id  FROM products_selling_rate INNER JOIN (SELECT product_id FROM (SELECT product_id FROM products_selling_rate) as temp GROUP BY temp.product_id) as max_date_table ON max_date_table.product_id = products_selling_rate.product_id INNER JOIN products ON products.id = products_selling_rate.product_id INNER JOIN category ON category.id = products.category_id INNER JOIN product_supplier ON product_supplier.product_id = products.id INNER JOIN suppliers ON suppliers.id = product_supplier.supplier_id WHERE products.deleted = 0 GROUP BY products.id) as final_table)";

        // $totalRowCountQuery = "SELECT DISTINCT(count(*) OVER()) AS total_count FROM products_selling_rate INNER JOIN (SELECT product_id, MAX(with_effect_from) as wef FROM (SELECT product_id, with_effect_from FROM products_selling_rate WHERE with_effect_from<=CURRENT_TIMESTAMP) as temp GROUP BY temp.product_id) as max_date_table ON max_date_table.product_id = products_selling_rate.product_id AND products_selling_rate.with_effect_from = max_date_table.wef INNER JOIN products ON products.id = products_selling_rate.product_id INNER JOIN category ON category.id = products.category_id INNER JOIN product_supplier ON product_supplier.product_id = products.id INNER JOIN suppliers ON suppliers.id = product_supplier.supplier_id WHERE products.deleted = 0 GROUP BY products.id";

        $filteredRowCountQuery = "SELECT COUNT(*) as total_count FROM ((SELECT products.id  FROM products_selling_rate INNER JOIN (SELECT product_id FROM (SELECT product_id FROM products_selling_rate) as temp GROUP BY temp.product_id) as max_date_table ON max_date_table.product_id = products_selling_rate.product_id INNER JOIN products ON products.id = products_selling_rate.product_id INNER JOIN category ON category.id = products.category_id INNER JOIN product_supplier ON product_supplier.product_id = products.id INNER JOIN suppliers ON suppliers.id = product_supplier.supplier_id WHERE products.deleted = 0";
        $endPart = " GROUP BY products.id) as final_table)";

        // $filteredRowCountQuery = "SELECT DISTINCT(count(*) OVER()) AS total_count FROM products_selling_rate INNER JOIN (SELECT product_id, MAX(with_effect_from) as wef FROM (SELECT product_id, with_effect_from FROM products_selling_rate WHERE with_effect_from<=CURRENT_TIMESTAMP) as temp GROUP BY temp.product_id) as max_date_table ON max_date_table.product_id = products_selling_rate.product_id AND products_selling_rate.with_effect_from = max_date_table.wef INNER JOIN products ON products.id = products_selling_rate.product_id INNER JOIN category ON category.id = products.category_id INNER JOIN product_supplier ON product_supplier.product_id = products.id INNER JOIN suppliers ON suppliers.id = product_supplier.supplier_id WHERE products.deleted = 0";

        if($search_parameter != null)
        {
            $condition = " AND products.name LIKE '%{$search_parameter}%' OR products.specification LIKE '%{$search_parameter}%' OR category.name LIKE '%{$search_parameter}%' OR suppliers.first_name LIKE '%{$search_parameter}%' OR suppliers.last_name LIKE '%{$search_parameter}%'";
            $query .= $condition;
            $filteredRowCountQuery .= $condition;
        }
        
        $query .= $groupBy;
        $filteredRowCountQuery .= $endPart;
        // $filteredRowCountQuery .= $groupBy;

//         Util::dd($columns[$order_by[0]['column']]);
        if($order_by != null)
        {
            $query .= " ORDER BY {$columns[$order_by[0]['column']]} {$order_by[0]['dir']}";
            // $filteredRowCountQuery .= " ORDER BY {$columns[$order_by[0]['column']]} {$order_by[0]['dir']}";
        }
        else
        {
            $query .= " ORDER BY {$columns[0]} ASC";
            // $filteredRowCountQuery .= " ORDER BY {$columns[0]} ASC";
        }

        if($length != -1)
        {
            $query .= " LIMIT {$start}, {$length}";
        }
        $totalRowCountResult = $this->database->raw($totalRowCountQuery);
        $numberOfTotalRows = is_Array($totalRowCountResult) ? $totalRowCountResult[0]->total_count : 0;

        $filteredRowCountResult = $this->database->raw($filteredRowCountQuery);
        $numberOfFilteredRows = is_Array($filteredRowCountResult) ? $filteredRowCountResult[0]->total_count : 0;
        // $numberOfFilteredRows = is_Array($filteredRowCountResult) ? (sizeof($filteredRowCountResult) != 0 ? $filteredRowCountResult[0]->total_count : 0) : 0;

        $fetchedData = $this->database->raw($query);
        $data = [];
        $numRows = is_array($fetchedData) ? count($fetchedData) : 0;
        $basePages = BASEPAGES;
//        Util::dd($numRows);
        for($i=0; $i<$numRows; $i++)
        {
            $subArray = [];
            $subArray[] = $start+$i+1;
            $subArray[] = $fetchedData[$i]->product_name;
            $subArray[] = $fetchedData[$i]->specification;
            $subArray[] = $fetchedData[$i]->category_name;
            $subArray[] = $fetchedData[$i]->supplier_name;
            $subArray[] = <<<BUTTONS
<a href="{$basePages}edit-product.php?id={$fetchedData[$i]->id}" class='btn btn-outline-primary btn-sm edit'><i class="fas fa-pencil-alt"></i></a>
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
    public function getProductByID($id, $fetchMode = PDO::FETCH_OBJ)
    {
        $query = "SELECT products.id, products.name AS name, products.specification, category.id AS category_id, category.name AS category_name WHERE products.deleted = 0 AND products.id = {$id}";
        $result = $this->database->raw($query, $fetchMode);
        return $result;
    }
    public function update($data, $id)
    {
        $this->validateData($data, $id);

        if(!$this->validator->fails()) {
            try{
                $table_attr=['name'=>0,'specification'=>0, 'category_id'=>0];
                $data_to_be_updated = array_intersect_key($data, $table_attr);

                //BEGIN TRANSACTION
                $this->database->beginTransaction();
                $this->database->update($this->table, $data_to_be_updated, "id = {$id}");

                //Updating Suppliers for the Product
                // For this : We need to check if same hai ki alag, and agar alag hai toh previous wale joh abhi maine nikal diye hai waise records i have to hard delete and new records dd karne hai else continue!

                // Fetching the exisitng suppliers 
                $existingSuppliers = $this->database->readData('product_supplier', ['id', 'product_id', 'supplier_id'], "product_id = {$id} AND deleted = 0");
                // Util::dd($existingSuppliers[0]->supplier_id);

                $data_for_product_supplier = [];
                $data_for_product_supplier['product_id'] = $id;
                
                foreach ($data['supplier_id'] as $supplier_id) {
                    $data_for_product_supplier['supplier_id'] = $supplier_id;

                    // Removing all the suppliers from existingSuppliers which already exists and are still selected.
                    $exists = false;
                    for($i=0; $i<sizeof($existingSuppliers); $i++){
                        if($supplier_id == $existingSuppliers[$i]->supplier_id){
                            array_splice($existingSuppliers, $i, $i+1);
                            $exists = true;
                            break;
                        }
                    }
                       
                    // Util::dd($existingSuppliers);                 
                    // Adding the suppliers who does not exists and selecting while editing.
                    if(!$exists){
                        $this->database->insert('product_supplier', $data_for_product_supplier);
                    }
                }
                
                // Util::dd(sizeof($existingSuppliers));
                // Will hard delete the suppliers which already exists in database but where unselected while editing the product.
                for($i=0; $i<sizeof($existingSuppliers); $i++)
                {
                    // Util::dd($existingSuppliers[$i]->id);
                    $query = "DELETE FROM `product_supplier` WHERE id = {$existingSuppliers[$i]->id}";
                    $this->database->query($query);
                } 

                // Updating the Selling Price

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
    public function getProductsByCategoryID($category_id){
        return $this->database->readData('products', ['id', 'name'], "category_id = {$category_id} and deleted=0");
    }
    public function getSellingRateByProductID($product_id){
        // $query = "SELECT t1.product_id, t1.selling_rate, t1.with_effect_from FROM products_selling_rate t1 INNER JOIN (SELECT product_id, selling_rate, MAX(with_effect_from) AS wef FROM products_selling_rate WHERE with_effect_from <= CURRENT_TIMESTAMP GROUP BY product_id HAVING product_id={$product_id}) t2 ON t2.wef = t1.with_effect_from AND t1.product_id = {$product_id}";

        // $query = "SELECT selling_rate FROM products_selling_rate WHERE product_id = {$product_id} and with_effect_from <= CURRENT_TIMESTAMP order by with_effect_from DESC LIMIT 1";

        $query = "SELECT products.id, products_selling_rate.selling_rate, products_selling_rate.with_effect_from FROM products INNER JOIN products_selling_rate ON products_selling_rate.product_id = products.id INNER JOIN (SELECT product_id, MAX(with_effect_from) AS wef FROM (SELECT * FROM products_selling_rate WHERE with_effect_from <= CURRENT_TIMESTAMP) AS temp GROUP BY product_id) AS max_date_table ON max_date_table.product_id = products_selling_rate.product_id AND products_selling_rate.with_effect_from = max_date_table.wef WHERE products.deleted = 0 AND products.id = {$product_id}";
        return $this->database->raw($query);
    }
    public function getProductsSoldByInvoiceID($invoice_id){
        $query = "SELECT products.*, products_selling_rate.selling_rate, products_selling_rate.with_effect_from FROM products INNER JOIN products_selling_rate ON products_selling_rate.product_id = products.id INNER JOIN (SELECT product_id, MAX(with_effect_from) AS wef FROM (SELECT * FROM products_selling_rate WHERE with_effect_from <= CURRENT_TIMESTAMP) AS temp GROUP BY product_id) AS max_date_table ON max_date_table.product_id = products_selling_rate.product_id AND products_selling_rate.with_effect_from = max_date_table.wef WHERE products.deleted = 0 AND products.id = (SELECT sales.product_id FROM sales WHERE sales.invoice_id = {$invoice_id})";
        $sales_query = "SELECT sales.quantity as sold_quantity, sales.discount from sales WHERE sales.invoice_id = {$invoice_id} and sales.deleted = 0";
        $productDetails = $this->database->raw($query);
        $productDetails = array_merge($productDetails, $this->database->raw($sales_query));
        return $productDetails;
    }
}
