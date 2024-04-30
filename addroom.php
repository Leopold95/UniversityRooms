<?php
require (__DIR__."/scripts/DataBase.php");

$database = new \scripts\DataBase();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $roomId =  $_POST["roomId"];

    if($roomId == "")
        die();

    if($_POST["add"] === "room"){
        $roomFields = json_decode($_POST["roomInfoArr"]);
        $roomResult = insertOrUpdateRoom($roomFields, $database, $roomId);
        echo $roomResult;
    }elseif ($_POST["add"] === "specefic"){
        $specifications = json_decode($_POST["spicifyArr"]);
        $spiResult = insertOrUpdateRoomSpecifications($specifications, $roomId, $database);
        echo json_encode($spiResult);
    }


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
    <h3>Ідентифікатор</h3>
    <table>
        <tr>
            <th>Room id</th>
            <td><input id="#id_room"/></td>
        </tr>
    </table>
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
    <button name="addRoom">Додати аудиторію</button>

    <h3>Спецефікації</h3>

    <table>
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

    <button name="addSpecefications">Додати Індормацію</button>
</main>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>

<?php

function insertOrUpdateRoom(&$roomFields, &$database, &$roomId)
{
    $qrrCheckSelect = "SELECT id_room FROM room WHERE id_room=$roomId";
    $isExists = $database->customExistmentWithResult($qrrCheckSelect);

    if($isExists == true){
        $roomSql = "UPDATE room SET ";

        foreach ($roomFields as $field){
            $param = substr($field->room_param, 5);

            if($field == end($roomFields)){
                $roomSql .= $param."="."'".$field->value."'";
                continue;
            }

            $roomSql .= $param."="."'".$field->value."',";
        }

        $roomSql .= " WHERE id_room=$roomId";

        if($database->customInsert($roomSql)){
            return json_encode([$roomId => "update room succsessfull"], JSON_UNESCAPED_UNICODE);
        }
        else{
            return json_encode([$roomId => "update room error"], JSON_UNESCAPED_UNICODE);
        }
    }
    else{
        $roomsSql = "INSERT INTO room (";

        foreach ($roomFields as $room){
            $param = substr($room->room_param, 5);

            if($room == end($roomFields)){
                $roomsSql .= $param;
                continue;
            }

            $roomsSql .=  $param.",";
        }

        $roomsSql .= ") VALUES (";
        foreach ($roomFields as $room){
            if($room == end($roomFields)){
                $roomsSql .= "'".$room->value."'";
                continue;
            }
            $roomsSql .= "'".$room->value."',";
        }
        $roomsSql .= ");";

        //AREA FILED WICH NOT USED

        if($database->customInsert($roomsSql)){
            return json_encode([$roomId => "insert room succsessfull"], JSON_UNESCAPED_UNICODE);
        }
        else{
            return json_encode([$roomId => "insert room error"], JSON_UNESCAPED_UNICODE);
        }
    }
}

function insertOrUpdateRoomSpecifications(&$specifications, &$romid, &$database): array
{
    $arr = array();
    foreach ($specifications as $spi){
        $param = substr($spi->spi_param, 4);

        //if this spi exists into db
        if($database->customExistmentWithResult(checkIfExists($romid, $param)) == true){
            $qrr = "UPDATE room_information SET value='$spi->value' WHERE room_id=$romid AND specify_id=$param";

            if($database->customUpdate($qrr) == true){
                $arr[$spi->spi_param] = "updated";
            }
            else{
                $arr[$spi->spi_param] = "error updating";
            }
        }
        else{
            $sql = "INSERT INTO room_information (room_id, specify_id, value) VALUES (";
            $sql .= "'".$romid."',";
            $sql .= "'".$param."',";
            $sql .= "'".$spi->value."');";
            if($database->customInsert($sql) == true)
                $arr[$spi->spi_param] = "created";
            else
                $arr[$spi->spi_param] = "error inserting";
        }
    }

    return $arr;
}
?>

