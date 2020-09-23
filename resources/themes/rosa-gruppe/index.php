<?php
if (!defined('THEMEPATH')) {
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Rosa Gruppe</title>

    <link rel="shortcut icon" href="<?php echo THEMEPATH; ?>/img/favicon.png" />

    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/nav.css" />
    <?php echo $gallery->getColorboxStyles(2); ?>

    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/nav.js"></script>
    <?php echo $gallery->getColorboxScripts(); ?>
    <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/touchswipe/jquery.touchSwipe.js"></script>
    <script type="text/javascript" src="<?php echo THEMEPATH; ?>/js/touchswipe-integration/swipecontrols.js"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php file_exists('googleAnalytics.inc') ? include('googleAnalytics.inc') : false; ?>
</head>

<body>
    <div class="overlay" onclick="closeNav()"></div>
    <div class="container">

        <div class="navbar <!--navbar-inverse-->">
            <div class="navbar-inner">
                <div class="container">
                    <img src="resources/themes/rosa-gruppe/img/duenenweg.png" id="icon" onclick="openNav()" alt="User Icon" width=100 style="float: left; margin: 10px; cursor:pointer;" />
                    <!-- off canvas button -->
<!--                    <span style="font-size:24px;cursor:pointer;float: left;" onclick="openNav()" >&#9776; open</span>-->
                    <!-- title -->
                    <div class="brand">
                        Rosa Gruppe - Kindergarten Dünenweg<br /><br /><br />
                        <?php if ($_GET['gallery']) { echo $_GET['gallery']; } else { ?>
                        &#9194; Auf das Logo klicken, um eine Gallerie zu wählen.
                        <?php } ?>
                    </div>
                    <!-- logout button -->
                    <form name="logout-form" method="post" action="/" style="float: right">
                        <input type="hidden" name="logout" value="logout" />
                        <div id="logout-btn" style="text-align: center; cursor: pointer; position: relative; top: 29px; line-height: 1" onclick="document.forms['logout-form'].submit();">
                            <span style="font-size: 50px;">&#8861;</span><br />
                            <span style="font-size: 14px">Logout</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="rosaSidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <?php
            foreach ($galleries as $galleryDir) {
                $title = substr($galleryDir, 8,2) . '.'
                    . substr($galleryDir, 5,2) . '.'
                    . substr($galleryDir, 0,4) . '<br />'
                    . substr($galleryDir, 11);
                echo sprintf('<a href="?gallery=%s">%s</a>', \urlencode($galleryDir), $title);
            }
            ?>
        </div>

        <?php if($gallery->getSystemMessages()): ?>
            <?php foreach($gallery->getSystemMessages() as $message): ?>
                <div class="alert alert-<?php echo $message['type']; ?>">
                    <a class="close" data-dismiss="alert">×</a>
                    <?php echo $message['text']; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($zip): ?>
            <div class="container">
                <div class="brand">
                    <a href="download.php?file=<?php echo $zip[0]; ?>">
                        <svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-file-earmark-zip-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM5.5 3V2h-1V1H6v1h1v1H6v1h1v1H6v1h1v1H5.5V6h-1V5h1V4h-1V3h1zm0 4.5a1 1 0 0 0-1 1v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1zm0 1.938V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z"/>
                        </svg>
                        Alle Bilder als ZIP-Datei herunterladen
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Start UberGallery v<?php echo UberGallery::VERSION; ?> - Copyright (c) <?php echo date('Y'); ?> Chris Kankiewicz (http://www.ChrisKankiewicz.com) -->
        <?php if (!empty($galleryArray) && $galleryArray['stats']['total_images'] > 0): ?>
            <ul class="gallery-wrapper thumbnails">
                <?php foreach ($galleryArray['images'] as $image): ?>
                    <li class="">
                        <a href="<?php echo html_entity_decode($image['file_path']); ?>" title="<?php echo $image['file_title']; ?>" class="thumbnail" rel="colorbox">
                            <img src="<?php echo $image['thumb_path']; ?>" alt="<?php echo $image['file_title']; ?>" />
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <!-- End UberGallery - Distributed under the MIT license: http://www.opensource.org/licenses/mit-license.php -->

        <hr/>


        <?php if ($galleryArray['stats']['total_pages'] > 1): ?>

            <div class="pagination pagination-centered">
                <ul>
                    <?php foreach ($galleryArray['paginator'] as $item): ?>

                        <?php

                            switch ($item['class']) {

                                case 'title':
                                    $class = 'disabled';
                                    break;

                                case 'inactive':
                                    $class = 'disabled';
                                    break;

                                case 'current':
                                    $class = 'active';
                                    break;

                                case 'active':
                                    $class = NULL;
                                    break;

                            }

                        ?>

                        <li class="<?php echo $class; ?>">
                            <a href="<?php echo empty($item['href']) ? '#' : $item['href']; ?>"><?php echo $item['text']; ?></a>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <p class="credit">Powered by <a href="http://www.ubergallery.net">UberGallery</a>, modified by <a href="http://www.hascha.de">hascha.de</a></p>

    </div>

</body>

<!-- Page template by, Chris Kankiewicz <http://www.chriskankiewicz.com> -->

</html>
