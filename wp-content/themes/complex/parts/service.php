<div class="container">
    <div class="page__content">
        <?php 
            $args = array('child_of' => 0, 'parent' => $post->ID); 
            $pages = get_pages( $args );
            foreach( $pages as $post ){ setup_postdata( $post );
        ?> 
                <div class="setvice__partTitle"><?php the_title(); ?></div>
                <div class="service_flex">
                <?php
 

                    $childs = get_pages( array('child_of' => 0, 'parent' => get_the_ID() ));
                    foreach( $childs as $post ){ setup_postdata( $post );                     
                ?>

                    <a class="setvice__itemTitle" href="<?php the_permalink(); ?>">
                        <img src="http://via.placeholder.com/220x220" width="220px">
                        <?php the_title(); ?>
                    </a>  
        <?php } wp_reset_postdata();?>                  
                </div><?php } wp_reset_postdata(); ?>

 
  
    </div>
</div> 