<?php

namespace entity;

class RoomSpecificationsEntity
{
    public $id;
    public $short_name;
    public $name;
    public $sequence;

    public function getInfo() {
        return "[RoomSpecificationsEntity(
        ID: $this->id, 
        Short Name: $this->short_name, 
        Name: $this->name, 
        Sequence: $this->sequence)]";
    }
}