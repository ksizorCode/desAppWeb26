<? get_header() ?>

<!-- sumario -->
<div class="sumario">
    <?php if (have_posts()):
        // si hay noticias hace un bucle mostrando cada una de ellas
        while (have_posts()):
            the_post(); ?>
            <!-- plantilla de articulo para cada artículo -->
            <article>
                <a href="<?php the_permalink(); ?>">
                <!-- imagen en miniatura / thumbnail -->
                <?php if (has_post_thumbnail()): // si el artículo tiene imagen en miniatura ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); // Puedes usar 'thumbnail', 'medium', 'large' o 'full' ?>
                    </div>
                <?php endif; ?>
                <!-- texto del artículo -->
                 <div>
                <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
                </a>
                </div>
            </article>
        <?php endwhile; else: ?>
        <p>No hay contenido disponible.</p>
    <?php endif; ?>

</div>
<!-- fin de sumario -->
<?php get_footer(); ?>
