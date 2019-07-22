<?php //connecting to the database
    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gcc200405662', 'gcc200405662', '3XoZWzsmL0');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
