<?php
try{
  ob_start();
  //require the db file
  require_once("includes/db.php");

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM tbl_user WHERE username = :username;";

  $cmd = $conn->prepare($sql);
  $cmd->bindParam(':username', $username);

  $cmd->execute();

  $user = $cmd->fetch();

  if ($user && password_verify($password, $user['password'])) {
    //start the session
    session_start();
    //set up the session variable and assign it the value of the user id stored in the table
    $_SESSION['user_id'] = $user['user_id'];
    //send the user to the index page
    header('location:index.php');
  }
  else {
    echo "invalid";
    exit();
  }
}
catch(Exception $e){
  echo $e;
}

$cmd->closeCursor();

ob_flush();
?>
