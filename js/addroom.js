$(document).on('click', "button[name=addRoom]", (function(){
    if($("#idSelectBox").val() === "-1"){
        $("#idNotFiledText").text("Укажіть корпус аудиторії");
        $("#feildsNotFileldModal").modal("show");
        return;
    }
    if($("#idRoomNumber").val() === ""){
        $("#idNotFiledText").text("Укажіть номер аудиторії");
        $("#feildsNotFileldModal").modal("show");
        return;
    }
    if($("#idSelectKafedra").val() === "-1"){
        $("#idNotFiledText").text("Укажіть кафедру  аудиторії");
        $("#feildsNotFileldModal").modal("show");
        return;
    }

    let spiInfos = document.querySelectorAll('input[name^=spi_]');
    let boxValue = $("#idSelectBox").val();
    let numValue = $("#idRoomNumber").val();
    let kafValue = $("#idSelectKafedra").val();
    let delValue = ($("#idRoomDeleted").is(':checked') ? 1 : 0);

    const spiArr = [];
    spiInfos.forEach((el) => {
        spiArr.push({spi_param: el.name, value: el.value});
    });

    $.ajax({
        url: "addroom.php",
        type: 'POST',
        data: {
            roomFieldJson: JSON.stringify({
                roomBox: boxValue,
                roomNum: numValue,
                rooKaf: kafValue,
                roomDel: delValue
            }),
            spiInfoArr: JSON.stringify(spiArr)
        },
        success: function(response) {
            console.log(response)
            // if (JSON.parse(response).result !== true)
            //     $("#roomInsertingResult").html("Помилка.");
            //console.log(response)
        }
    });
}));

