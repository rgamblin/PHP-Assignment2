<?php
  error_reporting(E_ALL);
  ini_set('display_errors',1);
  $dbhost = 'oniddb.cws.oregonstate.edu';
  $dbname = 'gamblinr-db';
  $dbuser = 'gamblinr-db';
  $dbpass = 'A2q1yggF4h459bU9';
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  $results;
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Assignment 6 RLG</title>
  </head>

  <body>
  <?php
    if(isset($_GET["error"]))
    {
      if($_GET["error"] == "noName")
        echo "Name is a required field";
    }
  ?>
    <section>
      <table border=1>
        <thead>
          <tr> <th> name <th> category <th> length <th> rented
        <tbody>
      <?php
        $results = $mysqli->query("SELECT id, name, category, length, rented FROM VideoTable ORDER BY id");
        for ($i = 0; $i < $results->num_rows; $i++)
        {
          echo "<tr> ";
          $current_results = $results->fetch_row();
          for ($j = 1; $j < 4; $j++)
          {
            $current_box = $current_results[$j];
            echo "<td> $current_box";
          }
          $currentID = $current_results[0];
          echo "<form method = \"post\" action = \"delete.php\"><td> <button type = \"submit\" name = \"deleted\" value = $currentID>Delete</button></form>";
        }
      ?>
      </table>
    </section>
    <section>
   
      <form action="addvideo.php" method="post">
      <label>Name <input type="text" name="name"></label>
      <label>Category <input type="text" name="category"></label>
      <label>length <input type="number" step="any" name="length"> minutes</label>
      
      <button type="submit">Add Video</button>
      </form>
    
    </section>
    
    <section>
      <form action="alterPrice.php" method="post">
        <label>Category <select name="updated">
        <?php
          $results = $mysqli->query("SELECT DISTINCT category FROM VideoTable ORDER BY id");
          
          for ($i=0; $i<$results->num_rows; $i++)
          {
            $current_option = $results->fetch_row()[0];
            echo "<option>$current_option</option>";
          }
          $mysqli->close();
        ?>
        </select></label>
        <label>Percentage <input type="number" name="price"></label>
        <button type="submit">Alter Prices</button>
      </form>
    </section>
    <section><form action="deleteAll.php"><button type="submit">Delete All Products</button></form></section>
  
  </body>
  
</html>