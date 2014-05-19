<?php

require_once '../Business/iBusinessObject.php';
require_once '../Data/aDataAccess.php';

class Page implements iBusinessObject
{
    private $m_pageID;
    private $m_pageName;
    private $m_pageAlias;
    private $m_pageDesc;
    private $m_createdDate;
    private $m_modifyDate;
    private $m_createdBy;
    private $m_modifyBy;

    public function __construct($in_pageID, $in_pageName,$in_pageAlias, $in_pageDesc, $in_createdDate,$in_modifyDate, $in_createdBy, $in_modifyBy)
    {
        $this->m_pageID = $in_pageID;
        $this->m_pageName = $in_pageName;
        $this->m_pageAlias = $in_pageAlias;
        $this->m_pageDesc = $in_pageDesc;
        $this->m_createdDate = $in_createdDate;
        $this->m_modifyDate = $in_modifyDate;
        $this->m_createdBy = $in_createdBy;
        $this->m_modifyBy = $in_modifyBy;
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
    public function getPageAlias()
    {
        return $this->m_pageAlias;
    }
    public function getPageDesc()
    {
        return $this->m_pageDesc;
    }
    public function getPageID()
    {
        return $this->m_pageID;
    }
    public function getPageName()
    {
        return $this->m_pageName;
    }

    public static function retrieveSome($args = null)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectPages();

        while($row = $myDataAccess->fetchPages())
        {
            $currentPage = new self($myDataAccess->fetchPageID($row),
                $myDataAccess->fetchPageName($row),
                $myDataAccess->fetchPageAlias($row),
                $myDataAccess->fetchPageDesc($row),
                $myDataAccess->fetchPageCreatedDate($row),
                $myDataAccess->fetchPageModifyDate($row),
                $myDataAccess->fetchPageCreatedBy($row),
                $myDataAccess->fetchPageModifyBy($row));
            $arrayOfPageObjects[] = $currentPage;
        }

        $myDataAccess->closeDB();

        return $arrayOfPageObjects;
    }

    public static function GetSinglePage($PageID)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->GetPage($PageID);

        while($row = $myDataAccess->fetchPages())
        {
            $currentPage = new self($myDataAccess->fetchPageID($row),
                $myDataAccess->fetchPageName($row),
                $myDataAccess->fetchPageAlias($row),
                $myDataAccess->fetchPageDesc($row),
                $myDataAccess->fetchPageCreatedDate($row),
                $myDataAccess->fetchPageModifyDate($row),
                $myDataAccess->fetchPageCreatedBy($row),
                $myDataAccess->fetchPageModifyBy($row));
        }
        $myDataAccess->closeDB();

        return $currentPage;
    }

    public function save()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertPage($this->m_pageName,$this->m_pageAlias,$this->m_pageDesc, $this->m_createdDate, $this->m_createdBy);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";
    }

    public static function updatePage($pageID,$pageName,$pageAlias,$PageDesc, $modifyDate, $modifyBy)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->updatePage($pageID,$pageName,$pageAlias,$PageDesc, $modifyDate, $modifyBy);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";;
    }

    public static function deletePage($pageID)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->deletePage($pageID);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";;
    }

}
