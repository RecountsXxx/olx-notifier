<?php
class MyThread {
    private $url;
    private $email;
    private $name;

    private $price;
    public function __construct($email, $url,$name,$price)
    {
        $this->email = $email;
        $this->url = $url;
        $this->name = $name;
        $this->price = $price;

    }

    public function run() {
        while (true) {
            $this->start_subscription();
            sleep(60);
        }
    }

    private function start_subscription()
    {
        $current_price = get_current_price_from_url($this->url);

        $conn = $this->connect();
        $sqlUpdate = "UPDATE subscribe_table SET current_price = $current_price WHERE url = '$url'";

        while(true){
            sleep(30);
            $current_price = get_current_price_from_url($this->url);

            $current_price = intval(str_replace(' грн.', '', $current_price));
            $this->price = intval(str_replace(' грн.', '', $this->price));

            if($current_price != $this->price){
                send_subscribe_email($this->email,$current_price,$this->url,$this->name);


                $sql = 'SELECT current_price FROM subscribe_table WHERE url = ?';
                $stmt = $conn->prepare($sql);

                if ($stmt === false) {
                    die("Error in prepared statement: " . $conn->error);
                }

                $stmt->bind_param('s', $this->url);
                $stmt->execute();
                $stmt->bind_result($this->price);
                $stmt->fetch();

                $conn->query($sqlUpdate);
                $stmt->close();
                $conn->close();
            }
        }
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
?>

