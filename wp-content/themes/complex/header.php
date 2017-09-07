<!doctype html>
<html itemscope itemtype="https://schema.org/">
<head>

    <meta charset="utf-8">

    <?php if ( is_home() ) { ?>
        <title>IP Комплекс</title>
    <?php } else { ?>
    <title><?php single_cat_title() || the_title(); ?></title>
    <?php }  ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/fi.png">



    <!-- FACEBOOK -->
    <!--<meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">-->

     <!-- CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/build/css/style.css">

    <?php wp_head(); ?>

</head>
<body>

    <header>
        <div class="container">
            <div class="logo">
                <a href="/">
                    <img src="<?php bloginfo('template_url'); ?>/build/img/logo.svg" alt="">
                </a>
            </div>
            <div class="menu menu__top">
                <ul>
                    <li><a class="hoHover" href="#"><span>м. Київ, вул. Авіаконструктора Антонова, 2/32,корп. 4А</span></a></li>
                    <li><a class="hoHover" href="#"><span>(044) 227 80 95</span></a></li>
                    <li><a class="hoHover" href="#"><span>(044) 337 03 05</span></a></li>
<li>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'ru', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</li>
                </ul>


            </div>
            <div class="menu menu__bottom"> 
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu',
                        'container' => ''
                    ));
                ?>
            </div>
            
            <div id="nav-toggle"><span></span></div>
        </div>
    </header>