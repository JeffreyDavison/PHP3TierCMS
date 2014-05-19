<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'aDataAccess.php';
class DataAccessMySQL extends aDataAccess
{

    private $dbConnection;
    private $result;

    // aDataAccess methods
    public function connectToDB()
    {
         $this->dbConnection = @new mysqli("localhost","admin", "admin","customcms");
         if (!$this->dbConnection)
         {
               die('Could not connect to the customcms Database: ' .
                        $this->dbConnection->connect_errno);
         }
    }

    public function closeDB()
    {  
        $this->dbConnection->close();
    }

    //Pages Connectivity
    public function selectPages()
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM pages");
        if(!$this->result)
        {
            die('Could not retrieve records from the customcms Database: ' .
                $this->dbConnection->error);
        }

    }

    public function fetchPages()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }

    public function fetchPageID($row)
    {
        return $row['pageID'];
    }

    public function fetchPageName($row)
    {
        return $row['pageName'];
    }

    public function fetchPageAlias($row)
    {
        return $row['pageAlias'];
    }

    public function fetchPageDesc($row)
    {
        return $row['pageDesc'];
    }

    public function fetchPageCreatedDate($row)
    {
        return $row['createdDate'];
    }

    public function fetchPageModifyDate($row)
    {
        return $row['modifyDate'];
    }

    public function fetchPageCreatedBy($row)
    {
        return $row['createdBy'];
    }

    public function fetchPageModifyBy($row)
    {
        return $row['modifyBy'];
    }

    public function insertPage($pageName,$pageAlias,$pageDesc, $createdDate, $createdBy)
    {
        $this->result = @$this->dbConnection->query("INSERT INTO pages(pageName,pageAlias, pageDesc, createdDate, createdBy) VALUES('$pageName','$pageAlias','$pageDesc', '$createdDate', '$createdBy');");

        return $this->dbConnection->affected_rows;

    }

    public function GetPage($pageID)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM pages WHERE pageID='$pageID';");
        if(!$this->result)
        {
            die('Could not retrieve records from the Sakila Database: ' .
                $this->dbConnection->error);
        }

    }

    public function updatePage($pageID,$pageName,$pageAlias,$PageDesc, $modifyDate, $modifyBy)
    {
        $this->result = @$this->dbConnection->query(" UPDATE pages SET pageName ='$pageName', pageAlias ='$pageAlias', pageDesc ='$PageDesc', modifyDate ='$modifyDate', modifyDate ='$modifyBy' WHERE pageID='$pageID';");

        return $this->dbConnection->affected_rows;

    }

    public function deletePage($pageID){
        $this->result = @$this->dbConnection->query(" DELETE FROM pages WHERE pageID='$pageID';");

        return $this->dbConnection->affected_rows;

    }

    //Area Connectivity
    public function selectAreas()
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM areas");
        if(!$this->result)
        {
            die('Could not retrieve records from the customcms Database: ' .
                $this->dbConnection->error);
        }

    }

    public function fetchAreas()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }

    public function fetchAreasID($row)
    {
        return $row['areasID'];
    }

    public function fetchAreasName($row)
    {
        return $row['areasName'];
    }

    public function fetchAreasAlias($row)
    {
        return $row['areasAlias'];
    }

    public function fetchOrderOnPage($row)
    {
        return $row['orderOnPage'];
    }

    public function fetchAreasDesc($row)
    {
        return $row['areasDesc'];
    }

    public function fetchAreasCreatedDate($row)
    {
        return $row['createdDate'];
    }

    public function fetchAreasModifyDate($row)
    {
        return $row['modifyDate'];
    }

    public function fetchAreasCreatedBy($row)
    {
        return $row['createdBy'];
    }

    public function fetchAreasModifyBy($row)
    {
        return $row['modifyBy'];
    }

    public function insertAreas($areasName,$areasAlias,$areasOrderOnPages,$areasDesc, $createdDate, $createdBy)
    {
        $this->result = @$this->dbConnection->query("INSERT INTO areas(areasName,areasAlias, areasDesc, createdDate, createdBy) VALUES('$areasName','$areasAlias','$areasOrderOnPages','$areasDesc', '$createdDate', '$createdBy');");

        return $this->dbConnection->affected_rows;

    }

    public function GetArea($areasID)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM areas WHERE areasID='$areasID';");
        if(!$this->result)
        {
            die('Could not retrieve records from the Sakila Database: ' .
                $this->dbConnection->error);
        }
    }


    public function updateAreas($areasID,$areasName,$areasAlias,$areasOrderOnPages,$areasDesc, $modifyDate, $modifyBy)
    {
        $this->result = @$this->dbConnection->query(" UPDATE pages SET areasName ='$areasName', areasAlias ='$areasAlias', orderOnPage ='$areasOrderOnPages', areasDesc ='$areasDesc', modifyDate ='$modifyDate', modifyDate ='$modifyBy' WHERE areasID='$areasID';");

        return $this->dbConnection->affected_rows;

    }

    public function deleteAreas($areasID)
    {
            $this->result = @$this->dbConnection->query(" DELETE FROM areas WHERE areasID='$areasID';");

            return $this->dbConnection->affected_rows;
    }

    //Article Connectivity
    public function selectArticles($page, $contentArea)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM articles WHERE articlePage = '$page' AND contentArea = '$contentArea' ORDER BY createdDate DESC;");
        if(!$this->result)
        {
            die('Could not retrieve records from the customcms Database: ' .
                $this->dbConnection->error);
        }

    }

    public function fetchArticle()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }

    public function fetchArticleID($row)

    {
        return $row['articleID'];
    }

    public function fetchArticleName($row)
    {
        return $row['articleName'];
    }

    public function fetchArticleTitle($row)
    {
        return $row['articleTitle'];
    }

    public function fetchArticleDesc($row)
    {
        return $row['articleDesc'];
    }

    public function fetchArticlePage($row)
    {
        return $row['articlePage'];
    }

    public function fetchContentArea($row)
    {
        return $row['contentArea'];
    }

    public function fetchHtmlSnippet($row)
    {
        return $row['htmlSnippet'];
    }

    public function fetchArticleCreatedDate($row)
    {
        return $row['createdDate'];
    }

    public function fetchArticleModifyDate($row)
    {
        return $row['modifyDate'];
    }

    public function fetchArticleCreatedBy($row)
    {
        return $row['createdBy'];
    }

    public function fetchArticleModifyBy($row)
    {
        return $row['modifyBy'];
    }

    public function fetchCurrentArea($row)
    {
        return $row['currentArea'];
    }

    public function fetchDesignatedPage($row)
    {
        return $row['designatedPage'];
    }

    public function fetchAllPages($row)
    {
        return $row['allPages'];
    }

    public function insertArticle($articleName,$articleTitle,$articleDesc,$articlePage,$contentArea,$htmlSnippet,$createdDate,$createdBy)
    {
        $createdDate = date('Y-m-d g:i:s a');

        $this->result = @$this->dbConnection->query("INSERT INTO articles(articleName, articleTitle, articleDesc, articlePage, contentArea, htmlSnippet, createdDate, createdBy, currentArea, designatedPage, allPages) VALUES('$articleName','$articleTitle','$articleDesc','$articlePage','$contentArea','$htmlSnippet','$createdDate','$createdBy', '$contentArea', '$articlePage', '0');");

        return $this->dbConnection->affected_rows;

    }

    public function GetArticle($articleID)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM articles WHERE articleID='$articleID';");
        if(!$this->result)
        {
            die('Could not retrieve records from the customcms Database: ' .
                $this->dbConnection->error);
        }
    }

    public function updateArticle($articleID,$articleName,$articleTitle,$articleDesc,$articlePage,$contentArea,$htmlSnippet,$modifyBy)
        {
            $modifyDate = date('Y-m-d g:i:s a');

            $stmt = $this->dbConnection->prepare(" UPDATE articles SET articleName = ?, articleTitle = ?, articleDesc = ?, articlePage = ?,contentArea = ?, htmlSnippet = ?, modifyDate = ?, modifyBy = ? WHERE articleID= ?;");

            $stmt->bind_param('sssssssii', $articleName, $articleTitle, $articleDesc, $articlePage, $contentArea, $htmlSnippet, $modifyDate, $modifyBy, $articleID);

            $this->result = $stmt->execute();

            return $this->dbConnection->affected_rows;

        }

    public function deleteArticle($articleID, $modifyBy)
    {
        $modifyDate = date('Y-m-d g:i:s a');

        $this->result = @$this->dbConnection->query(" UPDATE articles SET articlePage = 0, contentArea = 0, modifyDate ='$modifyDate', modifyBy ='$modifyBy' WHERE articleID='$articleID';");

        return $this->dbConnection->affected_rows;
    }

    //CSS Connectivity
    public function selectCss()
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM css WHERE activeState = 1");
        if(!$this->result)
        {
            die('Could not retrieve records from the customcms Database: ' .
                $this->dbConnection->error);
        }

    }

    public function fetchCss()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }

    public function fetchCssID($row)
    {
        return $row['cssID'];
    }

    public function fetchCssName($row)
    {
        return $row['cssName'];
    }

    public function fetchCssDesc($row)
    {
        return $row['cssDesc'];
    }

    public function fetchCssActiveState($row)
    {
        return $row['activeState'];
    }

    public function fetchCssSnippet($row)
    {
        return $row['cssSnippet'];
    }

    public function fetchCssCreatedDate($row)
    {
        return $row['createdDate'];
    }

    public function fetchCssModifyDate($row)
    {
        return $row['modifyDate'];
    }

    public function fetchCssCreatedBy($row)
    {
        return $row['createdBy'];
    }

    public function fetchCssModifyBy($row)
    {
        return $row['modifyBy'];
    }

    public function GetCss($CssID)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM css WHERE cssID='$CssID';");
        if(!$this->result)
        {
            die('Could not retrieve records from the customcms Database: ' .
                $this->dbConnection->error);
        }
    }


    //User Connectivity
    public function checkLogin($checkUsername,$checkPassword, $salt){
        $mypassword = $checkPassword;
        $myusername = $checkUsername;

        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        $myusername = mysql_real_escape_string($myusername);
        $mypassword = mysql_real_escape_string($mypassword);

        //have to pull out the correct salt

        for($x=0;$x<3001;$x++){
              $mypassword = hash('sha512',$mypassword.$salt);
            //$mypassword = hash('sha512',$mypassword.$myusername);
        }

// To protect MySQL injection (more detail about MySQL injection)

        $sql="SELECT * FROM users WHERE username='$myusername' AND password='$mypassword'";
        $result=@$this->dbConnection->query($sql);

// Mysql_num_row is counting table row
        $count=$this->dbConnection->affected_rows;

// If result matched $myusername and $mypassword, table row must be 1 row
        if($count==1)
            return true;
        else
            return false;
    }

    public function register($checkUsername,$checkPassword){
        $mypassword = $checkPassword;
        $myusername = $checkUsername;

        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        $myusername = mysql_real_escape_string($myusername);
        $mypassword = mysql_real_escape_string($mypassword);

        //create a random salt
        $length = 10;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        $salt = $randomString;

        for($x=0;$x<3001;$x++){
            //  $mypassword = hash('sha512',$mypassword.$salt);
            $mypassword = hash('sha512',$mypassword.$myusername);
        }

// To protect MySQL injection (more detail about MySQL injection)

        $sql="INSERT INTO members (username, password, salt) VALUES ('$myusername', '$mypassword', '$salt')";
        $result=@$this->dbConnection->query($sql);

// Mysql_num_row is counting table row
        $count=$this->dbConnection->affected_rows;

// If result matched $myusername and $mypassword, table row must be 1 row
        if($count==1)
            return true;
        else
            return false;
    }

    public function GetUser($username)
    {
        $this->result = @$this->dbConnection->query("SELECT * FROM users WHERE username='$username';");
        if(!$this->result)
        {
            die('Could not retrieve records from the customcms Database: ' .
                $this->dbConnection->error);
        }
    }

//user privileges

//privileges
public function checkPrivileges($userID,$privelageID)
{
    $this->result = @$this->dbConnection->query("SELECT * FROM userprivelages WHERE userID = '$userID' AND privelageID='$privelageID' ");
    if(!$this->result)
    {
        die('Could not retrieve records from the customcms Database: ' .
            $this->dbConnection->error);
    }


    $count=$this->dbConnection->affected_rows;

// If result matched $userID and $privelageID, table row must be 1 row
    if($count==1)
        return true;
    else
        return false;

}

public function fetchPrivileges()
{
    if(!$this->result)
    {
        die('No records in the result set: ' .
            $this->dbConnection->error);
    }
    return $this->result->fetch_array();

}

    public function fetchUser()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }

    public function fetchSalt($row)
    {
        return $row['salt'];
    }
    public function fetchUserID($row)
    {
        return $row['userID'];
    }
}

?>
