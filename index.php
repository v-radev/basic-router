<?php

$formAttributes = [];

?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Basic router</title>
</head>
<body>

<form method="post" action="route/book">
	<input type="text" name="username" />
	<input type="password" name="password" />
	<input type="hidden" name="_method" value="put" />
	<input type="submit" name="send" value="Send" />
</form>

</body>
</html>