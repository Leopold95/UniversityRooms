<?php
require (__DIR__."/scripts/DataBase.php");

use scripts\DataBase;

$database = new DataBase();

$kafNamsList = $database->GetKafedraNames();
?>

<!doctype html>
<html lang="ua">

<head>
    <title>Список аудиторій</title>
    <?php
    include ("pages/shared/head.php");
    ?>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
</head>
<body>
<?php
include ("pages/shared/header.php");
?>

<main>
    <button class="" name="idBtnAddRoom">Додати аудиторію</button>

    <div class="container">
        <!--Search group-->
        <div class="row mt-2">
            <div class="input-group mb-3">
                <input id="roomNumberId"  placeholder="Кабінет" type="number" class="form-control markHandleChanges"/>
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
                <select id="idSelectKafedra" class="form-select markHandleChangesKaf" aria-label="Default select example">
                    <option selected value="-1">Оберіть кафедру</option>
                    <?php
                    foreach ($kafNamsList as $kafNam) {
                        echo "<option value='$kafNam'>$kafNam</option>";
                    }
                    ?>
                </select>
                <!--                        <input id="boxId" placeholder="Корпус" type="text" class="form-control">-->
                <!--                        <input id="kafedraValId" placeholder="Кафедра" type="text" class="form-control">-->
                <button name="btnSearch" class="btn btn-outline-secondary btn-search" type="button" >Пошук</button>
            </div>
        </div>

        <!--List of rooms-->
        <ul class="row" id="mainRoomsListBlock">
        </ul>

        <!--Control buttons-->
        <div class="row">
            <div class="col  mt-2 d-flex justify-content-start">
                <button name="prevRoomsList" class="btn btn-primary">Назад</button>
            </div>
            <div class="col  mt-2 d-flex justify-content-end">
                <button name="nextRoomsList" class="btn btn-primary">Далі</button>
            </div>
        </div>
    </div>
</main>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>