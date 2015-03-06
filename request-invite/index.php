<?php
// require the header file
$title = "Parking Pass Invite";
$headerTitle = "Request a parking pass invite";
require_once("../php/lib/header.php");

// start a PHP session for CSRF protection
session_start();

// require CSRF protection
require_once("../php/lib/csrf.php");
?>
	<form id="request-invite" method="post" action="../php/controllers/request-invite-post.php" novalidate="novalidate">
		<?php echo generateInputTags(); ?>
		<div class="form-group">
			<label for="emailAddress">Email:</label>
			<input type="text" class="form-control email" id="emailAddress" name="emailAddress" size="128" maxlength="128" placeholder="name@example.com">
		</div>
		<div class="form-group">
			<label for="firstName">First Name:</label>
			<input type="text" class="form-control name" id="firstName" name="firstName" size="128" maxlength="128" placeholder="First Name">
		</div>
		<div class="form-group">
			<label for="lastName">Last Name:</label>
			<input type="text" class="form-control name" id="lastName" name="lastName" size="128" maxlength="128" placeholder="Last Name">
		</div>
		<div class="form-group">
			<label for="phone">Phone:</label>
			<input type="text" class="form-control phone" id="phone" name="phone" size="24" maxlength="24" placeholder="Phone Number">
		</div>
		<button type="submit" id="submitRequest" name="submitRequest" class="btn btn-primary">Send Request</button>
	</form>
	<p id="outputArea"></p>

	<!--	require the footer file-->
<?php require_once("../php/lib/footer.php"); ?>