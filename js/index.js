//fires when "details" btn on room information line clicked

let lastTag = "";

//save last inputed values for using search automatically while they are changing
let roomValue = "";
let boxValue = "-1";
let kafValue = "-1";

$(document).ready(function (){
    defaultSearch();
});

//show short details on the row clicked
$(document).on("click", ".info-row", (function (){
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
    roomValue = document.getElementById("roomNumberId").value;
    boxValue = document.getElementById("idSelectBox").value;
    kafValue = document.getElementById("idSelectKafedra").value;

    search();
}));


//handle select fields (box) changed
$(document).on("change", ".markHandleChangesBox", function (){
    boxValue = $(this).val();
    search();
});
//handle select fields (kaf) changed
$(document).on("change", ".markHandleChangesKaf", function (){
    kafValue = $(this).val();
    search();
});
//handle input fields (room number) changed
$(document).on("input", ".markHandleChanges", function (){
    roomValue = $(this).val();
    search();
});

function search(){
    if(boxValue === "-1" && kafValue === "-1" && roomValue === ""){
        defaultSearch();
    }

    $.ajax({
        url: "scripts/roomsloader.php",
        type: 'POST',
        data: {
            useSearch: true,
            roomNum: roomValue,
            box: boxValue,
            kafedra: kafValue
        },
        success: function(response) {
            $("#mainRoomsListBlock").html(response);
        }
    });
}

function defaultSearch(){
    $.ajax({
        url: "scripts/roomsloader.php",
        type: 'GET',
        success: function(response) {
            $("#mainRoomsListBlock").html(response);
        }
    });
}

$(document).on('click', "button[name=idBtnAddRoom]", (function(){
    window.location.href = "addroom.php";
}));