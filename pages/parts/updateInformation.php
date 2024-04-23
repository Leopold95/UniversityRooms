<?php
require(__DIR__ . "/../../scripts/DataBase.php");
use scripts\DataBase;

$database = new DataBase();

$variable = $_POST["roomid"];

$room = $database->GetRoomById($variable);
?>

<div class="room-short-info-row">
    <div class="row">
        <div class="col">
            <a>Назва корпусу: </a>
            <br>
            <a><?php echo $room->box;?></a>
        </div>
        <div class="col">
            <a>Місткість: </a>
            <br>
            <a><?php echo $room->capacity;?></a>
        </div>
        <div class="col">
            <a>Розмір: </a>
            <br>
            <a><?php echo $room->area;?></a>
        </div>
    </div>
</div>














