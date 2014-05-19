<!DOCTYPE HTML>
<html>
<head>
    <?php require_once("../Business/Article.php"); ?>
</head>
<body>

<?php
if (isset($_POST['snip']) && isset($_POST['title']) && isset($_POST['page']) && isset($_POST['area']))
{

    $snip = mysql_real_escape_string(stripslashes($_POST['snip']));
    $title = mysql_real_escape_string(stripslashes($_POST['title']));
    $desc = mysql_real_escape_string(stripslashes($_POST['desc']));
    $id  = mysql_real_escape_string(stripslashes($_POST['id']));
    $page = mysql_real_escape_string(stripslashes($_POST['page']));
    $area = mysql_real_escape_string(stripslashes($_POST['area']));
    $name = mysql_real_escape_string(stripslashes($_POST['name']));

    $modifyBy = 1;//TODO REPLACE ME WITH SESSION STUFF

    //TODO what the flying monkey man is $articleName

?><h3><?php echo Article::updateArticle($id,$name,$title,$desc,$page,$area,$snip,$modifyBy); ?></h3><?php
}

if (isset($_POST['idDelete']))
{
    $modifyBy = 1; //TODO REPLACE ME WITH SESSION STUFF
    $idDelete = $_POST['idDelete'];


    ?><h3><?php echo Article::deleteArticle($idDelete,$modifyBy); ?></h3>
<?php
}

?>
<a href="../Presentation/index.php">Home</a>    <a href="../Presentation/editArticle.php?articleID=<?php echo $_POST['id'] ?>">Back</a>
</body>
</html>