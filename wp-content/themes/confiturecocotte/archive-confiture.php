<?php get_header(); ?>

<main class="main-archive-page">
    <div class="archive-title">
        <h1>Toutes Nos Confitures Artisanales</h1>
    </div>

    <div class="category-filter">
        <H2>Filtrer par catégorie</H2>
    </div>

    <?php
    // Récupération des termes de la taxonomie "categorie_confiture"
    $terms = get_terms(array(
        'taxonomy' => 'categorie_confiture',
        'hide_empty' => false,
    ));

    if ($terms && !is_wp_error($terms)) : ?>
        <div class="filter-container">
            <form action="" method="get">
                <div class="button-wrapper">
                    <button type="submit" name="category" value="" <?php echo (isset($_GET['category']) && $_GET['category'] == '') ? 'class="active"' : ''; ?>>Toutes</button>

                    <?php foreach ($terms as $term) : ?>

                        <button type="submit" name="category" value="<?php echo $term->slug; ?>" <?php echo (isset($_GET['category']) && $_GET['category'] === $term->slug) ? 'class="active"' : ''; ?>><?php echo $term->name; ?></button>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <!-- Cartes de produits -->
    <div class="custom-post-mea-confiture">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                $image = get_field('image');
                $title = get_the_title();
                $price = get_field('prix');
        ?>
                <div class="card custom-post">
                    <a href="<?php echo get_permalink(); ?>">
                        <div class="card-image">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" />
                            <div class="overlay"></div>
                            <div class="view-icon"><i class="fa fa-plus-circle"></i></div>
                            <div class="fav-heart">&#10084;</div>
                        </div>
                        <div class="card-body card-bottom">
                            <div class="card-title">
                                <h2><?php echo esc_html($title); ?></h2>
                            </div>
                            <div class="card-excerpt confiture-price">
                                <p><?php echo esc_html($price); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>