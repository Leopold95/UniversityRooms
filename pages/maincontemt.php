<?php

use scripts\DataBase;
require ("scripts/DataBase.php");
?>

<?php
    $database = new DataBase();
    $rooms = $database->GetRooms();
?>

<main>

    <div id="information"></div>

    <div class="container-fluid">
        <?php
        foreach ($rooms as $room) {
            $block_number_room = $room->number_room;
            $block_room_id = $room->id_room;
            $block_specialization = $room->specialization;
            include ("pages/parts/roomline.php");
            echo "<br>";
        }
        ?>
    </div>
</main>