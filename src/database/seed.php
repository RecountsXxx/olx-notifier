<?php

$config = require('../database/config.php');

$host = $config['DB_HOST'];
$db_name = $config['DB_NAME'];
$username = $config['DB_USER'];
$password = $config['DB_PASSWORD'];
$port = $config['DB_PORT'];
$conn = new mysqli($host, $username, $password, $db_name,$port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableName = 'subscribe_table';

$query = "SHOW TABLES LIKE '$tableName'";
$result = $conn->query($query);

if ($result === false) {
    die("Error in query: " . $conn->error);
}

if ($result->num_rows <= 0) {
    $conn->query('CREATE TABLE `olx_db`.`subscribe_table` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `olx_url` VARCHAR(255) NOT NULL,
    `olx_name` VARCHAR(255) NOT NULL,
    `current_price` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;');
}