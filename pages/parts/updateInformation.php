<?php
require(__DIR__ . "/../../scripts/DataBase.php");
use \scripts\DataBase;


$database = new DataBase();

$variable = $_POST["needed"];

$room = $database->GetRoomById($variable);
echo  $room->getInfo();


















