<?php

// So, which database implementation will we use??
require_once '../Data/DataAccessMySQL.php';
//require_once '../Data/DataAccessSQLServer.php';

abstract class aDataAccess
{
    private static $m_DataAccess;

    public static function getInstance()
    {
        // singleton
        if(self::$m_DataAccess == null)
        {
            self::$m_DataAccess = new DataAccessMySQL();
            //self::$m_DataAccess = new DataAccessSQLServer();
        }
        return self::$m_DataAccess;
    }
//General
    public abstract function connectToDB();

    public abstract function closeDB();

   //Pages Connectivity
    public abstract function selectPages();

    public abstract function fetchPages();
    
    public abstract function fetchPageID($row);

    public abstract function fetchPageName($row);

    public abstract function fetchPageAlias($row);

    public abstract function fetchPageDesc($row);

    public abstract function fetchPageCreatedDate($row);

    public abstract function fetchPageModifyDate($row);

    public abstract function fetchPageCreatedBy($row);

    public abstract function fetchPageModifyBy($row);
    
    public abstract function insertPage($pageName,$pageAlias,$pageDesc, $createdDate, $createdBy);

    public abstract function GetPage($pageID);

    public abstract function updatePage($pageID,$pageName,$pageAlias,$PageDesc, $modifyDate, $modifyBy);

    public abstract function deletePage($pageID);

    //Area Connectivity
    public abstract function selectAreas();

    public abstract function fetchAreas();

    public abstract function fetchAreasID($row);

    public abstract function fetchAreasName($row);

    public abstract function fetchAreasAlias($row);

    public abstract function fetchOrderOnPage($row);

    public abstract function fetchAreasDesc($row);

    public abstract function fetchAreasCreatedDate($row);

    public abstract function fetchAreasModifyDate($row);

    public abstract function fetchAreasCreatedBy($row);

    public abstract function fetchAreasModifyBy($row);

    public abstract function insertAreas($areasName,$areasAlias,$areasOrderOnPages,$areasDesc, $createdDate, $createdBy);

    public abstract function GetArea($areasID);

    public abstract function updateAreas($areasID,$areasName,$areasAlias,$areasOrderOnPages,$areasDesc, $modifyDate, $modifyBy);

    public abstract function deleteAreas($areasID);

    //Article Connectivity
    public abstract function selectArticles($page, $contentArea);

    public abstract function fetchArticle();

    public abstract function fetchArticleID($row);

    public abstract function fetchArticleDesc($row);

    public abstract function fetchArticleName($row);

    public abstract function fetchArticleTitle($row);

    public abstract function fetchArticlePage($row);

    public abstract function fetchContentArea($row);

    public abstract function fetchHtmlSnippet($row);

    public abstract function fetchArticleCreatedDate($row);

    public abstract function fetchArticleModifyDate($row);

    public abstract function fetchArticleCreatedBy($row);

    public abstract function fetchArticleModifyBy($row);

    public abstract function fetchCurrentArea($row);

    public abstract function fetchDesignatedPage($row);

    public abstract function fetchAllPages($row);

    public abstract function insertArticle($articleName,$articleTitle,$articleDesc,$articlePage,$contentArea,$htmlSnippet,$createdDate,$createdBy);

    public abstract function GetArticle($articleID);

    public abstract function updateArticle($articleID,$articleName,$articleTitle,$articleDesc,$articlePage,$contentArea,$htmlSnippet,$modifyBy);

    public abstract function deleteArticle($articleID,$modifyBy);

    //CSS Connectivity
    public abstract function selectCss();

    public abstract function fetchCss();

    public abstract function fetchCssID($row);

    public abstract function fetchCssName($row);

    public abstract function fetchCssDesc($row);

    public abstract function fetchCssActiveState($row);

    public abstract function fetchCssSnippet($row);

    public abstract function fetchCssCreatedDate($row);

    public abstract function fetchCssModifyDate($row);

    public abstract function fetchCssCreatedBy($row);

    public abstract function fetchCssModifyBy($row);

    public abstract function GetCss($CssID);

    // User Connectivity
    public abstract function checkLogin($checkUsername,$checkPassword, $salt);

    public abstract function register($checkUsername,$checkPassword);

    public abstract function GetUser($username);

    public abstract function fetchSalt($row);

    public abstract function fetchUser();

    // User Privileges
    public abstract function checkPrivileges($userID,$privelageID);

    public abstract function fetchPrivileges();

    public abstract function fetchUserID($row);
}
?>
