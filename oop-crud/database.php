<?php
class Database
{
    protected $host     = 'localhost';
    protected $db_name  = 'oop_latihan';
    protected $username = 'root';
    protected $password = '';
    protected $conn;

    public function getConnections()

    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Error Duaaaarr..." . $this->conn->connect_error);
        }
        return $this->conn;
    }
}
