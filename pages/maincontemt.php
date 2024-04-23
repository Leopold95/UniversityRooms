<?php

use scripts\DataBase;

require ("scripts/DataBase.php");
?>

<?php
    $database = new DataBase();
    $rooms = $database->GetRooms();
?>

<main>

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

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include ("scripts/buttonclicks.php");
?>