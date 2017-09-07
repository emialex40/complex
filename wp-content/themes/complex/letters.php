<?php /*Template name: Letters*/  ?>

<?php get_header(); ?>

    <section class="hero hero__page">
        <div class="hero__item">
            <div class="hero__image">
                <img src="<?php bloginfo('template_url'); ?>/build/img/hero.jpg" alt="">
            </div>
            <div class="hero__text">
                <div class="container">
                    <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                    <h3>Рекомендательные письма</h3> 
                </div>
            </div>
        </div>
    </section>

    <div class="pageContent">
        <div class="container">
            <div class="license__content">
                <?php
                    $args = array(
                        'numberposts' => -1, 
                        'orderby'     => 'date',
                        'order'       => 'DESC',  
                        'post_type'   => 'letters', 
                    );
                    $posts = get_posts( $args );
                    foreach($posts as $post){ setup_postdata($post);
                ?>

                <div class="license__item">
                    <div class="license__image"><span>
                        <?php the_post_thumbnail(); ?>    
                    </span></div>
                    <div class="license__text">
                        <p>Рекомендательное письмо</p>
                        <?php the_title(); ?>
                    </div>
                    <div class="images" style="display: none;">
                        <?php the_content(); ?>
                    </div>
                </div>

                <?php } wp_reset_postdata(); ?>

            </div>
        </div>
    </div>
    

    <div id="gallery">

    </div>
    

<?php get_footer(); ?>