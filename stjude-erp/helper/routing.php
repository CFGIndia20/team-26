
<?php
require_once 'init.php';
if(isset($_POST['add_category']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('category')->addCategory($_POST);

        switch ($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, "Add Category Error!");
                Util::redirect("manage-category.php");
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, "Add Category Success!");
                Util::redirect("manage-category.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('category')->getValidator()->errors()));
                Util::redirect("add-category.php");
                break;
        }
    }
    else //Avoid useing else idhar aaya toh if hua hi nai toh hi aayega warna if mai kidhar bhi redirect ho jayega na, butfor a saver side daala hai else.
    {
        Session::setSession("csrf", "CSRF Error");
        Util::redirect("manage-category.php"); //Need to change this, actually we will be redirecting to some error page indicating Unauthorized access
    }
}

if(isset($_POST['page']))
{
    // $_POST['search']['value']
    // $_POST['start']
    // $_POST['length']
    // $_POST['draw']
    // Util::dd($_POST);
    if($_POST['page'] == 'manage_category')
    {
        $dependency = "category";
    }
    elseif($_POST['page'] == 'manage_product')
    {
        $dependency = "product";
    }
    elseif($_POST['page'] == 'manage_customer')
    {
        $dependency = "customer";
    }
    elseif($_POST['page'] == 'manage_supplier')
    {
        $dependency = "supplier";
    }
    $search_parameter = $_POST['search']['value'] ?? null;
    $order_by = $_POST['order'] ?? null;
    $start = $_POST['start'];
    $length = $_POST['length'];
    $draw = $_POST['draw'];
    $di->get($dependency)->getJSONDataForDataTable($draw, $search_parameter, $order_by, $start, $length);
}

if(isset($_POST['fetch']))
{
    if($_POST['fetch'] == 'category')
    {
        $category_id = $_POST['category_id'];
        $result = $di->get('category')->getCategoryByID($category_id, PDO::FETCH_ASSOC);
        echo json_encode($result[0]);
    }
}

if(isset($_POST['editCategory']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('category')->update($_POST, $_POST['category_id']);
        
        switch ($result)
        {
            case UPDATE_ERROR:
                Session::setSession(UPDATE_ERROR, "Update Category Error!");
                Util::redirect("manage-category.php");
                break;
            case UPDATE_SUCCESS:
                Session::setSession(UPDATE_SUCCESS, "Updated Category Success!");
                Util::redirect("manage-category.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('category')->getValidator()->errors()));
                Util::redirect("manage-category.php");
                break;
        }
    }
    else
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-category.php");
    }
}

if(isset($_POST['deleteCategory']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('category')->delete($_POST['record_id']);
        
        switch ($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, "Deleted Category Error!");
                Util::redirect("manage-category.php");
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, "Deleted Category Success!");
                Util::redirect("manage-category.php");
                break;
        }
    }
    else
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-category.php");
    }
}

if(isset($_POST['add_customer']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('customer')->addCustomer($_POST);

        switch ($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, "Add Customer Error!");
                Util::redirect("manage-customer.php");
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, "Add Customer Success!");
                Util::redirect("manage-customer.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('customer')->getValidator()->errors()));
                Util::redirect("add-customer.php");
                break;
        }
    }
    else 
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-customer.php"); 
    }
}

if(isset($_POST['editCustomer']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('customer')->update($_POST, $_POST['customer_id']);
        
        switch ($result)
        {
            case UPDATE_ERROR:
                Session::setSession(UPDATE_ERROR, "Update Customer Error!");
                Util::redirect("manage-customer.php");
                break;
            case UPDATE_SUCCESS:
                Session::setSession(UPDATE_SUCCESS, "Updated Customer Success!");
                Util::redirect("manage-customer.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('customer')->getValidator()->errors()));
                Util::redirect("manage-customer.php");
                break;
        }
    }
    else
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-customer.php");
    }
}

if(isset($_POST['deleteCustomer']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('customer')->delete($_POST['record_id']);
        
        switch ($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, "Deleted Customer Error!");
                Util::redirect("manage-customer.php");
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, "Deleted Customer Success!");
                Util::redirect("manage-customer.php");
                break;
        }
    }
    else
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-customer.php");
    }
}

