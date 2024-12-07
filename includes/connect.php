<?php
$con = mysqli_connect("localhost", "root", "", "computer island");
if (!$con) {
    die("Connection failed: ". mysqli_connect_error());
}
?>