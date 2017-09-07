<?php /* Template name: Tenders */  ?>
<?php get_header(); ?>

    <section class="hero hero__page">
        <div class="hero__item">
            <div class="hero__image">
                <img src="<?php bloginfo('template_url'); ?>/build/img/hero.jpg" alt="">
            </div>
            <div class="hero__text">
                <div class="container">
                    <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                    <h3>Тендеры и закупки</h3>
                    <h4>Актуальные тендеры и закупки</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="pageContent">
        <div class="container">
            <div class="documents__content">
                <div class="documents__left">
                    <?php

                    // $cat = $_GET['cat'] ? $_GET['cat'] : 0;

                     
                        $args = array(
                            'numberposts' => -1, 
                            'orderby'     => 'date',
                            'order'       => 'DESC',  
                            'post_type'   => 'tenders'
                        );
                        if ($_GET['cat']) {
                            $args['category'] = $cat;
                        } 
                        $posts = get_posts( $args );
                        foreach($posts as $post){ setup_postdata($post);
                    ?>
                    <div class="documents__item">
                        <div class="documents__title documents__title--arrow">
                            <?php the_title(); ?>
                        </div>
                        <div class="documents_description">
                            <?php the_content(); ?>
                        </div>
                        <div class="documents__link documents__link--noBG">
                            <span class="button--underline"><?php the_field('phone'); ?></span>
                        </div>
                    </div>

                    <?php } wp_reset_postdata(); ?>

                </div>
                <div class="documents__right">
                    <div class="lidebar__list">
                        <ul> 
 
                            
                            <?php  
                                $args = array(
                                    'type'         => 'tenders', 
                                    'orderby'      => 'name',
                                    'order'        => 'ASC',
                                    'hide_empty'   => 0,  
                                    'taxonomy'     => 'category',
                                    'pad_counts'   => false, 
                                );
                                $categories = get_categories( $args );
                                if( $categories ){
                                    foreach( $categories as $cat ){
                            
                            ?>
                            <li><a class="<?php echo ($cat->term_id == $_GET['cat']) ? 'active' : ''; ?>" href="./?cat=<?=$cat->term_id ?>"><?=$cat->name ?></a></li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
<?php get_footer(); ?>