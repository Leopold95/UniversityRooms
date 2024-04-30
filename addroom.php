<?php
require (__DIR__."/scripts/DataBase.php");

$database = new \scripts\DataBase();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $rooms = json_decode($_POST["roomInfoArr"]);
    $specifications = json_decode($_POST["spicifyArr"]);
    $globalParams = json_decode($_POST["globalParamArr"]);
    $romid = 0;

    //получение ид комнаты отдельно от всех остальных парметров
    foreach ($globalParams as $param) {
        if($param->global_param == "global_id_room"){
            $romid = $param->value;
            break;
        }
    }

    $roomResult = insertOrUpdateRoom($rooms, $database);
    insertOrUpdateRoomSpecifications($specifications, $romid, $database);

    die();
}
?>

<!doctype html>
<html lang="ua">

<head>
    <title>Детальна інформація</title>
    <?php
    include ("pages/shared/head.php");
    ?>
    <link rel="stylesheet" href="css/addroom.css"/>
    <script type="text/javascript" src="js/addroom.js"></script>
</head>

<body>
<?php
include ("pages/shared/header.php");
?>

<main class="container-fluid">
    <table>
        <h3>Аудиторія</h3>
        <tr>
            <th>Box</th>
            <td><input name="room_box"/></td>
        </tr>
        <tr>
            <th>Room number</th>
            <td><input name="room_nomber_room"/></td>
        </tr>
        <tr>
            <th>Kafedra id</th>
            <td><input name="room_kafedra_id"/></td>
        </tr>
        <tr>
            <th>Deleted</th>
            <td><input name="room_deleted"/></td>
        </tr>
    </table>

    <h3>Спецефікації</h3>

    <table>
        <tr>
            <th>Room id</th>
            <td><input name="global_id_room"/></td>
        </tr>
        <?php
        $listValues = $database->GetSpecifications();
        foreach($listValues as $spi){
            echo "<tr>";
                echo "<th>".$spi["value"]."</th>";
                echo "<td><input name="."spi_".$spi["id"]."></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <button name="addRoom">Додати аудиторію</button>
</main>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>

<?php

function insertOrUpdateRoom(&$rooms, &$database) : bool
{
    $roomsSql = "INSERT INTO room (";

    foreach ($rooms as $room){
        $param = substr($room->room_param, 5);

        if($room == end($rooms)){
            $roomsSql .= $param;
            continue;
        }

        $roomsSql .=  $param.",";
    }

    $roomsSql .= ") VALUES (";
    foreach ($rooms as $room){
        if($room == end($rooms)){
            $roomsSql .= "'".$room->value."'";
            continue;
        }
        $roomsSql .= "'".$room->value."',";
    }
    $roomsSql .= ");";

    return $database->customExistmentWithResult($roomsSql);
}

function insertOrUpdateRoomSpecifications(&$specifications, &$romid, &$database)
{
    foreach ($specifications as $spi){
        $param = substr($spi->spi_param, 4);
        $sql = "INSERT INTO room_information (room_id, specify_id, value) VALUES (";
        $sql .= "'".$romid."',";
        $sql .= "'".$param."',";
        $sql .= "'".$spi->value."');";

        if($database->customExistmentWithResult(checkIfExists($romid, $param)) == true){
            $qrr = "UPDATE room_information SET value='$spi->value' WHERE room_id=$romid AND specify_id=$param";
            if($database->customExistmentWithResult($qrr))
                echo "Dani onovleno";
        }
        else{
            $database->customExistmentWithResult($sql);
            echo "Dani dodano";
        }
    }
}
function checkIfExists($roomId, $spiId):string
{
    return "SELECT * FROM room_information WHERE room_id=$roomId AND specify_id=$spiId;";

}
?>

