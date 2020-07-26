<?php

define('BASEURL', $di->get('config')->get('base_url'));
define('BASEASSETS', BASEURL . "assets/");
define('BASEPAGES', BASEURL . "views/pages/");

define("ADD_SUCCESS", "add success");
define("ADD_ERROR", "add error");
define("UPDATE_SUCCESS", "Update success");
define("UPDATE_ERROR", "Update error");
define("DELETE_SUCCESS", "Delete success");
define("DELETE_ERROR", "Delete error");
define("VALIDATION_ERROR", "validation error");
