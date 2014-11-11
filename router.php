<?php

require_once "classes/Request.php";

//Get resource name
$resource = $_GET['resource'];

$r = new Request($resource);

if ( $r->notValid() ){
    //TODO send headers, load appropriate view
    switch ($r->errorCode) {
        case 404:
            echo "404 Not Found";
        break;
        case 405:
            echo "405 Method Not Allowed";
        break;
        default:
            echo "Error occurred, please try again.";
    }
    die;
}

echo $r->serve();