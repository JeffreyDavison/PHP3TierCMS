<?php
error_reporting(0);
session_start();
$username=""; // Mysql username
$password=""; // Mysql password

require_once '../Business/user.php';

if(isset($_POST['myusername'])&&isset($_POST['mypassword']))

// username and password sent from form 
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$checkLogin = user::checkLogin($myusername,$mypassword);

if($checkLogin==true){
// Register $myusername, $mypassword and redirect to file "login_success.php"
    $_SESSION['myusername']=$myusername;
    $_SESSION['mypassword']=$mypassword;
    header("location:index.php");
    //header("location:index.php");
}
else {
    echo "Wrong Username or Password";
    ?>
    <br />
    <a href="index.php">Try Again</a>
<?php
}
?>
