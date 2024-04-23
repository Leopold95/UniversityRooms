<?php
use scripts\DataBase;
require (__DIR__ . "/../../scripts/DataBase.php");

$useSearch = $_POST["useSearch"];
$roomNumber = $_POST["roomNum"];
$kafedraTxt = $_POST["kafedraTxt"];

if($useSearch){
    defaultShowcase();
}
else{
    showWithSearch($roomNumber, $kafedraTxt);
}

function defaultShowcase()
{
    $database = new DataBase();
    $rooms = $database->getRooms();

    foreach ($rooms as $room) {
        $block_number_room = $room->number_room;
        $block_room_id = $room->id_room;
        $block_specialization = $room->specialization;
        include (__DIR__ . "/../../pages/parts/roomline.php");
    }
}

function showWithSearch($roomNum, $kafedraTxt)
{
    echo $roomNum;
}

?>





