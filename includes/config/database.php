<?php

function conectarDB() : mysqli {

    $db = new mysqli('localhost', 'root', '1902', 'bienesraices');


    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        exit;
    }

    return $db;

}

