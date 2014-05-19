<?php


require_once '../Data/aDataAccess.php';

class user
{
    function __construct($in_UserID, $in_Salt)
    {
        $this->m_Salt = $in_Salt;
        $this->m_UserID = $in_UserID;
    }

    public static function checkLogin($inUsername,$inPassword)
    {
        $checkUsername = $inUsername;
        $checkPassword = $inPassword;

        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->getUser($checkUsername);

        while($row = $myDataAccess->fetchUser())
        {
            $currentUser = new self(
                $myDataAccess->fetchUserID($row),
                $myDataAccess->fetchSalt($row));
        }


        $salt =   $currentUser->m_Salt;


        $check = $myDataAccess->checkLogin($checkUsername,$checkPassword, $salt);

        $myDataAccess->closeDB();

        return $check;

    }

    public static function checkPrivileges($checkUsername,$inPrivileges)
    {

        $checkPrivileges = $inPrivileges;

        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->getUser($checkUsername);

        while($row = $myDataAccess->fetchUser())
        {
            $currentUser = new self(
                $myDataAccess->fetchUserID($row),
            $myDataAccess->fetchSalt($row));
        }
        $UserID = $currentUser->m_UserID;

        $check = $myDataAccess->checkPrivileges($UserID,$checkPrivileges);

        $myDataAccess->closeDB();

        return $check;

    }

}



?>
