<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="<?php echo $base; ?>" />
        <?php if ($description) { ?>
        <meta name="description" content="<?php echo $description; ?>" />
        <?php } ?>
        <?php if ($keywords) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <?php } ?>
        <?php if ($icon) { ?>
        <link href="<?php echo $icon; ?>" rel="icon" />
        <?php } ?>
        <?php foreach ($links as $link) { ?>
        <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
        <?php } ?>
        <!-- CSS -->
        <link rel="stylesheet" media="screen" href="public/view/theme/semitepayment/css/public.css">
        <link href="public/view/theme/semitepayment/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" media="screen" href="public/view/theme/semitepayment/css/main.css">
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Ubuntu+Mono:700|Ubuntu:300,400,400italic,500' rel='stylesheet' type='text/css'>
        <?php foreach ($styles as $style) { ?>
        <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
        <?php } ?>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php echo $google_analytics; ?>
    </head>
    <body>
        <div class="dark">
            <div class="navbar" role="navigation">
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
                            <a href="<?php echo $home?>" title="<?php echo $name?>"><img style="padding: 0px 0px;" src="<?php echo $logo?>"/></a>
                        <?php } ?>
                    </div>
                    <?php if ($this->page->getPageHeader()) { ?>
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
                    <?php } ?>
                </div>
            </div>
        </div>
        