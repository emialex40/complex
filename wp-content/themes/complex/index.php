<?php get_header(); ?>

    <section class="hero">
        <div class="hero__item">
            <div class="hero__image"   data-zs-src='["<?php bloginfo('template_url'); ?>/build/img/1.png","<?php bloginfo('template_url'); ?>/build/img/2.png"]' data-zs-speed="15000">
                <!--<img src="<?php bloginfo('template_url'); ?>/build/img/1.png" alt="">-->
            </div>
            <div class="hero__text">
                <div class="container">
                    <h3>10 лет</h3>
                    <h4>производим высококачественные <br>системы безопасности</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <div class="section__title">
                Наши услуги
            </div>
            <div class="services__content"> 
            <?php
                $args = array( 'child_of' => 0, 'parent' => 73 );
                $pages = get_pages( $args );
                foreach( $pages as $post ){ setup_postdata( $post );
            ?>

                <a href="<?php the_permalink();?>" class="services__item" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                    <!-- <?php the_post_thumbnail(); ?> -->
                    <p><?php the_title(); ?></p>
                </a> 

                
            <?php } wp_reset_postdata(); ?>
            
            </div>
        </div>
    </section>

    <section class="facts">
        <div class="container">
            <div class="facts__content">
                <div class="facts__item">
                    <div class="section__title section__title--small">9 лет</div>
                    производим высококачественные системы безопасности
                </div>
                <div class="facts__item">
                    <div class="section__title section__title--small">30</div>
                    успешно реализованных проектов
                </div>
                <div class="facts__item">
                    <div class="section__title section__title--small">1000 м<sup>2</sup></div>
                    придумать еще какое-то привлекательное число
                </div>
            </div>
        </div>
    </section>

    <section class="clientLogo">
        <div class="container">
            <div class="clientLogo__content">
                <div class="clientLogo__content-bg"></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/1024px-Aeroc_Logo.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/1200px-Leroy_Merlin.svg.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/abcfa7e550e0203a5451cf31c2b1d542.jpg" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/logo_auchan.jpg" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/logo_eridon(jpeg).jpg" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/ukrorgcintez.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/vd_grup.jpg" alt=""></span></div>
             <!--    <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/google.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/google.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/google.png" alt=""></span></div>
            </div> -->

                </div>
    </section>

    <section class="banner">
        <div class="container">
            <div class="section__title">Качество превыше всего</div>
            <h4>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек.</h4>
        </div>
    </section>

    <?php get_template_part( 'parts/price-politic' ); ?>

    

    <?php
        // $args = array(
        //     'numberposts' => 1, 
        //     'orderby'     => 'date',
        //     'order'       => 'DESC',  
        //     'post_type'   => 'post', 
        // );
        // $posts = get_posts( $args );
        // foreach($posts as $post){ setup_postdata($post);
    ?>

    <!--<section class="cta lastArticle">
        <div class="container">
            <div class="section__title"><?php the_title(); ?></div>
            <div class="cta__text"><?php the_excerpt(); ?></div> 
            <div class="lastArticle__image">
                <img src="<?php bloginfo('template_url'); ?>/build/img/3.png" alt="">
            </div>
        </div>
    </section>-->

    <?php // } wp_reset_postdata(); ?>


<?php get_footer(); ?>