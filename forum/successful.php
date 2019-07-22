<?php require ('includes/header.php');
    echo '<body>';
    $result = $_GET['result'];
    $action='';
    if($result=='delete'){
      echo $action = 'Delete the user information completely!';
    }else if($result=='add'){
      echo $action='Register successfully!';
    }else if($result=="update"){
      echo $action='Update user information successfully!';
    }
    //print the result
    echo '<p>Congulation!' . $action . '</p>';
    echo '<div><a href="show_friends.php">back to the community.</a></div>';
    echo '</body>';
    require('includes/footer.php'); ?>
