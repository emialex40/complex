<?php /* Template name: Contact  */  ?>
<?php get_header(); ?>
<section class="hero hero__page">
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
 <div class="container">
     <div class="contact__content">
         <div class="contact__left">
             <div class="contact_item">
                <div class="contact__title">
                    Киев
                </div>
                <div class="contact__info">
                    <div class="label__info">Адрес</div>
                    03186, г. Киев, ул. Авиаконструктора Антонова 2/32, корп. 4А
                </div>
                <div class="contact__info">
                    <div class="label__info">График работы:</div>
                    Пн-Пт, с 9:00 до 19:00
                </div>
                <div class="contact__info">
                    <div class="label__info">Телефон</div>
                    +38 (044) 227-80-95<br> +38 (044) 337-03-05
                </div>
                <div class="contact__info">
                    <div class="label__info">E-mail</div>
                     ircomplex@ircomplex.com
                </div>
                <div class="contact__info map" id="map"></div>
            </div>
         </div>
         <div class="contact__right">
             <?php echo do_shortcode('[contact-form-7 id="170" title="Контактная форма 1"]'); ?>
         </div>
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


 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8sJycCPu7fSKzmd8fBbCB0y99WxwHykY" async defer></script>
<?php get_footer(); ?>