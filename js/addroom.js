$(document).on('click', "button[name=addRoom]", (function(){
    if($("#idSelectBox").val() === "-1"){
        $("#idNotFiledText").text("Укажіть корпус аудиторії");
        $("#feildsNotFileldModal").modal("show");
        return;
    }
    if($("#idSelectKafedra").val() === "-1"){
        $("#idNotFiledText").text("Укажіть кафедру  аудиторії");
        $("#feildsNotFileldModal").modal("show");
        return;
    }

    let roomInfos = document.querySelectorAll('input[name^=room_]');
    let spiInfos = document.querySelectorAll('input[name^=spi_]');

    const roomArr = [];
    roomInfos.forEach((el) => {
        roomArr.push({room_param: el.name, value: el.value});
    });

    const spiArr = [];
    spiInfos.forEach((el) => {
        spiArr.push({spi_param: el.name, value: el.value});
    });

    $.ajax({
        url: "addroom.php",
        type: 'POST',
        data: {
            roomInfoArr: JSON.stringify(roomArr),
            spiInfoArr: JSON.stringify(spiArr)
        },
        success: function(response) {
            console.log(response)
        }
    });
}));

