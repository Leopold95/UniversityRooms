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

    echo implode($rooms);

    ?>
</main>