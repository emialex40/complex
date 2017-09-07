<?php /*Template name: Projects*/  ?>
<?php get_header(); ?>

    <section class="hero">
        <div class="hero__item">
            <div class="hero__image">
                <img src="<?php bloginfo('template_url'); ?>/build/img/hero.jpg" alt="">
            </div>
            <div class="hero__text">
                <div class="container">
                    <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                    <h3>Наши проекты</h3>
                    <h4>это доказательство высоких стандартов и<br> гарантий, которые мы заявляем</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container"> 
            <div class="services__content services__content--projects">

                
                <?php
                    $args = array(
                        'numberposts' => -1, 
                        'orderby'     => 'date',
                        'order'       => 'DESC',  
                        'post_type'   => 'project', 
                    );
                    $posts = get_posts( $args );
                    foreach($posts as $post){ setup_postdata($post);
                ?>
                    <a class="services__item services__item--project" href="<?php the_permalink(); ?>" style="<?php echo get_the_post_thumbnail_url(); ?>" >
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
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/1024px-Aeroc_Logo.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/1200px-Leroy_Merlin.svg.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/abcfa7e550e0203a5451cf31c2b1d542.jpg" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/logo_auchan.jpg" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/logo_eridon(jpeg).jpg" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/ukrorgcintez.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/vd_grup.jpg" alt=""></span></div>
              <!--   <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/google.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/google.png" alt=""></span></div>
                <div class="clientLogo__item"><span><img src="<?php bloginfo('template_url'); ?>/build/img/logo_partner/google.png" alt=""></span></div> -->
            </div>
        </div>
    </section>

    <section class="banner">
        <div class="container">
            <div class="section__title">Качество превыше всего</div>
            <h4>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек.</h4>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <div class="section__title">Выгодная ценовая политика</div>
            <div class="cta__text">За 9 лет рообты мы отстроили в компании результативную систему менеджмента, роботаем по европейским стандартам, обеспечили процесс постоянной оптимизации — это все позволяет нам продавать наши услуги по самым доступным ценам в Украине</div>
            <div class="buttons_group">
                <button class="button button--gold">Перейти в каталог продукции</button>
                <button class="button">Скачать прайс-лист</button>
            </div>
        </div>
    </section>

    <section class="bePartners">
        <div class="container">
            <div class="bePartners__content">
                <div class="bePartners__left">
                    <div class="bePartners__title">Сделать заказ</div>
                    <div class="beParnters__list">
                        <p>+ Бесплатная консультация</p>
                        <p>+ Формируем заказ в течении 3 дней</p>
                    </div>
                    <div class="bePartners__footer">
                        <span>+380 56 409 65 87</span>
                        <button class="button button--gold">Отправить зявку</button>
                    </div>
                </div>
                <div class="bePartners__right">
                    <div class="bePartners__title">Стать партнером</div>
                    <div class="beParnters__list">
                        <p>+ Эксклюзивные условия</p>
                        <p>+ Отлаженные поставки</p>
                    </div>
                    <div class="bePartners__footer">
                        <span>+380 56 409 65 90</span>
                        <button class="button">Отправить зявку</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <?php
        $args = array(
            'numberposts' => 1, 
            'orderby'     => 'date',
            'order'       => 'DESC',  
            'post_type'   => 'post', 
        );
        $posts = get_posts( $args );
        foreach($posts as $post){ setup_postdata($post);
    ?>

    <section class="cta lastArticle">
        <div class="container">
            <div class="section__title"><?php the_title(); ?></div>
            <div class="cta__text"><?php the_excerpt(); ?></div> 
            <div class="lastArticle__image">
                <img src="<?php bloginfo('template_url'); ?>/build/img/hero.jpg" alt="">
            </div>
        </div>
    </section>

    <?php } wp_reset_postdata(); ?>


<?php get_footer(); ?>