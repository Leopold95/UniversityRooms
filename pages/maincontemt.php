<?php

use scripts\DataBase;

require ("scripts/DataBase.php");
?>


<main>
    <?php
    $database = new DataBase();
    if($database->isConnected)
        echo "connected";

    $rooms = $database->GetRooms();

    foreach ($rooms as $room) {
        //$inf = $room->getInfo();

        $block_id = $room->id_room;
        include ("pages/parts/roomline.php");
        echo "<br>";
    }

    ?>
</main>