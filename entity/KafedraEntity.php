<?php

namespace entity;

class KafedraEntity
{
    // Properties
    public $id_kafedra;
    public $name_kafedra;
    public $short_kafedra;
    public $name;
    public $fakyltet_id;
    public $produce;
    public $stateexam;
    public $order_dep;
    public $removed;

    public function getInfo() {
        return "[KafedraEntity(
        Kafedra ID: $this->id_kafedra, 
        Name: $this->name_kafedra, 
        Short Name: $this->short_kafedra, 
        Full Name: $this->name, 
        Fakyltet ID: $this->fakyltet_id, 
        Produce: $this->produce, 
        State Exam: $this->stateexam, 
        Order Department: $this->order_dep, 
        Removed: $this->removed)]";
    }
}