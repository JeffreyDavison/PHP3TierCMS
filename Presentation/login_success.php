<?php
session_start();
ob_start();

function validLogin(){
if(empty($_SESSION['myusername'])||empty($_SESSION['mypassword'])){
    header("location:index.php");
}

}//end function

ob_end_flush();
?>

<html>
<body>

</body>
</html>