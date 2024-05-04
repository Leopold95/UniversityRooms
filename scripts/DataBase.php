<?php
namespace scripts;

require (__DIR__ . "/../entity/KafedraEntity.php");
require (__DIR__ . "/../entity/RoomEntity.php");
require (__DIR__ . "/../entity/RoomInformationEntity.php");
require (__DIR__ . "/../entity/RoomSpecificationsEntity.php");
require (__DIR__ . "/../entity/ShortRoomSpecificationEntity.php");
require (__DIR__ . "/../scripts/ConnectionInfo.php");
require (__DIR__ . "/../scripts/SqlQuarrys.php");

use entity\KafedraEntity;
use entity\RoomEntity;
use entity\ShortRoomSpecificationEntity;
use Exception;
use mysqli;

class DataBase
{
    private $info;
    private $connection;
    private $quarry;
    function __construct() {
        $this->info = new ConnectionInfo();
        $this->quarry = new SqlQuarrys();
        $this->connection = new mysqli($this->info->host, $this->info->username,
            $this->info->pwd, $this->info->db_name, $this->info->port);
    }

    public function __destruct()
    {
        if($this->connection->ping())
            $this->connection->close();
    }

    public  function Disconnect()
    {
        if($this->connection->ping())
            $this->connection->close();
    }

    //returns all kadefra names
    public function GetKafedraNames() : array
    {
        $kafedrasNames = array();

        try{
            $result = $this->connection->query(SqlQuarrys::getAllKafedraNames());

            if($result->num_rows <= 0)
                return  $kafedrasNames;

            while($row = mysqli_fetch_assoc($result)) {
                array_push($kafedrasNames, $row["name_kafedra"]);
            }
        }
        catch (Exception $e){
            return $kafedrasNames;
        }

        return $kafedrasNames;
    }

