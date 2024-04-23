//fires when "details" btn on room information line clicked



$(document).ready(function (){
    $("button[name=detailsBtn]").click(function (){
        var roomId = $(this).val();

        $("#information").load("pages/parts/updateInformation.php", {
            needed: roomId
        });

        console.log(roomId);
    });
});






