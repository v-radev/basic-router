<?php

//Get resource name
$resource = $_GET['resource'];
$request = substr($_SERVER['REQUEST_URI'], stripos($_SERVER['REQUEST_URI'], $resource));

$availableResources = ['book'];

$availableMethods = ['get', 'post', 'put', 'delete'];


if ( !in_array($resource, $availableResources) ) {
	http_response_code(404);
	die;
}


if ( file_exists("classes/{$resource}.class.php") ){
	require_once "classes/{$resource}.class.php";
}


if ( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'get' ) {
	$method = 'get';
	goto switchMethod;
}

if ( isset($_POST['_method']) && in_array($_POST['_method'], $availableMethods) ) {
	$method = $_POST['_method'];
	goto switchMethod;
}

//TODO not the right exception
throw new Exception("Error Processing Request");

switchMethod:
switch ( $method ) {
	case 'get':
	case 'post':
	case 'put':
	case 'delete':
		if ( method_exists($resource, $method) ) {
			call_user_func( [$resource, $method], $request);
		} else {
			//TODO not the right exception
			throw new Exception("Error Processing Request");
		}
	break;
	
	default:
		http_response_code(405);
		die();
		break;
}