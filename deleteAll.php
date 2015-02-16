<?php
  error_reporting(E_ALL);
  ini_set('display_errors',1);
  $dbhost = 'oniddb.cws.oregonstate.edu';
  $dbname = 'gamblinr-db';
  $dbuser = 'gamblinr-db';
  $dbpass = 'A2q1yggF4h459bU9';
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  
  $mysqli->query("DELETE FROM Inventory");
  $mysqli->close();
  header("Location:interface.php");