<?php

namespace App\Models;

use App\Core\Database;

class Train
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function searchTrains($source, $destination)
    {
        $sql = "SELECT * FROM trains WHERE source = ? AND destination = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$source, $destination]);
        return $stmt->fetchAll();
    }
}
