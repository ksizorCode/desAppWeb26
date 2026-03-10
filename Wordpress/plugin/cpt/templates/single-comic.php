<?php
/**
 * single-comic.php
 * Plantilla para mostrar un único comic
 * Colócala en la raíz de tu tema (o tema hijo)
 */

get_header(); ?>

<main class="comic-single">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="comic-<?php the_ID(); ?>">

        <!-- ================================
             PORTADA
        ================================ -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="comic-portada">
                <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
            </div>
        <?php endif; ?>


        <!-- ================================
             TÍTULO
        ================================ -->
        <h1 class="comic-titulo"><?php the_title(); ?></h1>


        <!-- ================================
             TAXONOMÍAS (ficha técnica)
        ================================ -->
        <div class="comic-ficha">

            <?php
            // Helper: muestra una fila de la ficha si la taxonomía tiene términos
            function comic_fila_taxonomia( $taxonomia, $etiqueta ) {
                $terminos = get_the_terms( get_the_ID(), $taxonomia );
                if ( $terminos && ! is_wp_error( $terminos ) ) :
                    echo '<div class="comic-ficha__fila">';
                    echo '<span class="comic-ficha__label">' . esc_html( $etiqueta ) . ':</span> ';
                    $links = array();
                    foreach ( $terminos as $termino ) {
                        $links[] = '<a href="' . esc_url( get_term_link( $termino ) ) . '">'
                                 . esc_html( $termino->name ) . '</a>';
                    }
                    echo '<span class="comic-ficha__valor">' . implode( ', ', $links ) . '</span>';
                    echo '</div>';
                endif;
            }
            ?>

            <?php comic_fila_taxonomia( 'comic_anio',       'Año' );        ?>
            <?php comic_fila_taxonomia( 'comic_autor',      'Autor' );      ?>
            <?php comic_fila_taxonomia( 'comic_serie',      'Serie' );      ?>
            <?php comic_fila_taxonomia( 'comic_universo',   'Universo' );   ?>
            <?php comic_fila_taxonomia( 'comic_editorial',  'Editorial' );  ?>
            <?php comic_fila_taxonomia( 'comic_personajes', 'Personajes' ); ?>

        </div><!-- .comic-ficha -->


        <!-- ================================
             SINOPSIS / CONTENIDO
        ================================ -->
        <?php if ( get_the_content() ) : ?>
            <div class="comic-sinopsis">
                <h2>Sinopsis</h2>
                <?php the_content(); ?>
            </div>
        <?php endif; ?>


    </article>

<?php endwhile; endif; ?>

</main><!-- .comic-single -->

<?php get_footer(); ?>


<style>
/* ---- Contenedor principal ---- */
.comic-single {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem 1rem;
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 2rem;
}

/* ---- Portada ---- */
.comic-portada img {
    width: 100%;
    border-radius: 6px;
    box-shadow: 0 4px 16px rgba(0,0,0,.25);
}

/* ---- Título ---- */
.comic-titulo {
    font-size: 2rem;
    margin: 0 0 1rem;
}

/* ---- Ficha técnica ---- */
.comic-ficha {
    display: flex;
    flex-direction: column;
    gap: .5rem;
    background: #f5f5f5;
    padding: 1rem 1.25rem;
    border-radius: 6px;
    margin-bottom: 1.5rem;
}

.comic-ficha__fila {
    font-size: .95rem;
}

.comic-ficha__label {
    font-weight: 700;
    color: #333;
}

.comic-ficha__valor a {
    color: #0073aa;
    text-decoration: none;
}

.comic-ficha__valor a:hover {
    text-decoration: underline;
}

/* ---- Sinopsis ---- */
.comic-sinopsis h2 {
    font-size: 1.2rem;
    margin-bottom: .5rem;
    border-bottom: 2px solid #eee;
    padding-bottom: .4rem;
}

/* ---- Responsive ---- */
@media ( max-width: 600px ) {
    .comic-single {
        grid-template-columns: 1fr;
    }
}
```

---

## Resultado visual
```
┌──────────────┬──────────────────────────────┐
│              │  Batman: Year One            │
│   [PORTADA]  │                              │
│              │  Año:        1987            │
│              │  Autor:      Frank Miller    │
│              │  Serie:      Batman          │
│              │  Universo:   DC              │
│              │  Editorial:  DC Comics       │
│              │  Personajes: Batman, Gordon  │
│              │                              │
│              │  Sinopsis                    │
│              │  ────────────────────────    │
│              │  Lorem ipsum...              │
└──────────────┴──────────────────────────────┘

</style>