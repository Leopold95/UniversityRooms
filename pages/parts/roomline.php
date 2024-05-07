<!-- element of room pepresents while looping rooms-->
<li data-value="<?php echo $block_room_id;?>" class="mb-1 mt-1 info-row">
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
</li>



