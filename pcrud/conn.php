<?php

 $server = "localhost";
 $username = "root";
 $password = "";
 $dbname = "me_ajex";

 $conn = mysqli_connect($server, $username, $password, $dbname);

 if(!$conn){
    die("error while connecting". mysqli_connect_error());
 }

?>