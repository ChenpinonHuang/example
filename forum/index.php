<?php require('includes/auth.php');
      require('includes/header.php'); ?>
<body>
<?php

  //initializing variables and set to null initially

  $user_id = null;
  $user_name = null;
  $email = null;
  $location = null;
  $skills = null;

  if(!empty($_GET['user_id']) && (is_numeric($_GET['user_id']))) {

    // grab the user id

    $user_id = $_GET['user_id'];

    // connect to the db

    require('includes/db.php');

    //set up an SQL query

    $sql = "SELECT * FROM tbl_codehome WHERE user_id = :user_id;";

    //prepare

    $cmd = $conn->prepare($sql);

    //bind

    $cmd->bindParam(':user_id', $user_id);

    //execute

    $cmd->execute();

    //use fetchAll to store

    $users = $cmd->fetchAll();

    //loop through using a foreach loop

    foreach($users as $user) {
      $user_name = $user['user_name'];
      $email = $user['email'];
      $location = $user['location'];
      $skills = $user['skills'];

    }

    $cmd->closeCursor();

  }

?>
 <div class="container">
    <header class="user_information">
      <h1 class="head_title"> Developer Information </h1>
    </header>

    <main>
       <div class="row">
          <section class="welcome">
            <h2> Welcome to code home! </h2>
            <p> Here is the home land for all the developers. </p>
          </section>

          <section class="showcase">
            <input class="MyButton" type="button" value="Make some friends? May be there are some guys you have already known~" onclick="window.location.href='show_friends.php'" />
            <form method="post" action="save_info.php" class="form-check">

             <div class="form-group">
               <input type="text" name="user_name" required placeholder="User name" class="form-control" value="<?php echo $user_name; ?>">
             </div>

             <div class="form-group">
               <input type="email" name="email" required placeholder="Your Email address" class="form-control" value="<?php echo $email; ?>">
             </div>

             <div class="form-group">
               <input type="text" name="location" required placeholder="Where are you living?" class="form-control" value="<?php echo $location; ?>">
             </div>

             <div class="form-group">
               <input type="text" name="skills" required placeholder="What are you good at?" class="form-control" value="<?php echo $skills; ?>">
           </div>

           <!-- adding a hidden fom field with the user_id -->
           <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">

          <input type="submit" value="Apply your account now!" class="submit">
         </form>
       </section>

        <section class="search_window">
          <form action="search-improved.php" method="get">
            <input type="text" name="search" placeholder="Search someone you know?" required>
            <input type="submit" value="SEARCH IT!">
          </form>
        </section>

      </div><!--end row -->
    </main>
    <?php require('includes/footer.php'); ?>
