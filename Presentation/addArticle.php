<!DOCTYPE html>
<html>
<head>
    <?php
    // WARNING: PSEUDO_CODE ONLY
    error_reporting(0);
    ob_start();
    session_start();

    require_once '../presentation/login_success.php';
    validLogin();

    // this may be a presentation page in 3-tier
    // or a view in MVC

    // obtain/receive the current page ($currentPage)
    // using GET from the nav or if none than default page

    // obtain/receive the active style/template ($currentTemplate)
    //add requires here
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
        //TODO remove this section. FOR TESTING ONLY
        $articleEditID = 1;
        $Edit = Article::GetArticle($articleEditID);
    }

    $currentTemplate = CSS::retrieveSome();

    $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
    $allowedTags.='<li><ol><ul><span><div><br><ins><del>';
    ?>
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
    <h1>Add Article</h1>
    <form method="post" action="addingArticle.php" >
        <label for="title">Title</label><br />
        <input type="text" id ="title" name="title"  required /><br /><br />
        <label for="desc">Description</label><br />
        <input type="text" id ="desc" name="desc"  /><br /><br />
        <label for="snip">Snippet</label><br />
        <div style="width:1200px;">
        <textarea name="snip" id="snip" ></textarea><br /><br />
        </div>
        <input type="hidden" name="id" id="id">
        <label for="page">Name: </label>
         <input type="text" id="name" name="name" required /><br /><br />
        <label for="page">Page: </label>
        <input type="text" id="page" name="page" required /><br /><br />
        <label for="area">Area: </label>
        <input type="text" id="area" name="area" required /><br /><br />

        <button type="submit">Submit</button>
    </form>

    <br /><a href="../Presentation/index.php">Home</a>
</body>
<?php  ob_end_flush();?>
</html>
