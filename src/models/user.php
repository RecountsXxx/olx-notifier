<?php

namespace models;
use mysqli;
use MyThread;

require '../database/check_match_record.php';
require '../services/parser.php';
require '../mailer/mail.php';
require '../services/checker.php';

class User
{
    private $email;
    private $olx_url = [];
    private $current_price;
    private $olx_name;
    private $id;
    private $conn;

    public function __construct($email, $olx_url)
    {
        include '../database/seed.php';

        $this->email = $email;
        $this->olx_url = $olx_url;

        $this->current_price = get_current_price_from_url($this->olx_url);
        $this->olx_name = get_name_from_url($this->olx_url);

        $this->conn = $this->connect();

    }

    public function subscribe()
    {
        $email = $this->conn->real_escape_string($this->email);
        $olx_url = $this->conn->real_escape_string($this->olx_url);
        $current_price = $this->conn->real_escape_string($this->current_price);
        $olx_name = $this->conn->real_escape_string($this->olx_name);

        if (check_exists_url($olx_url, $email, $this->conn)) {
            die('Вы уже подписаны на это обьявление');
        }
        send_subscribe_email($email,$current_price,$olx_url,$olx_name);

        $insertQuery = 'INSERT INTO subscribe_table (email, olx_url, current_price, olx_name) VALUES (?, ?, ?,?)';
        $insertStmt = $this->conn->prepare($insertQuery);

        if ($insertStmt === false) {
            die("Error in prepared statement: " . $this->conn->error);
        }

        $insertStmt->bind_param('ssss', $email, $olx_url, $current_price, $olx_name);
        $result = $insertStmt->execute();

        if ($result === false) {
            die("Error in execution: " . $insertStmt->error);
        }

        $insertStmt->close();
        $this->conn->close();

        echo "Подписка на " . $email . ' успешно подключена.';

        $thread = new MyThread($email,$olx_url,$olx_name,$current_price);
        $thread->run();
    }


    private function connect()
    {
        $config = include('../database/config.php');

        $host = $config['DB_HOST'];
        $db_name = $config['DB_NAME'];
        $username = $config['DB_USER'];
        $password = $config['DB_PASSWORD'];
        $port = $config['DB_PORT'];

        $conn = new mysqli($host, $username, $password, $db_name, $port);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}