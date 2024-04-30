<!-- element of room pepresents while looping rooms-->
<div data-value="<?php echo $block_room_id;?>" class="container mb-1 mt-1 row-color info-row">
    <div class="col">
        <div class="row">
            <div class="col text-center">
                <a><strong>Кабінет: </strong></a>
                <br>
                <a><?php echo $block_number_room;?></a>
            </div>
            <div class="col text-center">
                <a><strong>Корпус: </strong></a>
                <br>
                <a><?php echo $block_korp;?></a>
            </div>
            <div class="col text-center">
                <a><strong>Кафедра: </strong></a>
                <br>
                <a><?php echo $block_kafName;?></a>
            </div>
            <div class="col  d-flex  justify-content-center mx-auto p-2">
                <button name="detailsBtn" id="" value="<?php echo $block_room_id;?>" class="btn-roomline" >Детальніше</button>
            </div>
        </div>

        <!--Short room information-->
<!--        <div class="pb-2" id="information_--><?php //echo $block_room_id;?><!--"></div>-->
    </div>
</div>



