<?php
require (__DIR__."/scripts/DataBase.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $roomFields = json_decode($_POST["roomInfoArr"]);
    $specifications = json_decode($_POST["spiInfoArr:"]);

    echo json_encode(["status" => "error", "message" => "Room id is required"]);



    die();
}

$database = new \scripts\DataBase();
$kafNamsList = $database->GetKafedraNames();
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

<div class="modal fade" id="feildsNotFileldModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Оде або декілько полів не заповнені</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label id="idNotFiledText"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<main class="container-fluid">
    <h3>Аудиторія</h3>
    <table>
        <tr>
            <th>Box</th>
            <td>
                <select id="idSelectBox" class="form-select markHandleChangesBox" aria-label="Default select example">
                    <option selected value="-1">Оберіть Корпус</option>
                    <option value="А">А</option>
                    <option value="Б">Б</option>
                    <option value="В">В</option>
                    <option value="Г">Г</option>
                    <option value="Д">Д</option>
                    <option value="Е">Е</option>
                    <option value="Дв">Дв</option>
                    <option value="Т">Т</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Room number</th>
            <td><input name="room_nomber_room" class="form-control"/></td>
        </tr>
        <tr>
            <th>Kafedra id</th>
            <td>
                <select id="idSelectKafedra" class="form-select markHandleChangesKaf" aria-label="Default select example">
                    <option selected value="-1">Оберіть кафедру</option>
                    <?php
                    foreach ($kafNamsList as $kafNam) {
                        echo "<option value='$kafNam'>$kafNam</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Deleted</th>
            <td><input type="checkbox" name="room_deleted"/></td>
        </tr>
    </table>

    <h3>Спецефікації</h3>
    <table>
        <?php
        $listValues = $database->GetSpecifications();
        foreach($listValues as $spi){
            echo "<tr>";
                echo "<th>".$spi["value"]."</th>";
                echo "<td><input class='form-control' name="."spi_".$spi["id"]."></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <button name="addRoom">Додати Аудиторію</button>
</main>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>

<?php

function generateRoomsSql(&$roomFields): string
{
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
    return $roomsSql;
}

function generateSpeceficationSqls(&$specifications, &$romid): array
{
    $spiInsertSqlList = array();
    foreach ($specifications as $spi){
        $spi_id = substr($spi->spi_param, 4);

        $sql = "INSERT INTO room_information (room_id, specify_id, value) VALUES (";
        $sql .= "'".$romid."',";
        $sql .= "'".$spi_id."',";
        $sql .= "'".$spi->value."');";

        $spiInsertSqlList[] = $sql;
    }
    return $spiInsertSqlList;
}

function createTransActionSql($insertRoomSql, $speceficationSqlList): string
{

    return "";
}

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

        $sqlExists =  "SELECT id FROM room_information WHERE room_id=$romid AND specify_id=$param";

        //if this spi exists into db
        if($database->customExistmentWithResult($sqlExists) == true){
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

