<!DOCTYPE html>
<html>
<script type='text/javascript'
        src='https://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js'></script>
<script type='text/javascript' src='../js/prototip.js'></script>

<link rel="stylesheet" type="text/css" href="../css/prototip.css" />
<head>
    <?php
    ob_start();
    session_start();
    // WARNING: PSEUDO_CODE ONLY
    // this may be a presentation page in 3-tier
    // or a view in MVC

    // obtain/receive the current page ($currentPage)
    // using GET from the nav or if none than default page

    // obtain/receive the active style/template ($currentTemplate)
    //add requires here
    require_once("../Business/CSS.php");
    require_once("../Business/Article.php");
    require_once("../Business/Page.php");
    require_once("../Business/Area.php");
    require_once("../Business/user.php");

    if(empty($_GET['page'])){
        $Page = Page::GetSinglePage(1);
    }
    else{
        $hold = $_GET['page'];
        $Page = Page::GetSinglePage($hold);
    }
    $currentPage = $Page->getPageID();


    $currentTemplate = CSS::retrieveSome();
    ?>
    <title><?php echo $Page->getPageName(); ?></title>
    <style type="text/css">
        <?php
            foreach ($currentTemplate as $activeCSS)
            {
            echo $activeCSS->getCssSnippet();
            }?>
    </style>
</head>
<body>
<?php



if(empty($_SESSION['myusername'])and empty($_SESSION['mypassword'])){ ?>
    <form name="form1" method="post" action="checklogin.php">
    Username <input name="myusername" type="text" id="myusername">
    Password: <input name="mypassword" type="password" id="mypassword">
    <input type="submit" name="Submit" value="Login">
 </form>
<?php
}
if(isset($_SESSION['myusername'])||isset($_SESSION['mypassword'])){
?>

<div id="User" class="demo" >

    <p>Logged in </p>

</div>

<form method="post" action="logout.php" >
<button type="submit">Logout</button>

   <?php
   $Priv = '3';
   $User = $_SESSION['myusername'];


   if(user::checkPrivileges($User,$Priv) == true){ ?>
<a href='addArticle.php'>Add Article</a>
   <?php
    }

}
?>




<nav>
    <ul>
        <?php
        // obtain/receive all page objects ($pageArray)
        $pageArray = Page::retrieveSome();

        /*               foreach ($pageArray as $page)
                        {
                            echo "<li>";
                            echo "<a href='index.php'>".$page->getPageName()."</a>";
                            echo "</li>";
                        }*/
        foreach ($pageArray as $page)
        {
            ?><li>
            <a href='index.php?page=<?php echo $page->getPageID()?>'><?php echo $page->getPageName(); ?></a>
            </li><?php
        }
        ?>
    </ul>
</nav>
<section>
    <?php
    // obtain/receive all content areas ($areaArray)
    // get them in ORDER
    $areaArray = Area::retrieveSome();

    foreach ($areaArray as $area)
    {

        $currentPage = $Page->getPageID();
        $currentArea = $area->getAreasID();

        $args[0] = $currentPage;
        $args[1] = $currentArea;

        $articleArray = Article::retrieveSome($args);
        if ($articleArray != "broke")
        {               echo "<div id='".$area->getAreasAlias()."'>";
            foreach ($articleArray as $article)
            {
                echo "<article id='".$article->getArticleTitle()."'>";
                    if(isset($_SESSION['myusername'])||isset($_SESSION['mypassword'])){

                 if(user::checkPrivileges($User,$Priv) == true){ ?>


                <a href='editArticle.php?articleID=<?php echo $article->getArticleID()?>'>Edit Article <?php echo $article->getArticleTitle()?></a>
                <?php }
                    }?>

               <h1><?php echo $article->getArticleTitle(); ?></h1>

               <?php echo $article->getHtmlSnippet();

                echo "</article>";
            }
            echo "</div>";
        }

    }

    ?>
</section>






    <script type="text/javascript" language="javascript">

        document.observe('dom:loaded', function() {
            new Tip('User', 'Signed in as: <?php echo $_SESSION['myusername'] ?> ',  {
                title: 'User Information',
                style: 'default',
                stem: 'topLeft',
                width: 130,
                hook: { tip: 'topLeft', mouse: true },
                offset: { x: 14, y: 14 }
            });

        });

        document.observe('dom:loaded', function() {
            new Tip('Album', 'The Name Album the Current song is on', {
                title: 'Album Name',
                style: 'default',
                stem: 'topLeft',
                width: 100,
                hook: { tip: 'topLeft', mouse: true },
                offset: { x: 14, y: 14 }
            });

        });
        document.observe('dom:loaded', function() {
            new Tip('Artist', '<?php ?>', {
                title: 'Song Artist',
                style: 'default',
                stem: 'topLeft',
                hook: { tip: 'topLeft', mouse: true },
                offset: { x: 14, y: 14 }
            });

        });
    </script>

    <script type="text/javascript" language="javascript">

        document.observe('dom:loaded', function() {
            new Tip('demo_simple2', 'A simple tooltip, nothing fancy just yet ..."', {
                title: 'This tooltip has a tisssssssssssssssssssssss',
                style: 'protoblue',
                stem: 'topLeft',
                hook: { tip: 'topLeft', mouse: true },
                offset: { x: 14, y: 14 }

            });

        });
    </script>








</body>
<?php  ob_end_flush();?>
</html>