<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="public/view/theme/default/ico/favicon.ico">

        <title>Jumbotron Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="public/view/theme/default/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Ubuntu+Mono:700|Ubuntu:300,400,400italic,500' rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="jumbotron.css" rel="stylesheet">
        <link href="public/view/theme/default/css/main.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="public/view/theme/default/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php if (!$logo) { ?>
                            <a class="navbar-brand" href="<?php echo $home?>" title="<?php echo $name?>"><?php echo $name?></a>
                            <?php } else { ?>
                            <a href="<?php echo $home?>" title="<?php echo $name?>"><img style="padding: 5px 0px;" src="<?php echo $logo?>"/></a>
                        <?php } ?>
                    </div>
                    <div class="navbar-collapse collapse">
                        <?php if ($leftmenus) { ?>
                        <ul class="nav navbar-nav">
                            <?php foreach ($leftmenus as $leftmenu) { ?>
                            <li class=""><a href="<?php echo $leftmenu['href']?>"><?php echo $leftmenu['title']?></a></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                        <?php if ($rightmenus) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <?php foreach ($rightmenus as $rightmenu) { ?>
                            <li class=""><a href="<?php echo $rightmenu['href']?>"><?php echo $rightmenu['title']?></a></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
        </div>