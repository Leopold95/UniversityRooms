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
    <script type="text/javascript" src="/js/advancedInfo.js"></script>
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

<main class="container-fluid">
    <div class="row">
        <div class="col">
            <table>
                <tr>
                    <th>Корпус</th>
                    <td><?php echo $room->box;?></td>
                </tr>
                <tr>
                    <th>Кабінет</th>
                    <td><?php echo $room->number_room;?></td>
                </tr>
                <tr>
                    <th>Кафедра</th>
                    <td><?php echo $kafedra->name_kafedra?></td>
                </tr>
                <tr>
                    <th>Місткість</th>
                    <td><?php echo $room->capacity;?></td>
                </tr>
                <tr>
                    <th>Розмір</th>
                    <td><?php echo $room->area;?></td>
                </tr>
                <tr>
                    <th>Призначення</th>
                    <td><?php echo $room->specialization;?></td>
                </tr>
                <tr>
                    <th>Інформація</th>
                    <td><?php echo $room->Inform;?></td>
                </tr>
                <tr>
                    <th>Копус</th>
                    <td><?php echo $room->Korp;?></td>
                </tr>
                <tr>
                    <th>Educational</th>
                    <td><?php echo $room->educational;?></td>
                </tr>
                <tr>
                    <th>Deleted</th>
                    <td><?php echo $room->deleted;?></td>
            </tr>
            </table>
        </div>
        <!-- room image preview -->
        <div class="col d-flex align-items-center justify-content-center flex-column">
            <!-- default preview of forst image into array -->
            <img class="img-preview" src="<?php echo $images[0] ?? "";?>" id="roomPreview">
            <div>
                <button type="button" value="<?php echo $room->id_room?>" name="openAddingImageModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImageModal">Додати фото</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Видалити фото</button>
            </div>
        </div>
    </div>
    <!-- scrollable rooms images list  -->
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

