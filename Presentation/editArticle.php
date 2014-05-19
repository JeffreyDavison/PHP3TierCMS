<?php
require_once("../Business/CSS.php");
require_once("../Business/Article.php");
require_once("../Business/Page.php");
#require_once("C:\Repos\Assignment 3\Assignment-3\Assignment-3\Business\Area.php");
#require_once("C:\Repos\Assignment 3\Assignment-3\Assignment-3\Business\user.php");

$articleEditID = 0;
if (isset($_GET['articleID']))
{
    $articleEditID = $_GET['articleID'];
    $Edit = Article::GetArticle($articleEditID);
}
else
{
    //TODO Header redirect

}

$currentTemplate = CSS::retrieveSome();

//TINYMCE ---------------------------
 $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
 $allowedTags.='<li><ol><ul><span><div><br><ins><del>';
?>
<!DOCTYPE html>
<html>
<head>

    <title>EDIT: <?php echo $Edit->getArticleName(); ?></title>
    <style type="text/css">
        <?php
            foreach ($currentTemplate as $activeCSS)
            {
            echo $activeCSS->getCssSnippet();
            }?>
    </style>

    <script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea"
        });
    </script>
</head>
<body>
    <h1>Edit Yo</h1>
    <?php

    //TODO Title, Desc, html Snippet
    ?>
    <form method="post" action="updateArticle.php">
        <label for="title">Title</label><br />
        <input type="text" id ="title" name="title" value="<?php echo $Edit->getArticleTitle(); ?>" required /><br /><br />
        <label for="desc">Description</label><br />
        <input type="text" id ="desc" name="desc" value="<?php echo $Edit->getArticleDesc(); ?>" /><br /><br />
        <label for="snip">Snippet</label><br />
        <div style="width:1200px;">
        <textarea name="snip" id="snip" rows="15" cols="50" required><?php echo $Edit->getHtmlSnippet(); ?></textarea><br /><br />
        </div>
        <input type="hidden" name="id" id="id" value="<?php echo $articleEditID ?>">
        <input type="hidden" name="name" id="name" value="<?php echo $Edit->getArticleName(); ?>">
        <label for="page">Page: </label>
        <input type="text" id="page" name="page" value="<?php echo $Edit->getArticlePage(); ?>" required /><br /><br />
        <label for="area">Area: </label>
        <input type="text" id="area" name="area" value="<?php echo $Edit->getContentArea(); ?>" required /><br /><br />
        <button type="submit">Submit</button><br />
    </form>

    <form method="post" action="updateArticle.php">
    <br/>
        <h3>Delete Article</h3>
        <input type="hidden" name="idDelete" id="idDelete" value="<?php echo $articleEditID ?>">
        <button type="submit">Delete</button>
    </form>
    <br /><a href="../Presentation/index.php">Home</a>
</body>
</html>
