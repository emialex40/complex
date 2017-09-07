    <div class="menu__mobile">
        <!--<div class="overlay"></div> -->
        <div class="menu">
            <ul class="mobileMenuList">
                <li class="logo_li"><img src="<?php bloginfo('template_url'); ?>/build/img/logo.png" alt=""></li>
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu',
                        'container' => '',
                        'items_wrap' => '%3$s'
                    ));
                ?>
                <li><a href="#"><span>м. Київ, вул. Авіаконструктора Антонова, 2/32,корп. 4А</span></a></li>
                <li><a href="#"><span>(044) 227 80 95</span></a></li>
            </ul>
        </div>
    </div>
    <footer>
        <div class="container text-right">
            <div>   </div>
            <div class="toTop" id="toTop">
                <span class="button button--transparent">вверх страницы</span>
            </div>
        </div>
        <div class="footer__content">
            <div class="container footerFlex">
                <div class="footer__item">
                    <p>Главный офис</p>
                    <span>03186, м. Київ, вул. Авіаконструктора Антонова, 2/32,корп. 4А</span>
                    <span>(044) 227 80 95</span>
                    <span>(044) 337 03 05</span>
                    <span>ircomplex@ircomplex.com</span>
                </div>
                <div class="footer__item">  
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'menu',
                                'container' => '', 
                            ));
                        ?>
                </div>
                <div class="footer__item">
                    <p>Продукция</p>
                    <p><a href="#"><span>Проектирование систем безопасности</span></a></p>
                    <p><a href="#"><span>Монтаж систем безопасности</span></a></p>
                    <p><a href="#"><span>Продажа материалов, оборудования</span></a></p> 
                </div>
            </div>
        </div>  
<?php
/*
        <div class="footerBottom">
            <div class="container footerFlex">
                <span>2017</span>
                <a href="//lako.agency/" target="_blank">
					<img src="//lako.agency/logo.svg" width="65px">
				</a>
            </div>
        </div>
		*/
?>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/build/js/jquery.plugins.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/build/js/scripts.min.js"></script>
    <?php wp_footer(); ?>
</body>
</html>