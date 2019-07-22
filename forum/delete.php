<?php
ob_start();
//grab the id of the user you want to delete
$user_id = $_GET['user_id'];
//connect
require('includes/db.php');
//set up our sql query
$sql = "DELETE FROM tbl_codehome WHERE user_id = :user_id;";
// prepare the query
$cmd = $conn->prepare($sql);
//bind
$cmd->bindParam(':user_id', $user_id);
//execute
$cmd->execute();
//close the connection
$cmd->closeCursor();
//send your user to the users page
//这里需要用到 buffer是因为要用到 header去重定位页面
header('location:successful.php?result=delete');
ob_flush();
?>
