<?php

namespace AP33\Models;

use AP33\Core\Database;

class Tareas
{
    private $db;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->db = $db;
    }

    public function getTareas($idTarea = null)
    {
        if ($idTarea == null) {
            $sqlSentence = "SELECT * FROM tareas";
        } else {
            $sqlSentence = "SELECT * FROM tareas WHERE id = $idTarea";
        }
        $result = $this->db->executeSQL($sqlSentence);
        return $result;
    }
}