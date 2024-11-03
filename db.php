<?php
// Open Connection

$con = mysqli_connect('localhost', 'root', '', 'hw-info');

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}
mysqli_set_charset($con,"utf8");



?>