if(isset($_POST['add_supplier']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('supplier')->addSupplier($_POST);
        switch ($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, "Add Supplier Error!");
                Util::redirect("manage-supplier.php");
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, "Add Supplier Success!");
                Util::redirect("manage-supplier.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('supplier')->getValidator()->errors()));
                Util::redirect("add-supplier.php");
                break;
        }
    }
    else 
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-supplier.php"); 
    }
}

if(isset($_POST['editSupplier']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('supplier')->update($_POST, $_POST['supplier_id']);
        
        switch ($result)
        {
            case UPDATE_ERROR:
                Session::setSession(UPDATE_ERROR, "Update Supplier Error!");
                Util::redirect("manage-supplier.php");
                break;
            case UPDATE_SUCCESS:
                Session::setSession(UPDATE_SUCCESS, "Updated Supplier Success!");
                Util::redirect("manage-supplier.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('supplier')->getValidator()->errors()));
                Util::redirect("manage-supplier.php");
                break;
        }
    }
    else
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-supplier.php");
    }
}

if(isset($_POST['deleteSupplier']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('supplier')->delete($_POST['record_id']);
        
        switch ($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, "Deleted Supplier Error!");
                Util::redirect("manage-supplier.php");
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, "Deleted Supplier Success!");
                Util::redirect("manage-supplier.php");
                break;
        }
    }
    else
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-supplier.php");
    }
}

if(isset($_POST['add_product']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('product')->addProduct($_POST);

        switch ($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, "Add Product Error!");
                Util::redirect("manage-product.php");
                break;
            case ADD_SUCCESS:
                Session::setSession(ADD_SUCCESS, "Add Product Success!");
                Util::redirect("manage-product.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('product')->getValidator()->errors()));
                Util::redirect("add-product.php");
                break;
        }
    }
    else 
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-product.php"); 
    }
}

if(isset($_POST['editProduct']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('product')->update($_POST, $_POST['product_id']);
        // Util::dd($result);
        switch ($result)
        {
            case UPDATE_ERROR:
                Session::setSession(UPDATE_ERROR, "Update Product Error!");
                Util::redirect("manage-product.php");
                break;
            case UPDATE_SUCCESS:
                Session::setSession(UPDATE_SUCCESS, "Updated Product Success!");
                Util::redirect("manage-product.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('product')->getValidator()->errors()));
                Util::redirect("manage-product.php");
                break;
        }
    }
    else
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-product.php");
    }
}

if(isset($_POST['deleteProduct']))
{
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('product')->delete($_POST['record_id']);
        
        switch ($result)
        {
            case DELETE_ERROR:
                Session::setSession(DELETE_ERROR, "Deleted Product Error!");
                Util::redirect("manage-product.php");
                break;
            case DELETE_SUCCESS:
                Session::setSession(DELETE_SUCCESS, "Deleted Product Success!");
                Util::redirect("manage-product.php");
                break;
        }
    }
    else
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("manage-product.php");
    }
}
// Anonymous Routings Ajax Routings To Fetch Data
if(isset($_POST['getCategories'])) {
    echo json_encode($di->get('category')->all()); 
}

if(isset($_POST['getProductsByCategoryID'])){
    $category_id = $_POST['categoryID'];
    echo json_encode($di->get('product')->getProductsByCategoryID($category_id));
}

if(isset($_POST['getSellingRateByProductID'])){
    $product_id = $_POST['productID'];
    echo json_encode($di->get('product')->getSellingRateByProductID($product_id));
}

if(isset($_POST['getCustomerWithEmail'])){
    $email_id = $_POST['email_id'];
    echo json_encode($di->get('customer')->getCustomerWithEmail($email_id));
}

if(isset($_POST['add_sales'])){
    if(Util::verifyCSRFToken($_POST))
    {
        $result = $di->get('sales')->addSales($_POST);
        // Util::dd($result);
        switch ($result)
        {
            case ADD_ERROR:
                Session::setSession(ADD_ERROR, "Add Sales Error!");
                Util::redirect("add-sales.php");
                break;
            case VALIDATION_ERROR:
                Session::setSession('validation', "Validation Error");
                Session::setSession('old', $_POST);
                Session::setSession('errors', serialize($di->get('sales')->getValidator()->errors()));
                Util::redirect("add-sales.php");
                break;
        }
    }
    else 
    {
        Session::setSession("csrf", "CSRF ERROR");
        Util::redirect("add-sales.php"); 
    }
}