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
        <?php if(!$_GET && !$this->config->get('config_maintenance')) { ?>
        <div class="dark">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
      </ol>
      <div class="carousel-inner">
          <div class="item active">
          <img src="public/view/theme/semitepayment/img/examples/slide-03.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
                
              <h1>Pay with your Semite Payment Account</h1>
              <img src="public/view/theme/semitepayment/img/examples/semite-ccard.png" width="300">
              <p>Now you can Pay with your Semite Payment Account for your Online Shoppings.</p>
              <p><a class="btn btn-lg btn-primary" href="/register" role="button">Open an Account Now!</a></p>
            </div>
          </div>
        </div>
        <div class="item ">
          <img src="public/view/theme/semitepayment/img/examples/slide-01.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Accept Payments on Your Website</h1>
              <div class="col-md-6 pull-left">
                  <ul class="fancy">
                        <li>Accept All Major Cards</li>
                        <li>High Risk Tolerance</li>
                        <li>TMF Merchant Acceptance</li>
                        <li>Chargeback Flexibility</li>
                        <li>Internationals Welcome</li>
                        <li>Multi-Currency Settlement</li>
                        <li>Full PCI Compliance</li>
                  </ul>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
              </div>
              <div class="col-md-6">
                  <img src="public/view/theme/semitepayment/img/examples/design_10.png">
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="public/view/theme/semitepayment/img/examples/slide-02.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Accept Payments at Your Store</h1>
                  <img src="public/view/theme/semitepayment/img/examples/banner-1-object3.png" width="550">
                  <p>Start Accepting Online Payments with Semite Payment</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                  
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
            <div class="overlay">
    <div class="container subtle">
      <header class="section-block-header">
        <small class="section-block-header-topic">Trusted by Over 40,000 Businesses and Organizations</small> 
      </header>
      <div class="row-partner-logo">
        <img class="partner-logo wordpress" alt="WordPress.com" src="public/view/theme/semitepayment/img/logos/wordpress.png">
        <img class="partner-logo virgin" alt="Virgin" src="public/view/theme/semitepayment/img/logos/virgin.png">
        <img class="partner-logo gyft" alt="Gyft" src="public/view/theme/semitepayment/img/logos/gyft.png">
        <img class="partner-logo newegg" alt="NewEgg" src="public/view/theme/semitepayment/img/logos/newegg.png">
        <img class="partner-logo namecheap" alt="Namecheap" src="public/view/theme/semitepayment/img/logos/namecheap.png">
        <img class="partner-logo shopify" alt="Shopify" src="public/view/theme/semitepayment/img/logos/shopify.png">
        <img class="partner-logo tigerdirect" alt="TigerDirect" src="public/view/theme/semitepayment/img/logos/tigerdirect.png">
      </div>
    </div>
  </div>
        </div>
        <?php }?>
        