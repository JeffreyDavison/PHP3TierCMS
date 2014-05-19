<?php

require_once '../Business/iBusinessObject.php';
require_once '../Data/aDataAccess.php';

class Article implements iBusinessObject
{
    private $m_articleID;
    private $m_articleName;
    private $m_articleTitle;
    private $m_articleDesc;
    private $m_articlePage;
    private $m_contentArea;
    private $m_htmlSnippet;
    private $m_createdDate;
    private $m_modifyDate;
    private $m_createdBy;
    private $m_modifyBy;
    private $m_currentArea;
    private $m_designatedPage;
    private $m_allPages;

    function __construct($in_articleID, $in_articleName, $in_articleTitle, $in_articleDesc, $in_articlePage, $in_contentArea, $in_htmlSnippet, $in_createdDate, $in_modifyDate, $in_createdBy, $in_modifyBy, $in_currentArea, $in_designatedPage, $in_allPages)
    {
        $this->m_articleID = $in_articleID;
        $this->m_articleName = $in_articleName;
        $this->m_articleTitle = $in_articleTitle;
        $this->m_articleDesc = $in_articleDesc;
        $this->m_articlePage = $in_articlePage;
        $this->m_contentArea = $in_contentArea;
        $this->m_htmlSnippet = $in_htmlSnippet;
        $this->m_createdDate = $in_createdDate;
        $this->m_modifyDate = $in_modifyDate;
        $this->m_createdBy = $in_createdBy;
        $this->m_modifyBy = $in_modifyBy;
        $this->m_currentArea = $in_currentArea;
        $this->m_designatedPage = $in_designatedPage;
        $this->m_allPages = $in_allPages;
    }

    public function getAllPages()
    {
        return $this->m_allPages;
    }

    public function getArticleDesc()
    {
        return $this->m_articleDesc;
    }

    public function getArticleID()
    {
        return $this->m_articleID;
    }

    public function getArticleName()
    {
        return $this->m_articleName;
    }

    public function getArticlePage()
    {
        return $this->m_articlePage;
    }

    public function getArticleTitle()
    {
        return $this->m_articleTitle;
    }

    public function getContentArea()
    {
        return $this->m_contentArea;
    }

    public function getCreatedBy()
    {
        return $this->m_createdBy;
    }

    public function getCreatedDate()
    {
        return $this->m_createdDate;
    }

    public function getCurrentArea()
    {
        return $this->m_currentArea;
    }

    public function getDesignatedPage()
    {
        return $this->m_designatedPage;
    }

    public function getHtmlSnippet()
    {
        return $this->m_htmlSnippet;
    }

    public function getModifyBy()
    {
        return $this->m_modifyBy;
    }

    public function getModifyDate()
    {
        return $this->m_modifyDate;
    }



    //need to add correct functions

//TODO: Limited by the specific page and the specific content area

 public static function retrieveSome($args = null)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $page = $args[0];
        $contentArea = $args[1];

        $myDataAccess->selectArticles($page, $contentArea);
        $arrayOfArticleObjects = null;
        while($row = $myDataAccess->fetchArticle())
        {
            $currentArticles = new self($myDataAccess->fetchArticleID($row),
                $myDataAccess->fetchArticleName($row),
                $myDataAccess->fetchArticleTitle($row),
                $myDataAccess->fetchArticleDesc($row),
                $myDataAccess->fetchArticlePage($row),
                $myDataAccess->fetchContentArea($row),
                $myDataAccess->fetchHtmlSnippet($row),
                $myDataAccess->fetchArticleCreatedDate($row),
                $myDataAccess->fetchArticleModifyDate($row),
                $myDataAccess->fetchArticleCreatedBy($row),
                $myDataAccess->fetchArticleModifyBy($row),
                $myDataAccess->fetchCurrentArea($row),
                $myDataAccess->fetchDesignatedPage($row),
                $myDataAccess->fetchAllPages($row));
            $arrayOfArticleObjects[] = $currentArticles;
        }

        $myDataAccess->closeDB();
        if($arrayOfArticleObjects!=null)
        return $arrayOfArticleObjects;
        else
            return "broke";
    }

    public static function GetArticle($ArticleID)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->getArticle($ArticleID);

        while($row = $myDataAccess->fetchArticle())
        {
            $currentArticle = new self($myDataAccess->fetchArticleID($row),
                $myDataAccess->fetchArticleName($row),
                $myDataAccess->fetchArticleTitle($row),
                $myDataAccess->fetchArticleDesc($row),
                $myDataAccess->fetchArticlePage($row),
                $myDataAccess->fetchContentArea($row),
                $myDataAccess->fetchHtmlSnippet($row),
                $myDataAccess->fetchArticleCreatedDate($row),
                $myDataAccess->fetchArticleModifyDate($row),
                $myDataAccess->fetchArticleCreatedBy($row),
                $myDataAccess->fetchArticleModifyBy($row),
                $myDataAccess->fetchCurrentArea($row),
                $myDataAccess->fetchDesignatedPage($row),
                $myDataAccess->fetchAllPages($row));
            $arrayOfArticleObject = $currentArticle;
        }

        $myDataAccess->closeDB();

        return $arrayOfArticleObject;
    }


    public function save()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertArticle($this->m_articleName,$this->m_articleTitle,$this->m_articleDesc,$this->m_articlePage,$this->m_contentArea,$this->m_htmlSnippet,$this->m_createdDate,$this->m_createdBy);

        $myDataAccess->closeDB();

        return "$recordsAffected row(s) affected!";
        
    }

    public static function insertArticle($articleName,$articleTitle,$articleDesc,$articlePage,$contentArea,$htmlSnippet,$createdDate,$createdBy)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->insertArticle($articleName,$articleTitle,$articleDesc,$articlePage,$contentArea,$htmlSnippet,$createdDate,$createdBy);

        $myDataAccess->closeDB();

        return "$recordsAffected rows affected!";

    }

    public static function updateArticle($articleID,$articleName,$articleTitle,$articleDesc,$articlePage,$contentArea,$htmlSnippet,$modifyBy)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->updateArticle($articleID,$articleName,$articleTitle,$articleDesc,$articlePage,$contentArea,$htmlSnippet,$modifyBy);

        $myDataAccess->closeDB();

        return "Updated $recordsAffected row(s)!";;
    }

    public static function deleteArticle($articleID,$modifyBy)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $recordsAffected = $myDataAccess->deleteArticle($articleID,$modifyBy);

        $myDataAccess->closeDB();

        return "Deleted $recordsAffected row(s)!";
    }

}