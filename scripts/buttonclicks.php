<?php


if (isset($_REQUEST['btnDetails'])) {
    OnBtnDetailsClicled($_REQUEST['btnDetails']);
}

function OnBtnDetailsClicled($roomId)
{
    echo $roomId;
}

?>