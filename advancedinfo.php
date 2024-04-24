<?php
require(__DIR__ . "/scripts/DataBase.php");
use scripts\DataBase;

$database = new DataBase();
$roomId = $_GET["roomid"];

$room = $database->GetRoomById($roomId);
$kafedra = $database->GetKafedraById($database->GetKafedraIdIntoRoom($roomId));
$images = $database->GetRoomImages($roomId);
?>


<!doctype html>
<html lang="ua">

<head>
    <title>Детальна інформація</title>
    <?php
    include ("pages/shared/head.php");
    ?>
    <link rel="stylesheet" href="css/advancedinfo.css"/>
</head>

<body>
<?php
include ("pages/shared/header.php");
?>

<main class="container-fluid">
    <div class="row">
        <div class="col">
            <table>
                <tr>
                    <th>Box</th>
                    <td><?php echo $room->box;?></td>
                </tr>
                <tr>
                    <th>Number</th>
                    <td><?php echo $room->number_room;?></td>>
                </tr>
                <tr>
                    <th>Kafedra</th>
                    <td><?php echo $kafedra->name_kafedra?></td>>
                </tr>
                <tr>
                    <th>Capacity</th>
                    <td><?php echo $room->capacity;?></td>>
                </tr>
                <tr>
                    <th>Area</th>
                    <td><?php echo $room->area;?></td>>
                </tr>
                <tr>
                    <th>Specialization</th>
                    <td><?php echo $room->specialization;?></td>>
                </tr>
                <tr>
                    <th>Inform</th>
                    <td><?php echo $room->Inform;?></td>>
                </tr>
                <tr>
                    <th>Korp</th>
                    <td><?php echo $room->Korp;?></td>>
                </tr>
                <tr>
                    <th>Educational</th>
                    <td><?php echo $room->educational;?></td>>
                </tr>
                <tr>
                    <th>Deleted</th>
                    <td><?php echo $room->deleted;?></td>>
                </tr>
            </table>
        </div>
        <div class="col d-flex align-items-center justify-content-center">
            <img class="img-preview" src="<?php echo $images[0] ?? "";?>" id="roomPreview">
        </div>
    </div>
    <div class="container mt-2 testimonial-group">
        <div class="row">
            <div class="col ">
                <?php
                foreach ($images as $image){
                    echo "<img class='img-small idClickableSmallRoomPreview' src='$image'/>";
                }
                ?>
            </div>
        </div>
    </div>

</main>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>

