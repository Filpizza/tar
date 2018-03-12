<?php
include('db.php');
include('login.php');
$data = $_POST;
if(isset($data['do_sign'])) {
    $country = htmlspecialchars(trim($data['country']));
    $city = htmlspecialchars(trim($data['city']));
    $date = htmlspecialchars($data['date']);
    $college = htmlspecialchars(trim($data['college']));
    $interest = htmlspecialchars(trim($data['interst']));
    mysqli_query($link, "INSERT INTO `user` (`date`) VALUES ('$date') WHERE `id_login`= $name");
}