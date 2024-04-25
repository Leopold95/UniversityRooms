<?php
//simple script for try loading new room image
require (__DIR__."/../scripts/DataBase.php");

use scripts\DataBase;

$acton = $_GET["action"];
$roomId = $_GET["roomID"];
$imageUrl = $_GET["imageURL"];

if($acton == "add"){
    $dataBase = new DataBase();
    $result = $dataBase->addRoomImage($roomId, $imageUrl);
    $responceToClient = array(
        "uploadStatus" => "$result"
    );
    echo json_encode($responceToClient);
}
else{
    $dataBase = new DataBase();
    $result = $dataBase->RemoveRoomImage($imageUrl);
    $responceToClient = array(
        "uploadStatus" => "$result"
    );
    echo json_encode($responceToClient);
}
?>