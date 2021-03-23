<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//conectarse a la bd

$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setdb($db);