<?php require('includes/auth.php');
      require('includes/header.php'); ?>
<body>
<?php
// store the form inputs in variables
$user_name = filter_input(INPUT_POST, 'user_name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$location =  filter_input(INPUT_POST, 'location');
$skills = filter_input(INPUT_POST, 'skills');

//add the user id in case we are editing
$user_id = null;
$user_id = filter_input(INPUT_POST, 'user_id');

// set up a flag variable & set to true initially
$ok = true;

/* checking that the user has provided info for each piece of information, set flag variable to false if not */

if(empty($user_name)) {
  $ok = false;
  echo "<p> Name is required! </p>";
}

if(empty($email)) {
  $ok = false;
  echo "<p> Email is required! </p>";
}

if(empty($location)) {
  $ok = false;
  echo "<p> Location is required!  </p>";
}

if(empty($skills)) {
  $ok = false;
  echo "<p> Review is required!</p>";
}
if($ok){
  echo 7;
}else{
  echo 8;
}

//check that the email address is a properly formatted email
if($email === FALSE) {
  $ok = false;
  echo "<p> You need a properly formatted email </p>";
}

if($ok === TRUE) {
    try{
      require('includes/db.php');
      //set up a variable to store what action the user just did
      $result='';
      //this means we are updating a current record
      if(!empty($user_id)) {
        $sql = "UPDATE tbl_codehome SET user_name = :user_name, email = :email, location = :location, skills = :skills WHERE user_id = :user_id;";
        $result = 'update';
      }
      //this means a new record added
      else {
        // set up an SQL command to save the new user
        $sql = "INSERT INTO tbl_codehome (user_name, email, location, skills) VALUES (:user_name,:email, :location, :skills);";
        $result = 'add';
      }
      // set up a command object
      $cmd = $conn->prepare($sql);

      // fill the placeholders with the 4 input variables
      $cmd->bindParam(':user_name', $user_name);
      $cmd->bindParam(':email', $email);
      $cmd->bindParam(':location', $location);
      $cmd->bindParam(':skills', $skills);

      //if we are editing, we need to bindParam with :$user_id
      if(!empty($user_id)) {
        $cmd->bindParam(':user_id', $user_id);
      }

      // execute the insert
      $cmd->execute();
      // show message
      echo "The information of the user has been saved";
    }
    catch(Exception $e) {
      mail('hcb12586@gmail.com', 'Forum Database Error', $e);
      header('location:error.php');
    }
    // disconnecting
    $cmd->closeCursor();

    //return to this page automatically
    //$referer = $_SERVER['HTTP_REFERER']; //来路信息。就是上一页
    //header("Location: $referer");
    header("Location: successful.php?result=".$result);

}
?>
</body>
</html>
