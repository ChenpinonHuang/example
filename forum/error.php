<?php require ('includes/header.php');
    echo '<body>';
    $error = $_GET['error'];
    //print the result
    echo '<p>Sorry, there is an error! Please again!</p>';
    echo '<p>'.$error.'</p>';
    echo '<div><a href="show_friends.php">back to the community.</a></div>';
    echo '</body>';
    require('includes/footer.php'); ?>
