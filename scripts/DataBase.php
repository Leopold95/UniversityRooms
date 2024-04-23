<?php
namespace scripts;

require (__DIR__ . "/../entity/KafedraEntity.php");
require (__DIR__ . "/../entity/RoomEntity.php");
require (__DIR__ . "/../entity/RoomInformationEntity.php");
require (__DIR__ . "/../entity/RoomSpecificationsEntity.php");
require (__DIR__ . "/../scripts/ConnectionInfo.php");
require (__DIR__ . "/../scripts/SqlQuarrys.php");

use entity\RoomEntity;
use Exception;
use mysqli;

class DataBase
{
    private $info;
    private $connection;
    private $quarry;
    public $isConnected;
    function __construct() {
        $this->info = new ConnectionInfo();
        $this->quarry = new SqlQuarrys();
        $this->connection = new mysqli($this->info->host, $this->info->username,
            $this->info->pwd, $this->info->db_name);

        $this->isConnected = $this->connection->ping();
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    public  function Disconnect()
    {
        if($this->connection->ping())
            $this->connection->close();
    }

    public function GetKafedras()
    {

    }

    public function GetRooms()
    {
        $arrRooms = array();

        try{
            $result = $this->connection->query($this->quarry->getAllRooms);
            while($row = mysqli_fetch_assoc($result)) {
                $elemt = new RoomEntity();
                $elemt->id_room = $row["id_room"];
                $elemt->box = $row["box"];
                $elemt->number_room = $row["nomber_room"];
                $elemt->capacity = $row["capacity"];
                $elemt->area = $row["area"];
                $elemt->kafedra_id = $row["kafedra_id"];
                $elemt->specialization = $row["specialization"];
                $elemt->Inform = $row["Inform"];
                $elemt->Korp = $row["Korp"];
                $elemt->educational = $row["educational"];
                $elemt->photo_url = $row["photo_url"];
                array_push($arrRooms, $elemt);
            }
        }
        catch (Exception $e){
            return $arrRooms;
        }

        return $arrRooms;
    }

    public function GetRoomById($id):RoomEntity
    {
        $room = new RoomEntity();

        try{
            $result = $this->connection->query(SqlQuarrys::getRoomById($id));
            $row = mysqli_fetch_assoc($result);
            $room->id_room = $row["id_room"];
            $room->box = $row["box"];
            $room->number_room = $row["nomber_room"];
            $room->capacity = $row["capacity"];
            $room->area = $row["area"];
            $room->kafedra_id = $row["kafedra_id"];
            $room->specialization = $row["specialization"];
            $room->Inform = $row["Inform"];
            $room->Korp = $row["Korp"];
            $room->educational = $row["educational"];
            $room->photo_url = $row["photo_url"];
        }
        catch (Exception $e){
            return $room;
        }

        return $room;
    }

    public function GetRoomByNumber($number):RoomEntity
    {
        $room = new RoomEntity();

        try{
            $result = $this->connection->query(SqlQuarrys::getRoomByNumber($number));
            $row = mysqli_fetch_assoc($result);
            $room->id_room = $row["id_room"];
            $room->box = $row["box"];
            $room->number_room = $row["nomber_room"];
            $room->capacity = $row["capacity"];
            $room->area = $row["area"];
            $room->kafedra_id = $row["kafedra_id"];
            $room->specialization = $row["specialization"];
            $room->Inform = $row["Inform"];
            $room->Korp = $row["Korp"];
            $room->educational = $row["educational"];
            $room->photo_url = $row["photo_url"];
        }
        catch (Exception $e){
            return $room;
        }

        return $room;
    }

    public function  GetRoomInfo($roomId)
    {
        
    }

    public function  GetSpecifications()
    {

    }
}