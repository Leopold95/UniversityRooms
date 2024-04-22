<?php
namespace scripts;
use entity\RoomEntity;
use Exception;
use mysqli;

require ("entity/KafedraEntity.php");
require ("entity/RoomEntity.php");
require ("entity/RoomInformationEntity.php");
require ("entity/RoomSpecificationsEntity.php");
require ("scripts/ConnectionInfo.php");
require ("scripts/SqlQuarrys.php");
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
                array_push($arrRooms, $elemt);
            }
        }
        catch (Exception $e){
            return $arrRooms;
        }

        return $arrRooms;
    }

    public function  GetRoomInfo($roomId)
    {
        
    }

    public function  GetSpecifications()
    {

    }
}