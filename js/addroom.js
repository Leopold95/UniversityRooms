$(document).on('click', "button[name=addRoom]", (function(){
    let roomInfos = document.querySelectorAll('input[name^=room_]')
    let roomId = document.getElementById("#id_room").value

    const roomArr = [];
    roomInfos.forEach((el) => {
        roomArr.push({room_param: el.name, value: el.value});
    });

    $.ajax({
        url: "addroom.php",
        type: 'POST',
        data: {
            add: "room",
            roomInfoArr: JSON.stringify(roomArr),
            roomId: roomId
        },
        success: function(response) {
            console.log(response)
        }
    });
}));

$(document).on('click', "button[name=addSpecefications]", (function(){
    let spiInfos = document.querySelectorAll('input[name^=spi_]')
    let roomId = document.getElementById("#id_room").value

    const spiArr = [];
    spiInfos.forEach((el) => {
        spiArr.push({spi_param: el.name, value: el.value});
    });

    $.ajax({
        url: "addroom.php",
        type: 'POST',
        data: {
            add: "specefic",
            spicifyArr: JSON.stringify(spiArr),
            roomId: roomId
        },
        success: function(response) {
            console.log(response)
        }
    });
}));