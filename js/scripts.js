//fires when "details" btn on room information line clicked



$(document).ready(function (){
    //lasr tag global variable for short btn functioality
    let lastTag = "";


    //short details btn pressed
    $("button[name=shortInfo]").click(function (){
        var roomId = $(this).val();
        var tag = "#information_" + roomId;

        //check if same btn pressed
        if(lastTag.valueOf() !== tag.valueOf()){
            //close previos information
            if(lastTag !== ""){
                $(lastTag).text("");
                // $(lastTag).load("pages/parts/updateInformation.php", {
                //         needed: roomId
                // });
            }

            lastTag = tag;
        }

        //load new information
        $(tag).load("pages/parts/updateInformation.php", {
            needed: roomId
        });
    });

    //whole information showcase
    $("button[name=detailsBtn]").click(function (){
        var roomId = $(this).val();
    });



});






