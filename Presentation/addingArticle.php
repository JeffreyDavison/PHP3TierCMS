<!DOCTYPE HTML>
<html>
<head>
    <?php require_once("../Business/Article.php"); ?>
</head>
<body>

<?php
if (isset($_POST['snip']) && isset($_POST['title']) && isset($_POST['id']))
{
    $snip =  mysql_real_escape_string(stripslashes($_POST['snip']));
    $title = mysql_real_escape_string(stripslashes($_POST['title']));
    $desc = mysql_real_escape_string(stripslashes($_POST['desc']));
    $id  = mysql_real_escape_string(stripslashes($_POST['id']));
    $name  = mysql_real_escape_string(stripslashes($_POST['name']));
    $page = mysql_real_escape_string(stripslashes($_POST['page']));
    $area = mysql_real_escape_string(stripslashes($_POST['area']));
    $name = mysql_real_escape_string(stripslashes($_POST['name']));
    //TODO remove these two varb's and re[place with session and a real date

    $date = new DateTime();
    $date->getTimestamp();

    $modifyDate = $date->getTimestamp();
    $modifyBy = 1;

    //TODO what the flying monkey man is $articleName

?><h3><?php echo Article::insertArticle($name,$title,$desc,$page,$area,$snip,$modifyDate,$modifyBy); ?></h3><?php
}
?>
<a href="../Presentation/index.php">Home</a>
</body>
</html>