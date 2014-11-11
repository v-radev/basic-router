<?php

require_once "BaseController.php";

class BooksController extends BaseController {

	/*
		GET  	/book 			 - show all view       - index()
		GET  	/book/create 	 - show create view    - create()
		POST 	/book 			 - create new book     - store()
		GET  	/book/{id}		 - show book id view   - show($id)
		GET  	/book/{id}/edit  - show update view    - edit($id)
		PUT  	/book/{id} 	     - update book id view - update($id)
		DELETE  /book/{id}  	 - delete book id view - delete($id)
	 */

	public static function index(){
        return "Show all books view.";
    }
	public static function create(){
        return "Show create new book view.";
    }
	public static function store(){
        return "Write book to DB.";
    }
	public static function show($id){
        return "Show book with id: {$id}";
    }
	public static function edit($id){
        return "Edit book with id: {$id}";
    }
	public static function update($id){
        return "Update book with id: {$id}";
    }
	public static function delete($id){
        return "Delete book with id: {$id}";
    }
}