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
        <!--Search group-->
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <input id="roomNumberId"  placeholder="Кабінет" type="number" class="form-control"/>
                        <input id="kafedraValId" placeholder="Кафедра" type="text" class="form-control">
                        <button name="btnSearch" class="btn btn-outline-secondary" type="button" >Пошук</button>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div id="mainRoomsListBlock">
            </div>
        </div>


    </div>
</main>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>