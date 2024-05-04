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
        return "SELECT * FROM room WHERE kafedra_id IN (SELECT id_kafedra FROM kafedra WHERE name_kafedra='$kafName');";
    }

    public static function GetRoomsByBoxName($box)
    {
        return "SELECT * FROM room WHERE box='$box';";
    }

    public static function KafNameById($id)
    {
        return "SELECT name_kafedra FROM kafedra WHERE id_kafedra=$id;";
    }
    public static function KafIdByName($name)
    {
        return "SELECT id_kafedra FROM kafedra WHERE name_kafedra='$name';";
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

    public static function removeRoomImages($roomIUrl)
    {
        return "DELETE FROM room_images WHERE url='$roomIUrl';";
    }

    public static  function getAllKafedraNames()
    {
        return "SELECT name_kafedra FROM kafedra;";
    }

    //из табдицы с информацией достать всю информацию по комнате
    public static function getRoomSpecificationsRoomId($roomId)
    {
        return "
            SELECT rs.name AS spi_label, ri.value AS inf_value
            FROM room_information ri
            JOIN room_specifications rs ON ri.specify_id = rs.id
            WHERE ri.room_id = $roomId;
            ";
    }

    public static function roomNumById($id)
    {
        return "SELECT nomber_room FROM room WHERE id_room=$id;";
    }

    public static function tryGetNextRoom($currentNum, $currentBox)
    {
        return "SELECT `id_room`
                FROM room
                WHERE box='$currentBox' and nomber_room > $currentNum
                LIMIT 1;";
    }

    public static function tryGetPreviousRoom($currentNum, $currentBox)
    {
        return "SELECT `id_room`
                FROM room
                WHERE box='$currentBox' and nomber_room < $currentNum
                LIMIT 1;";
    }

    public static function getSpiList()
    {
        return "SELECT id, name FROM room_specifications";
    }

}