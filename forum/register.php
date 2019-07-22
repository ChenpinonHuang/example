<?php
require_once('includes/header.php'); ?>

<main class="container">
	<h1>User Registration</h1>
	<form method="post" action="save-registration.php">
		<fieldset class="form-group">
			<label for="username" >Email:</label>
			<input name="username" required type="email" />
		</fieldset>
		<fieldset class="form-group">
			<label for="password" >Password:</label>
			<input name="password" required type="password" />
		</fieldset>
		<fieldset class="form-group">
			<label for="confirm" >Confirm Password:</label>
			<input name="confirm" required type="password" />
		</fieldset>
		<button type="submit">Submit</button>
	</form>
</main>

<?php require_once('includes/footer.php'); ?>
