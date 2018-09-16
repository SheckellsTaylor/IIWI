<?php

require 'connection.php';
$conn    = Connect();
$product    = $conn->real_escape_string($_POST['the_product']);
$cost   = $conn->real_escape_string($_POST['the_cost']);
$store    = $conn->real_escape_string($_POST['the_store']);
$query   = "INSERT into tb_cform (the_product,the_cost,the_store) VALUES('" . $product . "','" . $cost . "','" . $store . "')";
$success = $conn->query($query);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);

}

echo "Thank You For adding your finds! <br>";

$conn->close();

?>
