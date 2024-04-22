<?php

namespace entity;

use AllowDynamicProperties;

class RoomEntity
{
    public $id_room;
    public $box;
    public $number_room;

    public function __toString()
    {
        return strval("[RoomEntity(
        id_room=$this->id_room
        box=$this->box
        number_room=$this->number_room
        )]");
    }
}