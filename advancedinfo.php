<?php
require(__DIR__ . "/scripts/DataBase.php");
use scripts\DataBase;

$database = new DataBase();
$roomId = $_GET["roomid"];

$room = $database->GetRoomById($roomId);
$kafedra = $database->GetKafedraById($database->GetKafedraIdIntoRoom($roomId));
$images = $database->GetRoomImages($roomId);
$spis = $database->GetRoomSpecifications($roomId);
?>


<!doctype html>
<html lang="ua">

<head>
    <title>Детальна інформація</title>
    <?php
    include ("pages/shared/head.php");
    ?>
    <link rel="stylesheet" href="css/advancedinfo.css"/>
    <script type="text/javascript" src="js/advancedInfo.js"></script>
</head>

<body>
<?php
include ("pages/shared/header.php");
?>

<!--modal adding image window-->
<div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Додати фотографію</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">URL фотографії:</label>
                        <textarea name="roomUrlPhotoLoading" class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                <button name="tryLoadRoomPhoto" type="button" class="btn btn-primary">Завантажити</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal remove image -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Видалити поточну фотографію?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Відміна</button>
                <button name="removeImageApplayed" type="button" class="btn btn-primary">Підтверджую</button>
            </div>
        </div>
    </div>
</div>

<main class="container-fluid pb-2">
    <div class="row">
        <div class="col  mt-2 d-flex justify-content-start">
            <button name="prevRoom" class="btn btn-primary">Назад</button>
        </div>
        <div class="col  mt-2 d-flex justify-content-end">
            <button name="nextRoom" class="btn btn-primary">Далі</button>
        </div>
    </div>

    <div class="row">
        <!--room info col-->
        <div class="col mt-2">
            <h4>Інформація</h4>
            <table>
                <tr>
                    <th>Номер кабінету</th>
                    <td><?php echo $room->number_room?></td>
                </tr>
                <tr>
                    <th>Корпус</th>
                    <td><?php echo $room->box?></td>
                </tr>
                <tr>
                    <th>Кафедра</th>
                    <td><?php echo $kafedra->name_kafedra?></td>
                </tr>
            </table>
            <h4>Специфікації</h4>
            <table>
                <?php
                foreach ($spis as $spi) {
                    if($spi->inf_value == null){
                        continue;
                    }

                    echo "<tr>";
                        echo "<th>".$spi->spi_label."</th>";
                        echo "<td>".$spi->inf_value."</td>";
                    echo " </tr>";
                }
                ?>
            </table>
        </div>

        <!--room images col-->
        <div class="col mt-2">
            <!-- room image preview -->
            <div class="row">
                    <!-- default preview of forst image into array -->
                    <img alt="Зображень немає" class="img-preview" src="<?php echo $images[0] ?? "";?>" id="roomPreview">

                    <div class="mt-2 d-flex justify-content-center">
                        <button type="button" value="<?php echo $roomId?>" name="openAddingImageModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImageModal">Додати фото</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Видалити фото</button>
                        <button type="button" class="btn btn-primary" name="idEditRoom">Редагувати</button>
                    </div>
            </div>

            <!-- scrollable rooms images list  -->
            <div class="row flex-nowrap overflow-auto mt-2">
                <?php
                foreach ($images as $image){
                    echo "<img class='img-small idClickableSmallRoomPreview' src='$image'/>";
                }
                ?>
            </div>
        </div>
    </div>
</main>

<script>
    localStorage.setItem("currentRoomBox", "<?php echo $room->box?>");
    localStorage.setItem("currentRoomNum", "<?php echo $room->number_room?>");
    localStorage.setItem("currentRoomId", "<?php echo $room->id_room?>");
</script>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>

