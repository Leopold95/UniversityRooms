$(document).on('click', "button[name=addRoom]", (function(){
    let roomInfos = document.querySelectorAll('input[name^=room]')
    let spiInfos = document.querySelectorAll('input[name^=spi_]')

    const roomArr = [];
    const spiArr = [];

    roomInfos.forEach((el) => {
        let data = {room_param: el.name, value: el.value}
        roomArr.push(data)
        console.log(data)
    });

    spiInfos.forEach((el) => {
        let data = {spi_param: el.name, value: el.value}
        spiArr.push(data)
        console.log(data)
    });

    $.ajax({
        url: "",
        type: 'post',
        success: function(response) {

        }
    });
}));