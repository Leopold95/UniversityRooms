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

    public static function getKafedraById($id)
    {
        return "SELECT * FROM kafedra WHERE id_kafedra=$id";
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
    public static function addRoomImage($pickId, $url)
    {
        return "INSERT INTO room_images (room_id, url) VALUES ('$pickId', '$url');";
    }

    public static function getKafedraIdIntoRoom($roomId)
    {
        return "SELECT kafedra_id FROM room WHERE id_room=$roomId;";
    }

    public static function getRoomImages($roomId)
    {
        return "SELECT url FROM room_images WHERE room_id=$roomId;";
    }

}