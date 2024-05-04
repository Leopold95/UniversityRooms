<?php
///controls pages swapping for different places
///     - index.php with rooms list
///     - adcancedinfo.php with swioing to the next room

require (__DIR__."/../scripts/DataBase.php");

if(isset($_POST)){
    $action = $_POST["action"];

    $database = new \scripts\DataBase();

    //if advancedinfo.php [next page] btn pressed
    if($action == "advancedinfo_nextRoom"){
        echo $database->TryGetNextRoom($_POST["currentNum"] + 1, $_POST["currentBox"]);
        die();
    }
    //if advancedinfo.php [prev page] btn pressed
    else if($action == "advancedinfo_prevRoom"){
        echo $database->TryGetPreviousRoom($_POST["currentNum"] -1 , $_POST["currentBox"]);
        die();
    }


}
