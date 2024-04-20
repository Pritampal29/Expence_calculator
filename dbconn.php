<?php

$server= 'localhost';
$username= 'root';
$password= '';
$db_name= 'expences';

$conn = mysqli_connect($server,$username,$password,$db_name) or
die("DB Connection Error");

?>