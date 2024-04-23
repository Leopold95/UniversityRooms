<?php
require(__DIR__ . "/scripts/DataBase.php");
use \scripts\DataBase;

$database = new DataBase();
$roomId = $_GET["roomid"];

$room = $database->GetRoomById($roomId);
?>


<!doctype html>
<html lang="ua">

<?php
include ("pages/shared/head.php");
?>

<body>
<?php
include ("pages/shared/header.php");
?>

<main>
    <div class="container-fluid">
        <?php
        echo $room->getInfo();
        ?>
    </div>
</main>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>