    //returns all rooms
    public function GetRooms()
    {
        $arrRooms = array();

        try{
            $result = $this->connection->query($this->quarry->getAllRooms);

            if($result->num_rows <= 0)
                return $arrRooms;

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

    //returns room by id
    public function GetRoomById($id):RoomEntity
    {
        $room = new RoomEntity();

        try{
            $result = $this->connection->query(SqlQuarrys::getRoomById($id));

            if($result->num_rows <= 0)
                return $room;

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

    //returns rooms by its number
    public function GetRoomsByNumber($number)
    {
        $arrRooms = array();

        try{
            $result = $this->connection->query(SqlQuarrys::getRoomsByNumber($number));

            if($result->num_rows <= 0)
                return $arrRooms;

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

    //returns rooms by its kafedra name
    public function GetRoomsByKafedraName($kafedraName)
    {
        $arrRooms = array();

        try{
            $result = $this->connection->query(SqlQuarrys::GetRoomsByKafName($kafedraName));

            if($result->num_rows <= 0)
                return $arrRooms;

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

    //returns rooms by its box
    public function GetRoomsByBox($box)
    {
        $arrRooms = array();

        try{
            $result = $this->connection->query(SqlQuarrys::GetRoomsByBoxName($box));

            if($result->num_rows <= 0)
                return $arrRooms;

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

    //returns kafedra name by its id
    public function  GetKafedraNameById($id): string
    {
        $kafedra = "";

        try{
            $result = $this->connection->query(SqlQuarrys::KafNameById($id));

            if($result->num_rows <= 0)
                return $kafedra;

            $row = mysqli_fetch_assoc($result);

            $kafedra = $row["name_kafedra"];
        }
        catch (Exception $e){
            return $kafedra;
        }

        return $kafedra;
    }

    public function GetKafedraIdByName($name): string
    {
        $kafedra = -1;

        try{
            $result = $this->connection->query(SqlQuarrys::KafIdByName($name));

            if($result->num_rows <= 0)
                return $kafedra;

            $row = mysqli_fetch_assoc($result);

            $kafedra = $row["id_kafedra"];
        }
        catch (Exception $e){
            return $kafedra;
        }

        return $kafedra;
    }

    //returns kafedra ent name by its id
    public function  GetKafedraById($id): KafedraEntity
    {
        $kafedra = new KafedraEntity();

        try{
            $result = $this->connection->query(SqlQuarrys::getKafedraById($id));
            if($result->num_rows <= 0)
                return $kafedra;

            $row = mysqli_fetch_assoc($result);

            $kafedra->id_kafedra = $row["id_kafedra"];
            $kafedra->name_kafedra = $row["name_kafedra"];
            $kafedra->short_kafedra = $row["short_kafedra"];
            $kafedra->name = $row["name"];
            $kafedra->fakyltet_id = $row["fakyltet_id"];
            $kafedra->produce = $row["produce"];
            $kafedra->stateexam = $row["stateexam"];
            $kafedra->order_dep = $row["order_dep"];
            $kafedra->removed = $row["removed"];
        }
        catch (Exception $e){
            return $kafedra;
        }


        return $kafedra;
    }

    public function  GetKafedraIdIntoRoom($roomId): int
    {
        $kafId = 0;

        try{
            $result = $this->connection->query(SqlQuarrys::getKafedraIdIntoRoom($roomId));
            if($result->num_rows <= 0)
                return $kafId;

            $row = mysqli_fetch_assoc($result);
            return $row["kafedra_id"];
        }
        catch (Exception $e){
            return $kafId;
        }
    }

    //returns all room images by id
    public function GetRoomImages($roomId)
    {
        $roomImages = array();

        try{
            $result = $this->connection->query(SqlQuarrys::getRoomImages($roomId));

            if($result->num_rows <= 0)
                return $roomImages;

            while($row = mysqli_fetch_assoc($result)) {
                array_push($roomImages, $row["url"]);
            }
        }
        catch (Exception $e){
            return $roomImages;
        }

        return $roomImages;
    }

    //creats rom image by room id and image url
    public function AddRoomImage($roomId, $pickUrl) : bool
    {
        try{
            $result = $this->connection->query(SqlQuarrys::addRoomImage($roomId, $pickUrl));
            return $result;
        }
        catch (Exception $e){
            return false;
        }

        return  false;
    }

    //removes rom image by its id
    public function RemoveRoomImage($imgUrl) : bool
    {
        try{
            $result = $this->connection->query(SqlQuarrys::removeRoomImages($imgUrl));
            return $result;
        }
        catch (Exception $e){
            return false;
        }

        return  false;
    }

    //returns all specifications of the room by id
    public function GetRoomSpecifications($roomId)
    {
        $spiList = array();

        try{
            $result = $this->connection->query(SqlQuarrys::getRoomSpecificationsRoomId($roomId));

            if($result->num_rows <= 0)
                return $spiList;

            while($row = mysqli_fetch_assoc($result)) {
                $ent = new ShortRoomSpecificationEntity();
                $ent->spi_label = $row["spi_label"];
                $ent->inf_value = $row["inf_value"];
                array_push($spiList, $ent);
            }
        }
        catch (Exception $e){
            return $spiList;
        }

        return $spiList;
    }

    //returns all avaliable specifications
    public function GetSpecifications()
    {
        $spiList = array();

        try{
            $result = $this->connection->query(SqlQuarrys::getSpiList());

            if($result->num_rows <= 0)
                return $spiList;

            while($row = mysqli_fetch_assoc($result)) {
                //$spiList[$row["id"]] = $row["name"];
                $info = array(
                    "id" => $row["id"],
                    "value" => $row["name"]
                );
                array_push($spiList, $info);
            }
        }
        catch (Exception $e){
            return $spiList;
        }

        return $spiList;
    }

    //check if line exists into database
    public function customExistmentWithResult($qrr): bool
    {
        try{
            $result = $this->connection->query($qrr);

            if($result->num_rows <= 0)
                return false;
            else
                return true;
        }
        catch (Exception $e){
            return false;
        }
    }

    public function customGet($qrr)
    {
        try{
            $result = $this->connection->query($qrr);

            if(!$result)
                return -1;

            if($result->num_rows <= 0)
                return -1;
            else
                return $result;
        }
        catch (Exception $e){
            return false;
        }
    }

    //simple update stmt with result
    public function updateWithResult($qrr): bool
    {
        try{
            $result = $this->connection->query($qrr);

            if(!$result)
                return false;
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }

    //simple insert stmt with result
    public function insertWithResult($qrr)
    {
        try{
            $result = $this->connection->query($qrr);

            if(!$result)
                return  $this->connection->error;
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }

    public function TryGetNextRoom($currentNum, $currentBox) : int
    {
        try{
            $result = $this->connection->query(SqlQuarrys::tryGetNextRoom($currentNum, $currentBox));

            if(!$result)
                return  -1;

            if($result->num_rows <= 0)
                return -1;

            $row = mysqli_fetch_assoc($result);

            return $row["id_room"];
        }
        catch (Exception $e){
            return false;
        }
    }

    public function TryGetPreviousRoom($currentNum, $currentBox) : int
    {
        try{
            $result = $this->connection->query(SqlQuarrys::tryGetPreviousRoom($currentNum, $currentBox));

            if(!$result)
                return  -1;

            if($result->num_rows <= 0)
                return -1;

            $row = mysqli_fetch_assoc($result);

            return $row["id_room"];
        }
        catch (Exception $e){
            return false;
        }
    }
}