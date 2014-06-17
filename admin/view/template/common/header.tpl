<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <base href="<?php echo $base; ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <?php if ($description) { ?>
        <meta name="description" content="<?php echo $description; ?>" />
        <?php } ?>
        <?php if ($keywords) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <?php } ?>
        <?php foreach ($links as $link) { ?>
        <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
        <?php } ?>
        <meta name="author" content="Ahmet GOUDENOGLU">
        <!-- Bootstrap core CSS -->
        <link href="view/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="view/css/londinium-theme.css" rel="stylesheet" type="text/css">
        <link href="view/css/styles.css" rel="stylesheet" type="text/css">
        <link href="view/css/icons.css" rel="stylesheet" type="text/css">
        <link href="view/fonts/csscc26.css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        
        <!--<link type="text/css" href="view/js/jqueryui/themes/ui-lightness/jquery-ui.theme.css" rel="stylesheet" />-->
        <?php foreach ($styles as $style) { ?>
        <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
        <?php } ?>
        <script type="text/javascript" src="view/js/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="view/js/jqueryui/1.10.2/jquery-ui.min.js"></script>
        <?php foreach ($scripts as $script) { ?>
        <script type="text/javascript" src="<?php echo $script; ?>"></script>
        <?php } ?>
        <script type="text/javascript" src="view/js/common.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/daterangepicker.js"></script>
        <script type="text/javascript" src="view/javascript/jquery/jquery.cookie.js"></script>
        
        <script type="text/javascript" src="view/js/plugins/charts/sparkline.min.js"></script>

        <script type="text/javascript" src="view/js/plugins/forms/uniform.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/select2.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/inputmask.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/autosize.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/inputlimit.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/listbox.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/multiselect.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/validate.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/tags.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/switch.min.js"></script>

        <script type="text/javascript" src="view/js/plugins/forms/uploader/plupload.full.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/uploader/plupload.queue.min.js"></script>

        <script type="text/javascript" src="view/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/wysihtml5/toolbar.js"></script>

        <script type="text/javascript" src="view/js/globalize/globalize.js"></script>
        <script type="text/javascript" src="view/js/globalize/globalize.culture.de-DE.js"></script>
        <script type="text/javascript" src="view/js/globalize/globalize.culture.ja-JP.js"></script>

        <script type="text/javascript" src="view/js/plugins/interface/daterangepicker.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/fancybox.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/moment.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/mousewheel.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/jgrowl.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/datatables.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/colorpicker.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/fullcalendar.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/interface/timepicker.min.js"></script>

        <script type="text/javascript" src="view/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="view/js/application.js"></script>
        
        <script type="text/javascript" src="view/js/plugins/forms/uploader/plupload.full.min.js"></script>
        <script type="text/javascript" src="view/js/plugins/forms/uploader/plupload.queue.min.js"></script>
    </head>
    <body>
        <div id="filemanager"></div>
        <!-- Navbar -->
        <div class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo $home?>">SemitePAYMENT</a>
                <a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
                    <span class="sr-only">Toggle navbar</span>
                    <i class="icon-grid3"></i>
                </button>
                <button type="button" class="navbar-toggle offcanvas">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="icon-paragraph-justify2"></i>
                </button>
            </div>
            <?php if ($logged) { ?>
            <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-people"></i>
                        <span class="label label-default">2</span>
                    </a>
                    <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header">
                            <a href="#" class="pull-left"><i class="icon-spinner7"></i></a>
                            <span>Activity</span>
                            <a href="#" class="pull-right"><i class="icon-paragraph-justify"></i></a>
                        </div>
                        <ul class="activity">
                            <li>
                                <i class="icon-cart-checkout text-success"></i>
                                <div>
                                    <a href="#">Eugene</a> ordered 2 copies of <a href="#">OEM license</a>
                                    <span>14 minutes ago</span>
                                </div>
                            </li>
                            <li>
                                <i class="icon-heart text-danger"></i>
                                <div>
                                    Your <a href="#">latest post</a> was liked by <a href="#">Audrey Mall</a>
                                    <span>35 minutes ago</span>
                                </div>
                            </li>
                            <li>
                                <i class="icon-checkmark3 text-success"></i>
                                <div>
                                    Mail server was updated. See <a href="#">changelog</a>
                                    <span>About 2 hours ago</span>
                                </div>
                            </li>
                            <li>
                                <i class="icon-paragraph-justify2 text-warning"></i>
                                <div>
                                    There are <a href="#">6 new tasks</a> waiting for you. Don't forget!
                                    <span>About 3 hours ago</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-paragraph-justify2"></i>
                        <span class="label label-default">6</span>
                    </a>
                    <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header">
                            <a href="#" class="pull-left"><i class="icon-spinner7"></i></a>
                            <span>Messages</span>
                            <a href="#" class="pull-right"><i class="icon-new-tab"></i></a>
                        </div>
                        <ul class="popup-messages">
                            <li class="unread">
                                <a href="#">
                                    <img src="<?php echo $avatar?>" alt="" class="user-face">
                                    <strong>Eugene Kopyov <i class="icon-attachment2"></i></strong>
                                    <span>Aliquam interdum convallis massa...</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="view/images/demo/users/face2.png" alt="" class="user-face">
                                    <strong>Jason Goldsmith <i class="icon-attachment2"></i></strong>
                                    <span>Aliquam interdum convallis massa...</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="view/images/demo/users/face3.png" alt="" class="user-face">
                                    <strong>Angel Novator</strong>
                                    <span>Aliquam interdum convallis massa...</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="view/images/demo/users/face4.png" alt="" class="user-face">
                                    <strong>Monica Bloomberg</strong>
                                    <span>Aliquam interdum convallis massa...</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="view/images/demo/users/face5.png" alt="" class="user-face">
                                    <strong>Patrick Winsleur</strong>
                                    <span>Aliquam interdum convallis massa...</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle">
                        <i class="icon-grid"></i>
                    </a>
                    <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header">
                            <a href="#" class="pull-left"><i class="icon-spinner7"></i></a>
                            <span>Tasks list</span>
                            <a href="#" class="pull-right"><i class="icon-new-tab"></i></a>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th class="text-center">Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="status status-success item-before"></span> <a href="#">Frontpage fixes</a></td>
                                    <td><span class="text-smaller text-semibold">Bugs</span></td>
                                    <td class="text-center"><span class="label label-success">87%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="status status-danger item-before"></span> <a href="#">CSS compilation</a></td>
                                    <td><span class="text-smaller text-semibold">Bugs</span></td>
                                    <td class="text-center"><span class="label label-danger">18%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="status status-info item-before"></span> <a href="#">Responsive layout changes</a></td>
                                    <td><span class="text-smaller text-semibold">Layout</span></td>
                                    <td class="text-center"><span class="label label-info">52%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="status status-success item-before"></span> <a href="#">Add categories filter</a></td>
                                    <td><span class="text-smaller text-semibold">Content</span></td>
                                    <td class="text-center"><span class="label label-success">100%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="status status-success item-before"></span> <a href="#">Media grid padding issue</a></td>
                                    <td><span class="text-smaller text-semibold">Bugs</span></td>
                                    <td class="text-center"><span class="label label-success">100%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>

                <li class="user dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $avatar?>" alt="">
                        <span><?php echo $fullname?></span>
                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right icons-right">
                        <li><a href="<?php echo $profile?>"><i class="icon-user"></i> <?php echo $text_profile?></a></li>
                        <li><a href="<?php echo $setting?>"><i class="icon-cog"></i> <?php echo $text_setting?></a></li>
                        <li><a href="<?php echo $logout?>"><i class="icon-exit"></i> <?php echo $text_logout?></a></li>
                    </ul>
                </li>
            </ul>
            <?php } ?>
        </div>
        <!-- /navbar -->

        <!-- Page container -->
        <div class="page-container">
            <?php if ($logged) { ?>
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-content">

                    <!-- User dropdown -->
                    <div class="user-menu dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo $avatar?>" alt="">
                            <div class="user-info">
                                <?php echo $fullname?>
                            </div>
                        </a>
                        <div class="popup dropdown-menu dropdown-menu-right">
                            <div class="thumbnail">
                                <div class="thumb">
                                    <img alt="" src="<?php echo $avatar?>">
                                    <div class="thumb-options">
                                        <span>
                                            <a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a>
                                            <a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a>
                                        </span>
                                    </div>
                                </div>

                                <div class="caption text-center">
                                    <h6><?php echo $fullname?></h6>
                                </div>
                            </div>

                            <ul class="list-group">
                                <li class="list-group-item"><i class="icon-pencil3 text-muted"></i> My posts <span class="label label-success">289</span></li>
                                <li class="list-group-item"><i class="icon-people text-muted"></i> Users online <span class="label label-danger">892</span></li>
                                <li class="list-group-item"><i class="icon-stats2 text-muted"></i> Reports <span class="label label-primary">92</span></li>
                                <li class="list-group-item"><i class="icon-stack text-muted"></i> Balance <h5 class="pull-right text-danger">$45.389</h5></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /user dropdown -->


                    <!-- Main navigation -->
                    <ul class="navigation">
                        <li id="dashboard"><a href="<?php echo $home?>"><span><?php echo $text_dashboard?></span> <i class="icon-screen2"></i></a></li>
                        <li id="application">
                            <a href="#"><span><?php echo $text_application?></span> <i class="icon-rating3"></i></a>
                            <ul>
                                <li id="content"><a href="#"><i class="icon-quill2"></i><span> <?php echo $text_content ?></span></a>
                                    <ul>
                                        <li id="content"><a href="<?php echo $content?>"><?php echo $text_content?></a></li>
                                        <li id="content_type"><a href="<?php echo $content_type?>"><?php echo $text_content_type?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li id="system">
                            <a href="#"><span><?php echo $text_system?></span> <i class="icon-cogs"></i></a>
                            <ul>
                                <li id="setting"><a href="<?php echo $setting?>"><i class="icon-cog"></i><span> <?php echo $text_setting?></span></a></li>
                                <li><a href="#"><i class="icon-insert-template"></i><span> <?php echo $text_design?></span></a>
                                    <ul>
                                        <li id="layout"><a href="<?php echo $layout?>"><?php echo $text_layout?></a></li>
                                        <li id="page"><a href="#"><span> <?php echo $text_pages ?></span></a>
                                            <ul>
                                                <li id="page"><a href="<?php echo $page?>"><?php echo $text_page?></a></li>
                                                <li id="block"><a href="<?php echo $block?>"><?php echo $text_block?></a></li>
                                                <li id="menu"><a href="<?php echo $menu?>"><?php echo $text_menu?></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="icon-users"></i><span> <?php echo $text_users?></span></a>
                                    <ul>
                                        <li id="user"><a href="<?php echo $user?>"><?php echo $text_user?></a></li>
                                        <li id="user_group"><a href="<?php echo $user_group?>"><?php echo $text_user_group?></a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="icon-earth"></i><span> <?php echo $text_localisations?></span></a>
                                    <ul>
                                            <li id="language"><a href="<?php echo $language?>"><?php echo $text_language?></a></li>
                                            <li id="currency"><a href="<?php echo $currency?>"><?php echo $text_currency?></a></li>
                                            <li id="country"><a href="<?php echo $country?>"><?php echo $text_country?></a></li>
                                            <li id="zone"><a href="<?php echo $zone?>"><?php echo $text_zone?></a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="icon-wrench2"></i><span> <?php echo $text_tool?></span></a>
                                    <ul>
                                        <li id="error_log"><a href="<?php echo $error_log?>"><?php echo $text_error_log?></a></li>
                                        <li id="backup"><a href="<?php echo $backup?>"><?php echo $text_backup?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /main navigation -->
                </div>
            </div>
            <!-- /sidebar -->
            <?php } ?>

