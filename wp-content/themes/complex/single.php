<?php get_header(); ?>
<section class="hero">
    <div class="hero__item">
        <div class="hero__image">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
        </div>
        <div class="hero__text">
            <div class="container">
                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(); ?>
                <h3><?php the_title(); ?></h3> 
            </div>
        </div>
    </div>
</section>



<div class="single-content">
    <div class="container">

        <?php the_content(); ?>

    </div>
</div>
 

<style>
.hero__text:after {
    display: none;
}
.hero__text h3 {
    font-size: 6rem;
} 
</style>



<?php get_template_part( 'parts/price-politic' ); ?>

<?php get_footer(); ?>