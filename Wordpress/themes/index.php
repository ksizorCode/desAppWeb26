<? get_header()?>
        
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            </article>
        <?php endwhile; else : ?>
            <p>No hay contenido disponible.</p>
        <?php endif; ?>


<?php get_footer(); ?>
