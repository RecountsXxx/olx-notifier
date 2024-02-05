<?php

use models\User;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../models/user.php';

    $email = $_POST['email'];
    $olx_url = $_POST['olx_url'];

    $user = new User($email,$olx_url);
    $user->subscribe();
}