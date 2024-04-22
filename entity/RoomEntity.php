<?php

namespace entity;

use AllowDynamicProperties;

class RoomEntity
{
    // Properties
    public $id_room;
    public $box;
    public $nomber_room;
    public $capacity;
    public $area;
    public $kafedra_id;
    public $specialization;
    public $Inform;
    public $Korp;
    public $educational;
    public $photo_url;
    public $deleted;

    public function getInfo() {
        return "[Room(
          ID: $this->id_room,
          Box: $this->box,
          Number: $this->nomber_room, 
          Capacity: $this->capacity, 
          Area: $this->area, 
          Kafedra ID: $this->kafedra_id, 
          Specialization: $this->specialization, 
          Inform: $this->Inform, 
          Korp: $this->Korp, 
          Educational: $this->educational, 
          Photo URL: $this->photo_url, 
          Deleted: $this->deleted)]";
    }
}