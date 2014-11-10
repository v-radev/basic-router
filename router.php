<?php

require_once "classes/Request.php";

//Get resource name
$resource = $_GET['resource'];

$r = new Request($resource);

if ( $r->notValid() ){
    echo "NOT VALID";
    die;
}

$r->serve();