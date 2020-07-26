<?php
ini_set('display_errors', 'On'); //maine ini mai changes kiya toh saare projects mai change ho jayega, yeh aapko sirf iss project nai changes karke dega.
error_reporting(E_ALL); //this is ki tu saare errors de mereko, how php goes on after warning humko yeh nai chahiye idhar, isliye we said ki E_ALL (all errrors) ka reporting kar.
session_start();

require_once __DIR__ ."/requirements.php";

$di = new DependencyInjector();
$di->set('config', new Config());
$di->set('database', new Database($di));
$di->set('hash', new Hash());
$di->set('hash', new Util($di));
$di->set('error_handler', new ErrorHandler());
$di->set('validator', new Validator($di));

$di->set('category', new Category($di));
$di->set('product', new Product($di));
$di->set('address', new Address($di));
$di->set('customer', new Customer($di));
$di->set('supplier', new Supplier($di));
$di->set('sales', new Sales($di));
$di->set('invoice', new Invoice($di));


require_once __DIR__ . "/constants.php";
