<?php
require (__DIR__."/scripts/DataBase.php");

$database = new \scripts\DataBase();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $specifications = json_decode($_POST["spiInfoArr"]);
    $roomFields = json_decode($_POST["roomFieldJson"]);

    $room_sql = generateRoomsSql($roomFields, $database);
    $spices_sql = generateSpeceficationSql($specifications);
    $qrr =  getSqlToInsert($room_sql, $spices_sql);

    echo $qrr;
    $result = $database->insertWithResult($qrr);
    echo json_encode(["result" => $result], JSON_UNESCAPED_UNICODE);

    die();
}


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
    <label id="roomInsertingResult"></label>
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
            <td><input type="number" id="idRoomNumber" name="room_nomber_room" class="form-control"/></td>
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
            <td><input type="checkbox"  id="idRoomDeleted" name="room_deleted"/></td>
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

function getSqlToInsert($room, $spices): string
{
    return "START TRANSACTION;$room SET @last_insert_id = LAST_INSERT_ID();$spices COMMIT;";
}

function generateRoomsSql(&$roomFields, &$database): string
{
    $kaf = $database->GetKafedraIdByName($roomFields->rooKaf);

    $roomsSql = "INSERT INTO room (box, nomber_room, kafedra_id, deleted) VALUES ('$roomFields->roomBox', $roomFields->roomNum, $kaf, $roomFields->roomDel);";

    return $roomsSql;
}

function generateSpeceficationSql(&$specifications): string
{
    $spiInsertSql = "INSERT INTO room_information (room_id, specify_id, value) VALUES ";

    foreach ($specifications as $spi){
        $spi_id = substr($spi->spi_param, 4);

        if($spi == end($specifications)){
            $spiInsertSql .= "(@last_insert_id,'$spi_id','$spi->value')";
            continue;
        }

        $spiInsertSql .= "(@last_insert_id,'$spi_id','$spi->value'),";
    }

    $spiInsertSql .= ";";

    return $spiInsertSql;
}
?>

