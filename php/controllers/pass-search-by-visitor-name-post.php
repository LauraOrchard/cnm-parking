<!DOCTYPE html>
<html>
	<head>
		<meta> charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" />

		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
		<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
		<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"></script>
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<title>Search for parking pass by user</title>
	</head>
	<body>
		<h1>Search for parking pass by user</h1>
		<form method="post" action="pass-search-by-visitor-name-post.php">
		<label for="fullName">Full Name</label>
		<input type="text" id="fullName" name="fullname"/><br />
		<button id="fullNameSubmit" type="submit">Search</button>
		</form>
	</body>
</html>