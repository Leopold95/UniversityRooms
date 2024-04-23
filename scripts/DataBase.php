<?php
namespace scripts;

require ("entity/KafedraEntity.php");
require ("entity/RoomEntity.php");
require ("entity/RoomInformationEntity.php");
require ("entity/RoomSpecificationsEntity.php");
require ("scripts/ConnectionInfo.php");
require ("scripts/SqlQuarrys.php");

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

    public function GetRoomById($id)
    {
        $rom = new RoomEntity();

        try{
            $result = $this->connection->query($this->quarry->getRoomById($id));
            $row = mysqli_fetch_assoc($result);

            $rom->id_room = $row["id_room"];
        }
        catch (Exception $e){
            return $rom;
        }

        return $rom;
    }

    public function  GetRoomInfo($roomId)
    {
        
    }

    public function  GetSpecifications()
    {

    }
}