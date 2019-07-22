<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
 <?php  $user_search = $_GET['search'];
 require('db.php');

 echo "<p> You searched for the following : $user_search </p>";

 // break it apart with the explode function

  $search_words = explode(' ', $user_search);

  //build our query
  //let's build the first part and store in a variable called query
  $query = "SELECT * FROM tbl_codehome WHERE ";

  //start to build the second part of our query
  $where = "";

  foreach($search_words as $word) {
    $where = $where . "user_name LIKE '%$word%' OR ";
  }
  //gets rid of the final four characters in last iteration of loop
  $where = substr($where, 0, strlen($where) - 4);

  $final_sql = $query . $where;

  //echo "<p> $final_sql </p>";

  $cmd = $conn->prepare($final_sql);
  $cmd->execute();

  $results = $cmd->fetchAll();

  //set up a table and loop through the results

  echo "<table>
        <thead>
          <th>User name</th>
          <th>Email</th>
          <th>Location</th>
          <th>Skill</th>
          </thead>
          <tbody>";

  foreach($results as $result) {
    echo "<tr>";
    echo "<td>" . $result['user_name'] . "</td>";
    echo "<td>" . $result['email'] . "</td>";
    echo "<td>" . $result['location'] . "</td>";
    echo "<td>" . $result['skills'] . "</td>";
    echo "</tr>";
  }

  echo "</tbody></table>";
  $cmd->closeCursor();

?>
</body>
</html>
