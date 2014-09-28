<?php

class Book {


	/*
		GET  	/books 			 - show all view
		GET  	/books/create 	 - show create view
		POST 	/books 			 - create new book
		GET  	/books/{id}		 - show book id view
		GET  	/books/{id}/edit - show update view
		PUT  	/books/{id} 	 - update book id view
		DELETE  /books/{id}  	 - delete book id view
	 */

	protected static $_numParameters = ['1', '2'];

	public static function get( $request ){

		//TODO rewrite .htaccess to be able to accept '/book/create' and '/books/{id}/edit'
		//TODO figure out which one of these is wanted
		//GET  	/books 			 - show all view
		//GET  	/books/create 	 - show create view
		//GET  	/books/{id}		 - show book id view
		//GET  	/books/{id}/edit - show update view

		echo "GET BOOK";
		var_dump($request);

		$request = explode('/', $request);
		$numParameters = count($request);

		//If the request has more than allowed '/'
		if ( !in_array( $numParameters, static::$_numParameters )  ) {
			//TODO not the right exception
			throw new Exception("Error Processing Request");
		}

		//If you have only /route/book or /route/book/
		if ( $numParameters == 1 || ($numParameters == 2 && empty($request[1]) ) ) {
			echo "GET ALL BOOKS";
		} elseif ( $numParameters == 2 && !empty($request[1]) ) {
			echo "GET BOOK {$request[1]}";
		}

		die;	
	}

	public static function post( $request ){
		echo "POST BOOK";
		var_dump($request);
		die;	
	}

	public static function put( $request ){
		echo "PUT BOOK";
		var_dump($request);
		die;	
	}
}