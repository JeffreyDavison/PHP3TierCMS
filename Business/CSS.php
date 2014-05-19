<?php

require_once '../Business/iBusinessObject.php';
require_once '../Data/aDataAccess.php';

class CSS implements iBusinessObject
{
    private $m_cssID;
    private $m_cssName;
    private $m_cssDesc;
    private $m_activeState;
    private $m_cssSnippet;
    private $m_createdDate;
    private $m_modifyDate;
    private $m_createdBy;
    private $m_modifyBy;

    function __construct($in_cssID, $in_cssName, $in_cssDesc, $in_activeState, $in_cssSnippet, $in_createdDate, $in_modifyDate, $in_createdBy, $in_modifyBy)
    {
        $this->m_cssID = $in_cssID;
        $this->m_cssName = $in_cssName;
        $this->m_cssDesc = $in_cssDesc;
        $this->m_activeState = $in_activeState;
        $this->m_cssSnippet = $in_cssSnippet;
        $this->m_createdDate = $in_createdDate;
        $this->m_modifyDate = $in_modifyDate;
        $this->m_createdBy = $in_createdBy;
        $this->m_modifyBy = $in_modifyBy;
    }

    public function getActiveState()
    {
        return $this->m_activeState;
    }

    public function getCreatedBy()
    {
        return $this->m_createdBy;
    }

    public function getCreatedDate()
    {
        return $this->m_createdDate;
    }

    public function getCssDesc()
    {
        return $this->m_cssDesc;
    }

    public function getCssID()
    {
        return $this->m_cssID;
    }

    public function getCssName()
    {
        return $this->m_cssName;
    }

    public function getCssSnippet()
    {
        return $this->m_cssSnippet;
    }

    public function getModifyBy()
    {
        return $this->m_modifyBy;
    }

    public function getModifyDate()
    {
        return $this->m_modifyDate;
    }

    public static function retrieveSome($args = null)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectCss();
        
        while($row = $myDataAccess->fetchCss())
        {
            $currentCss = new self($myDataAccess->fetchCssID($row),
                $myDataAccess->fetchCssName($row),
                $myDataAccess->fetchCssDesc($row),
                $myDataAccess->fetchCssActiveState($row),
                $myDataAccess->fetchCssSnippet($row),
                $myDataAccess->fetchCssCreatedDate($row),
                $myDataAccess->fetchCssModifyDate($row),
                $myDataAccess->fetchCssCreatedBy($row),
                $myDataAccess->fetchCssModifyBy($row));
            $arrayOfCssObjects[] = $currentCss;
        }

        $myDataAccess->closeDB();
        
        return $arrayOfCssObjects;
    }

    public static function GetCss($CssID)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->getCss($CssID);

        while($row = $myDataAccess->fetchCss())
        {
            $currentCss = new self($myDataAccess->fetchCssID($row),
                $myDataAccess->fetchCssName($row),
                $myDataAccess->fetchCssDesc($row),
                $myDataAccess->fetchCssActiveState($row),
                $myDataAccess->fetchCssSnippet($row),
                $myDataAccess->fetchCssCreatedDate($row),
                $myDataAccess->fetchCssModifyDate($row),
                $myDataAccess->fetchCssCreatedBy($row),
                $myDataAccess->fetchCssModifyBy($row));
            $arrayOfCssObjects = $currentCss;
        }

        $myDataAccess->closeDB();

        return $arrayOfCssObjects;
    }

    public function save()
    {
        return "";
    }

}
