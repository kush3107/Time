<?php
$connection = new mysqli('localhost','root','','time_converter');
if($connection->connect_error){
    echo $connection->error;
    die;
}
?>