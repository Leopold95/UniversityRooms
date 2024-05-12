var currentRoomImagePreview = "";

//initialize room previw image after page loaded
$(document).ready(function (){
    currentRoomImagePreview = $(".idClickableSmallRoomPreview").attr("src");

    $.ajax({
        url: "scripts/pagesSwapper.php",
        type: 'POST',
        data: {
            action: "advancedinfo_prevRoom",
            currentBox: localStorage.getItem("currentRoomBox"),
            currentNum: localStorage.getItem("currentRoomNum")
        },
        success: function(response) {
            //the prev room has been found
            if(response === "-1"){
                $("button[name=prevRoom]").hide();
            }
            //console.log(response)
        }
    });

    $.ajax({
        url: "scripts/pagesSwapper.php",
        type: 'POST',
        data: {
            action: "advancedinfo_nextRoom",
            currentBox: localStorage.getItem("currentRoomBox"),
            currentNum: localStorage.getItem("currentRoomNum")
        },
        success: function(response) {
            //the prev room has been found
            if(response === "-1"){
                $("button[name=nextRoom]").hide();
            }
            //console.log(response)
        }
    });
});

//short room photo preview clicked
$(document).on("click", ".idClickableSmallRoomPreview", (function (){
    var roomUrl = $(this).attr("src");
    var image = document.getElementById("roomPreview");
    image.src = roomUrl;

    //set value of btn remove to image url
    //by this, whel clicked on this btn it will already has requred url, which we want remove
    currentRoomImagePreview = roomUrl;
}));

//btn confirmation loading new room image pressed
$(document).on('click', "button[name=tryLoadRoomPhoto]", (function(){
    let roomId = $("button[name=openAddingImageModal]").val();
    let url = $("textarea[name=roomUrlPhotoLoading]").val();

    if(roomId === "" || roomId === null)
        return;

    if(url === "" || url === null)
        return;

    $.ajax({
        url: "scripts/roomImagesControl.php",
        type: 'GET',
        data: {
            action: "add",
            roomID: roomId,
            imageURL: url
        },
        success: function(response) {
            console.log("succses, server send: ", response);
            if(JSON.parse(response).uploadStatus === "1")
                location.reload();
        },
        error: function (response){
            console.log("error, server send", response)
        }
    });

}));

//clear input fields while open room image loading modal
$(document).on('click', "button[name=openAddingImageModal]", (function(){
    $("input[name=roomIdPhotoLoading]").val("");
    $("input[name=roomUrlPhotoLoading]").val("");
}));

//appplay remove imgae btn clicked
$(document).on('click', "button[name=removeImageApplayed]", (function(){
    let url = currentRoomImagePreview;

    if(url === "" || url === null)
        return;


    $.ajax({
        url: "scripts/roomImagesControl.php",
        type: 'GET',
        data: {
            action: "remove",
            roomID: 0,
            imageURL: url
        },
        //JSON.parse(response).uploadStatus
        success: function(response) {
            console.log("succses, server send: ", response)
            if(JSON.parse(response).uploadStatus === "1")
                location.reload();
        },
        error: function (response){
            console.log("error, server send", response)
        }
    });
}));


$(document).on('click', "button[name=prevRoom]", (function(){
    $.ajax({
        url: "scripts/pagesSwapper.php",
        type: 'POST',
        data: {
            action: "advancedinfo_prevRoom",
            currentBox: localStorage.getItem("currentRoomBox"),
            currentNum: localStorage.getItem("currentRoomNum")
        },
        success: function(response) {
            //the prev room has been found
            if(response !== "-1"){
                window.location.href = "advancedinfo.php?roomid="+response;
            }
            //console.log(response)
        }
    });
}));

$(document).on('click', "button[name=nextRoom]", (function(){
    $.ajax({
        url: "scripts/pagesSwapper.php",
        type: 'POST',
        data: {
            action: "advancedinfo_nextRoom",
            currentBox: localStorage.getItem("currentRoomBox"),
            currentNum: localStorage.getItem("currentRoomNum")
        },
        success: function(response) {
            //the next room has been found
            //console.log(response)
            if(response !== "-1"){
                window.location.href = "advancedinfo.php?roomid="+response;
            }
        }
    });
}));


//on btn edit room pressed
$(document).on('click', "button[name=idEditRoom]", (function(){
    window.location.href = "addroom.php?roomId="+localStorage.getItem("currentRoomId");
}));