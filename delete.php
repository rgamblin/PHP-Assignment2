<?php
  error_reporting(E_ALL);
  ini_set('display_errors',1);
  if (!isset($_POST["deleted"]))
    header("Location:interface.php");
  else
  {
    $dbhost = 'oniddb.cws.oregonstate.edu';
    $dbname = 'gamblinr-db';
    $dbuser = 'gamblinr-db';
    $dbpass = 'A2q1yggF4h459bU9';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    $rowToDelete = $_POST["deleted"];
    $mysqli->query("DELETE FROM VideoTable WHERE id = $rowToDelete");
    header("Location:interface.php");
  }