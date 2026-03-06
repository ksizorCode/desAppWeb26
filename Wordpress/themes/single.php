<? get_header() ?>

<?php if (have_posts()):
    while (have_posts()):
        the_post(); ?>

        <article>
            <!-- Thumbnail -->
            <?php if (has_post_thumbnail()): ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); // Puedes usar 'thumbnail', 'medium', 'large' o 'full' ?>
                </div>
            <?php endif; ?>

            <!-- artículo texto-->
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_content(); ?>

        </article>
        
    <?php endwhile; else: ?>
    <p>No hay contenido disponible.</p>
<?php endif; ?>


<?php get_footer(); ?>