<?php
  error_reporting(E_ALL);
  ini_set('display_errors',1);
  
  
  
  
  if ($_POST["name"] == '')
    header("Location:interface.php?error=noName");
  else if ($_POST["length"] < 1)
    header("Location:interface.php?error=lengthLow");
  else
  {  
    //the following four variable declarations were copied directly from my ONID database page for convenience.
    //They are the four values necessary to initialize a mysqli object to point to my ONID database
    $dbhost = 'oniddb.cws.oregonstate.edu';
    $dbname = 'gamblinr-db';
    $dbuser = 'gamblinr-db';
    $dbpass = 'A2q1yggF4h459bU9';
    /*
    The following line was copied from php.net.
    It is the initialization of a new mysqli object, which is how php interacts with mysql
    databases. When I pass in the four necessary string values, my username, my password, the hostname, and the
    database name. This object will represent my ONID database in the code and I will be able to manipulate it.
    The connect_errno method will allow me to make sure I am properly connected to my database
    */
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    if (!($stmt = $mysqli->prepare("INSERT INTO VideoTable(name, category, length) VALUES (?, ?, ?)"))) {
      echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
  
    if (!$stmt->bind_param("ssd", $_POST["name"], $_POST["category"], $_POST["length"])) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    
    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $stmt->close();
    header("Location:interface.php");
  }
  

