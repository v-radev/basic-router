<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Basic router</title>
</head>
<body>

<a href="route/book">Show all books</a> <br/>
<a href="route/book/create">Show create new book</a> <br/>
<a href="route/book/35">Show single book</a> <br/>
<a href="route/book/35/edit">Edit single book</a> <br/>

<h3>Create new book</h3>
<form method="post" action="route/book">
	<input type="text" name="username" />
	<input type="password" name="password" />
	<input type="hidden" name="_method" value="post" />
	<input type="submit" name="send" value="Send" />
</form>

<h3>Update existing book</h3>
<form method="post" action="route/book/35">
	<input type="text" name="username" />
	<input type="password" name="password" />
	<input type="hidden" name="_method" value="put" />
	<input type="submit" name="send" value="Send" />
</form>

<h3>Delete existing book</h3>
<form method="post" action="route/book/35">
	<input type="text" name="username" />
	<input type="password" name="password" />
	<input type="hidden" name="_method" value="delete" />
	<input type="submit" name="send" value="Send" />
</form>

</body>
</html>