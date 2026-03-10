<?php
/**
 * archive-comic.php
 * Listado de todos los comics (con filtros por taxonomía)
 * Colócala en la raíz de tu tema (o tema hijo)
 */

get_header(); ?>

<main class="comic-archivo">

    <!-- ================================
         CABECERA DEL ARCHIVO
    ================================ -->
    <header class="comic-archivo__cabecera">

        <?php if ( is_tax() ) : ?>
            <!-- Página de una taxonomía concreta: ej. /comic-autor/frank-miller/ -->
            <h1><?php single_term_title(); ?></h1>
            <?php if ( term_description() ) : ?>
                <div class="comic-archivo__descripcion">
                    <?php echo wp_kses_post( term_description() ); ?>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <!-- Página de archivo general: /comics/ -->
            <h1>Comics</h1>
        <?php endif; ?>

    </header>


    <!-- ================================
         FILTROS POR TAXONOMÍA
    ================================ -->
    <nav class="comic-filtros">

        <?php
        // Lista de taxonomías que queremos mostrar como filtro
        $filtros = array(
            'comic_universo'  => 'Universo',
            'comic_editorial' => 'Editorial',
            'comic_serie'     => 'Serie',
            'comic_autor'     => 'Autor',
            'comic_anio'      => 'Año',
        );

        foreach ( $filtros as $tax => $label ) :
            $terminos = get_terms( array( 'taxonomy' => $tax, 'hide_empty' => true ) );
            if ( empty( $terminos ) || is_wp_error( $terminos ) ) continue;
        ?>

            <div class="comic-filtros__grupo">
                <span class="comic-filtros__label"><?php echo esc_html( $label ); ?></span>
                <ul class="comic-filtros__lista">
                    <?php foreach ( $terminos as $termino ) :
                        $activo = is_tax( $tax, $termino->slug ) ? 'comic-filtros__item--activo' : '';
                    ?>
                        <li class="comic-filtros__item <?php echo esc_attr( $activo ); ?>">
                            <a href="<?php echo esc_url( get_term_link( $termino ) ); ?>">
                                <?php echo esc_html( $termino->name ); ?>
                                <span class="comic-filtros__count">(<?php echo (int) $termino->count; ?>)</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php endforeach; ?>

    </nav><!-- .comic-filtros -->


    <!-- ================================
         GRID DE COMICS
    ================================ -->
    <?php if ( have_posts() ) : ?>

        <div class="comic-grid">

            <?php while ( have_posts() ) : the_post(); ?>

                <article class="comic-card">

                    <!-- Portada -->
                    <a href="<?php the_permalink(); ?>" class="comic-card__imagen">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
                        <?php else : ?>
                            <div class="comic-card__sin-imagen">Sin portada</div>
                        <?php endif; ?>
                    </a>

                    <!-- Info -->
                    <div class="comic-card__info">

                        <h2 class="comic-card__titulo">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>

                        <!-- Mini ficha: solo autor y año -->
                        <?php
                        $autores = get_the_terms( get_the_ID(), 'comic_autor' );
                        $anios   = get_the_terms( get_the_ID(), 'comic_anio' );
                        ?>

                        <p class="comic-card__meta">
                            <?php if ( $autores && ! is_wp_error( $autores ) ) : ?>
                                <span><?php echo esc_html( $autores[0]->name ); ?></span>
                            <?php endif; ?>
                            <?php if ( $anios && ! is_wp_error( $anios ) ) : ?>
                                <span class="comic-card__anio"><?php echo esc_html( $anios[0]->name ); ?></span>
                            <?php endif; ?>
                        </p>

                    </div><!-- .comic-card__info -->

                </article><!-- .comic-card -->

            <?php endwhile; ?>

        </div><!-- .comic-grid -->

        <!-- ================================
             PAGINACIÓN
        ================================ -->
        <nav class="comic-paginacion">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '← Anterior',
                'next_text' => 'Siguiente →',
            ));
            ?>
        </nav>

    <?php else : ?>

        <p class="comic-sin-resultados">No se encontraron comics.</p>

    <?php endif; ?>

</main><!-- .comic-archivo -->

<?php get_footer(); ?>


<style>
    /* ---- Contenedor ---- */
.comic-archivo {
    max-width: 1100px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

/* ---- Cabecera ---- */
.comic-archivo__cabecera h1 {
    font-size: 2rem;
    margin-bottom: .5rem;
}
.comic-archivo__descripcion {
    color: #666;
    margin-bottom: 1.5rem;
}

/* ---- Filtros ---- */
.comic-filtros {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    background: #f5f5f5;
    padding: 1rem 1.25rem;
    border-radius: 6px;
    margin-bottom: 2rem;
}

.comic-filtros__label {
    display: block;
    font-weight: 700;
    font-size: .85rem;
    text-transform: uppercase;
    color: #444;
    margin-bottom: .4rem;
}

.comic-filtros__lista {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: .4rem;
}

.comic-filtros__item a {
    display: inline-block;
    padding: .2rem .7rem;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 20px;
    font-size: .85rem;
    color: #333;
    text-decoration: none;
    transition: background .2s, color .2s;
}

.comic-filtros__item a:hover,
.comic-filtros__item--activo a {
    background: #0073aa;
    color: #fff;
    border-color: #0073aa;
}

.comic-filtros__count {
    opacity: .65;
    font-size: .8rem;
}

/* ---- Grid ---- */
.comic-grid {
    display: grid;
    grid-template-columns: repeat( auto-fill, minmax( 180px, 1fr ) );
    gap: 1.5rem;
}

/* ---- Card ---- */
.comic-card {
    display: flex;
    flex-direction: column;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.12);
    transition: transform .2s, box-shadow .2s;
}

.comic-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0,0,0,.18);
}

.comic-card__imagen img {
    width: 100%;
    aspect-ratio: 2/3;
    object-fit: cover;
    display: block;
}

.comic-card__sin-imagen {
    width: 100%;
    aspect-ratio: 2/3;
    background: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    font-size: .85rem;
}

.comic-card__info {
    padding: .75rem;
    flex: 1;
}

.comic-card__titulo {
    font-size: 1rem;
    margin: 0 0 .3rem;
    line-height: 1.3;
}

.comic-card__titulo a {
    color: #111;
    text-decoration: none;
}

.comic-card__titulo a:hover {
    color: #0073aa;
}

.comic-card__meta {
    font-size: .8rem;
    color: #666;
    margin: 0;
    display: flex;
    justify-content: space-between;
}

.comic-card__anio {
    font-weight: 700;
    color: #0073aa;
}

/* ---- Paginación ---- */
.comic-paginacion {
    margin-top: 2.5rem;
    text-align: center;
}

/* ---- Sin resultados ---- */
.comic-sin-resultados {
    text-align: center;
    padding: 3rem;
    color: #999;
}
```

---

## Cómo funciona todo junto
```
/comics/                     → archive-comic.php  (grid completo)
/comics/?paged=2             → archive-comic.php  (página 2)
/comic-autor/frank-miller/   → archive-comic.php  (filtrado por autor)
/comic-universo/dc/          → archive-comic.php  (filtrado por universo)
/comics/batman-year-one/     → single-comic.php   (ficha individual)
</style>