<?php

namespace scripts;

class SqlQuarrys
{
    public $getAllRooms = "SELECT * FROM `room`";
    public static function getRoomById($id)
    {
        return "SELECT * FROM `room` WHERE id_room=$id";
    }
}