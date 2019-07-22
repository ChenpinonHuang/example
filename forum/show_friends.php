<?php require('includes/auth.php');
      require('includes/header.php'); ?>
<body>
  <div class="container">
    <header>
      <h1> A lot of programmer is coming! Is there any you friends?</h1>
    </header>
     <p>
       <input class="MyButton" type="button" value="Join us now!!!" onclick="window.location.href='index.php'" />
     </p>
    <?php
    // output buffering
    ob_start();
    try {
      //connect to the db
      require('includes/db.php');

      //set up SQL query

      $sql = "SELECT * FROM tbl_codehome;";

      //prepare

      $cmd = $conn->prepare($sql);

      //execute

      $cmd->execute();

      //store in movies using fetchAll() method
      $users = $cmd->fetchAll();

      // echoing out the top of our table
      echo "<table class='table table-striped'>
              <thead>
                <th> Name </th>
                <th> Email </th>
                <th> Location </th>
                <th> skills </th>
                <th> Edit? </th>
                <th> Delete? </th>
              </thead>
              <tbody>";

      //use foreach to loop through and populate the table

      foreach($users as $user) {
        echo '<tr><td>' . $user['user_name'] .'</td>
        <td>'. $user['email']. '</td>
        <td>' . $user['location'] . '</td>
        <td>' . $user['skills'] . '</td>
        <td><a href="index.php?user_id=' . $user['user_id'] . '"> Edit</td></a><td><a href="delete.php?user_id=' . $user['user_id']. '"onclick="return confirm (\'Are You Sure??? \');"> Delete</a></td></tr>';
      }

      echo '</tbody></table>';

      //close the database connection

      $cmd->closeCursor();

    }
    catch(Exception $e) {
      //send an email to the app admin
      mail('hcb12586@163.com', 'Register Problems', $e);
      // send user to index.php page
      header('location:error.php?error='.$e);
    }
    ob_flush();
    ?>
  </div>
<?php require('includes/footer.php'); ?>
