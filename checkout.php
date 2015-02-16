<?php
  error_reporting(E_ALL);
  ini_set('display_errors',1);
  if (!isset($_POST["checkout"]))
    header("Location:interface.php");
  else
  {
    $dbhost = 'oniddb.cws.oregonstate.edu';
    $dbname = 'gamblinr-db';
    $dbuser = 'gamblinr-db';
    $dbpass = 'A2q1yggF4h459bU9';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    $rowToChange = $_POST["checkout"];
    $result = $mysqli->query("SELECT rented FROM VideoTable WHERE id = $rowToChange");
    $result = $result->fetch_row();
    $oldValue = $result[0];
    
    if($oldValue == 1)
      $newValue = 0;
    else
      $newValue = 1;
    $mysqli->query("UPDATE VideoTable SET rented = $newValue WHERE id = $rowToChange");
    header("Location:interface.php");
  }