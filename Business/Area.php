<?php

require_once '../Business/iBusinessObject.php';
require_once '../Data/aDataAccess.php';

class Area implements iBusinessObject
{
    private $m_areasID;
    private $m_areasName;
    private $m_areasAlias;
    private $m_orderOnPage;
    private $m_areasDesc;
    private $m_createdBy;
    private $m_createdDate;
    private $m_modifyDate;
    private $m_modifyBy;

    function __construct($in_areasID, $in_areasName, $in_areasAlias, $in_orderOnPage, $in_areasDesc, $in_createdDate, $in_createdBy, $in_modifyBy, $in_modifyDate)
    {
        $this->m_areasID = $in_areasID;
        $this->m_areasName = $in_areasName;
        $this->m_areasAlias = $in_areasAlias;
        $this->m_orderOnPage = $in_orderOnPage;
        $this->m_areasDesc = $in_areasDesc;
        $this->m_createdDate = $in_createdDate;
        $this->m_createdBy = $in_createdBy;
        $this->m_modifyBy = $in_modifyBy;
        $this->m_modifyDate = $in_modifyDate;
    }

    public function getAreasAlias()
    {
        return $this->m_areasAlias;
    }

    public function getAreasDesc()
    {
        return $this->m_areasDesc;
    }

    public function getAreasID()
    {
        return $this->m_areasID;
    }

    public function getAreasName()
    {
        return $this->m_areasName;
    }

    public function getCreatedBy()
    {
        return $this->m_createdBy;
    }

    public function getCreatedDate()
    {
        return $this->m_createdDate;
    }

    public function getModifyBy()
    {
        return $this->m_modifyBy;
    }

    public function getModifyDate()
    {
        return $this->m_modifyDate;
    }

    public function getOrderOnPage()
    {
        return $this->m_orderOnPage;
    }

    public static function retrieveSome($args = null)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectAreas();
        
        while($row = $myDataAccess->fetchAreas())
        {
            $currentAreas = new self($myDataAccess->fetchAreasID($row),
                $myDataAccess->fetchAreasName($row),
                $myDataAccess->fetchAreasAlias($row),
                $myDataAccess->fetchOrderOnPage($row),
                $myDataAccess->fetchAreasDesc($row),
                $myDataAccess->fetchAreasCreatedDate($row),
                $myDataAccess->fetchAreasModifyDate($row),
                $myDataAccess->fetchAreasCreatedBy($row),
                $myDataAccess->fetchAreasModifyBy($row));
            $arrayOfAreasObjects[] = $currentAreas;
        }

        $myDataAccess->closeDB();
        
        return $arrayOfAreasObjects;
    }

    public static function GetSingleArea($AreaID)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->getArea($AreaID);

        while($row = $myDataAccess->fetchAreas())
        {
            $currentArea = new self($myDataAccess->fetchAreasID($row),
                $myDataAccess->fetchAreasName($row),
                $myDataAccess->fetchAreasAlias($row),
                $myDataAccess->fetchOrderOnPage($row),
                $myDataAccess->fetchAreasDesc($row),
                $myDataAccess->fetchAreasCreatedDate($row),
                $myDataAccess->fetchAreasModifyDate($row),
                $myDataAccess->fetchAreasCreatedBy($row),
                $myDataAccess->fetchAreasModifyBy($row));
            $arrayOfActorObject = $currentArea;
        }

        $myDataAccess->closeDB();

        return $arrayOfActorObject;
    }


    public function save()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertAreas($this->m_areasName,$this->m_areasAlias,$this->m_orderOnPage,$this->m_areasDesc, $this->m_createdDate, $this->m_createdBy);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";
        
    }

    public static function updateAreas($areasID,$areasName,$areasAlias,$areasOrderOnPages,$areasDesc, $modifyDate, $modifyBy)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->updateAreas($areasID,$areasName,$areasAlias,$areasOrderOnPages,$areasDesc, $modifyDate, $modifyBy);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";;
    }

    public static function deleteAreas($areasID)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->deleteAreas($areasID);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";;
    }

}
