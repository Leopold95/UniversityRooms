<?php
use scripts\DataBase;
require (__DIR__ . "/../../scripts/DataBase.php");

$useSearch = $_POST["useSearch"] ?? false;

$database = new DataBase();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    baseGeneration($database);
}
//} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    // handle POST request
//}
//
//if($useSearch == false){
//    baseGeneration($database);
//}
else {
    $roomNumber = $_POST["roomNum"];
    $kafedra = $_POST["kafedra"];
    $boxTxt = $_POST["box"];

    $globalList = array();

    //room number search
    if($roomNumber != ""){
        $roomsByNumber = $database->GetRoomsByNumber($roomNumber);
        if($roomsByNumber == null)
            return;

        foreach ($roomsByNumber as $room) {
            if($room == null){
                break;
            }

            if(!isset($globalList[$room->id_room]))
                $globalList[$room->id_room] = $room;
        }
    }


    //room box search
    if($boxTxt != "-1"){
        $roomsByBox = $database->GetRoomsByBox($boxTxt);

        if($roomsByBox == null)
            return;

        foreach ($roomsByBox as $room) {
            if($room == null){
                break;
            }

            if(!isset($globalList[$room->id_room]))
                $globalList[$room->id_room] = $room;
        }
    }



    //room kafedra search
    if ($kafedra != "-1"){
        $roomsByKafedra = $database->GetRoomsByKafedraName($kafedra);
        foreach($roomsByKafedra as $roomm) {
            if($roomm == null){
                break;
            }

            if(!isset($globalList[$roomm->id_room]))
                $globalList[$roomm->id_room] = $roomm;
        }
    }


    //check empty search
    if(!$globalList)
        baseGeneration($database);

    //spawn searched elements
    foreach ($globalList as $room) {
        $block_number_room = $room->number_room;
        $block_room_id = $room->id_room;
        $block_specialization = $room->specialization;
        $block_kafName = $database->GetKafedraNameById($room->kafedra_id);
        require (__DIR__ . "/../../pages/parts/roomline.php");
    }
}

function baseGeneration($database)
{
    $roomsByNumber = $database->getRooms();

    foreach ($roomsByNumber as $room) {
        $block_number_room = $room->number_room;
        $block_room_id = $room->id_room;
        $block_specialization = $room->specialization;
        $block_kafName = $database->GetKafedraNameById($room->kafedra_id);
        require (__DIR__ . "/../../pages/parts/roomline.php");
    }
}




