$(document).on('click', "button[name=addRoom]", (function(){
    let roomInfos = document.querySelectorAll('input[name^=room_]')
    let spiInfos = document.querySelectorAll('input[name^=spi_]')
    let globalParams = document.querySelectorAll('input[name^=global_]')

    const roomArr = [];
    roomInfos.forEach((el) => {
        roomArr.push({room_param: el.name, value: el.value});
    });

    const spiArr = [];
    spiInfos.forEach((el) => {
        spiArr.push({spi_param: el.name, value: el.value});
    });

    const globalParamsArr = [];
    globalParams.forEach((el) => {
        globalParamsArr.push({global_param: el.name, value: el.value})
    });

    $.ajax({
        url: "addroom.php",
        type: 'POST',
        data: {
            roomInfoArr: JSON.stringify(roomArr),
            spicifyArr: JSON.stringify(spiArr),
            globalParamArr: JSON.stringify(globalParamsArr)
        },
        success: function(response) {
            console.log(response)
        }
    });
}));