//fires when "details" btn on room information line clicked

let lastTag = "";


$(document).ready(function (){
    $.ajax({
        url: "pages/parts/roomsloader.php",
        type: 'GET',
        data: {
            useSearch: false,
            roomNum: 0,
            kafedraTxt: ""
        },
        success: function(response) {
            $("#mainRoomsListBlock").html(response);
        }
    });
});

//show short details on the row clicked
$(document).on("click", ".info-row", (function (){
    //console.log();


    var roomId = $(this).attr("data-value");
    var tag = "#information_" + roomId;

    //check if same btn pressed
    if(lastTag.valueOf() !== tag.valueOf()){
        //close previos information
        if(lastTag !== ""){
            $(lastTag).text("");
        }

        lastTag = tag;
    }

    //load new information
    $(tag).load("pages/parts/updateInformation.php", {
        roomid: roomId
    });
}));

//whole information showcase
$(document).on('click', "button[name=detailsBtn]", (function(){
    var roomId = $(this).val();
    window.location.href = "advancedinfo.php?roomid="+roomId;
}));

//search btn clicked
$(document).on('click', "button[name=btnSearch]", (function(){
    var num = document.getElementById("roomNumberId").value;
    var kaf = document.getElementById("kafedraValId").value;
    var kor = document.getElementById("boxId").value;

    $("#mainRoomsListBlock").text("");
    $.ajax({
        url: "pages/parts/roomsloader.php",
        type: 'POST',
        data: {
            useSearch: true,
            roomNum: num,
            kafedraTxt: kaf,
            box: kor
        },
        success: function(response) {
            $("#mainRoomsListBlock").html(response);
        }
    });
}));



