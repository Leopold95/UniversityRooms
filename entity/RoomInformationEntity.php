<?php

namespace entity;

class RoomInformationEntity
{
    public $id;
    public $room_id;
    public $specify_id;
    public $value;

    public function getInfo() {
        return "[RoomInformationEntity(
        ID: $this->id, 
        Room ID: $this->room_id, 
        Specification ID: $this->specify_id,
        Value: $this->value)]";
    }
}