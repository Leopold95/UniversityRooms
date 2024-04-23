<!-- element of room pepresents while looping rooms-->


<div class="container-sm">
    <div class="row border">
        <div class="col text-center">
            <a>Номер кабінету: </a>
            <br>
            <a><?php echo $block_number_room;?></a>
        </div>
        <div class="col text-center">
            <a>Призначення: </a>
            <br>
            <a><?php echo $block_specialization;?></a>

        </div>
        <div class="col">

        </div>
        <div class="col d-flex justify-content-end mx-auto p-2">
            <button name="detailsBtn" id="" value="<?php echo $block_room_id;?>" class="btn btn-secondary" >Детельніше</input>
        </div>
    </div>
</div>