<?php

namespace scripts;

class SqlQuarrys
{
    public $getAllRooms = "SELECT * FROM `room`";
    public static function getRoomById($id)
    {
        return "SELECT * FROM `room` WHERE id_room=$id";
    }

    public static function getRoomsByNumber($number)
    {
        return "SELECT * FROM `room` WHERE nomber_room=$number";
    }

    public static function getKafedraIdsByName($name)
    {
        return "SELECT id_kafedra FROM kafedra WHERE product_name LIKE $name;";
    }

    public static function getRoomsByKafId($id)
    {
        return "SELECT * FROM `room` WHERE kafedra_id=$id";
    }

    public static function GetRoomsByKafName($kafName)
    {
        return "SELECT * FROM room WHERE kafedra_id IN ( SELECT id_kafedra FROM kafedra WHERE name_kafedra LIKE '%$kafName%' );";
    }

    public static function GetRoomsByBoxName($box)
    {
        return "SELECT * FROM room WHERE box='$box';";
    }

    public static function KafNameById($id)
    {
        return "SELECT name_kafedra FROM kafedra WHERE id_kafedra=$id;";
    }


}