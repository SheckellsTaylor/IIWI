<?php


function Connect()
{
 $dbhost = "localhost";
 $dbuser = "justpostit";
 $dbpass = "justpostit";
 $dbname = "justpostit";

 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);

 return $conn;
}

?>
