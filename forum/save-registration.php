<?php
//require header

require('includes/header.php');

//grab the info from the form and store in variables

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

//set up a flag variable
$ok = true;

// check that the user filled everything out and the passwords match (server-side validation)

if(empty($username)) {
  $ok = false;
  echo "<p> Username is required </p>";
}

if(empty($password)) {
  $ok = false;
  echo "<p> Password is required </p>";
}

if($password != $confirm) {
  $ok = false;
  echo "<p> Your passwords don't match, friend! </p>";
}

//if everything is cool, go ahead and save to the users table

if($ok === true) {

  // hash the password so its not stored as plain text
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  //connect to the database
  require("includes/db.php");

  // set up query to add new record

  $sql = "INSERT INTO tbl_user (user_name, password) VALUES (:user_name, :password)";

  //prepare

  $cmd = $conn->prepare($sql);

  //bind

  $cmd->bindParam(':user_name', $username);
  $cmd->bindParam(':password', $hashed_password);

  //execute

  $cmd->execute();

  //disconnect from the db

  $cmd->closeCursor();

  header("Location:index.php");

}

//require footer file
require('includes/footer.php');
?>
