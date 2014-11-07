<?php

require_once "classes/Request.php";

//Get resource name
$resource = $_GET['resource'];
$request = substr($_SERVER['REQUEST_URI'], stripos($_SERVER['REQUEST_URI'], $resource));

var_dump( $resource );//TODO
var_dump( $request );//TODO
die;

$r = new Request($request);

if ( $r->notValid() ){
    echo "NOT VALID";
    die;
}

$r->serve();