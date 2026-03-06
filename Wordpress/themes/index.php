<? get_header()?>
        <div class="sumario">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article>
                <?php if (has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
        <?php the_post_thumbnail('large'); // Puedes usar 'thumbnail', 'medium', 'large' o 'full' ?>
    </div>
<?php endif; ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            </article>
        <?php endwhile; else : ?>
            <p>No hay contenido disponible.</p>
        <?php endif; ?>

</div>
<?php get_footer(); ?>
