<?php
require (__DIR__."/scripts/DataBase.php");

$database = new \scripts\DataBase();


if(isset($_POST)){

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
            <th>Room id</th>
            <td><input name="room_roomid"/></td>
        </tr>
        <tr>
            <th>Box</th>
            <td><input name="room_box"/></td>
        </tr>
        <tr>
            <th>Room number</th>
            <td><input name="room_roomnum"/></td>
        </tr>
        <tr>
            <th>Kafedra id</th>
            <td><input name="room_kaf_id"/></td>
        </tr>
        <tr>
            <th>Deleted</th>
            <td><input name="room_deleted"/></td>
        </tr>
    </table>

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

    <button name="addRoom">Додати аудиторію</button>
</main>

<?php
include ("pages/shared/footer.php");
?>
</body>
</html>


