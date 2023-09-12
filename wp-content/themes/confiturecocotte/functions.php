<?php

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support('title-tag');


function enqueue_theme_styles()
{
    wp_enqueue_style('main-css', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

function create_confiture_cpt()
{
    $labels = array(
        'name' => _x('Confitures', 'Post Type General Name'),
        'singular_name' => _x('Confiture', 'Post Type Singular Name'),
        'menu_name' => __('Confitures'),
        'name_admin_bar' => __('Confiture'),
    );

    $args = array(
        'label' => __('Confiture'),
        'description' => __('Toutes nos confitures artisanales'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('confiture', $args);
}

add_action('init', 'create_confiture_cpt', 0);

function create_confiture_category_taxonomy()
{
    $labels = array(
        'name'              => _x('Catégories de Confiture', 'taxonomy general name'),
        'singular_name'     => _x('Catégorie de Confiture', 'taxonomy singular name'),
        'search_items'      => __('Rechercher des Catégories de Confiture'),
        'all_items'         => __('Toutes les Catégories de Confiture'),
        'parent_item'       => __('Parent Catégorie de Confiture'),
        'parent_item_colon' => __('Parent Catégorie de Confiture:'),
        'edit_item'         => __('Éditer la Catégorie de Confiture'),
        'update_item'       => __('Mettre à jour la Catégorie de Confiture'),
        'add_new_item'      => __('Ajouter une nouvelle Catégorie de Confiture'),
        'new_item_name'     => __('Nom de la nouvelle Catégorie de Confiture'),
        'menu_name'         => __('Catégories de Confiture'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categorie-confiture'),
    );

    register_taxonomy('categorie_confiture', array('confiture'), $args);
}

add_action('init', 'create_confiture_category_taxonomy', 0);

function filter_confitures_by_category($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_post_type_archive('confiture')) {
        $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);

        if (!empty($category)) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'categorie_confiture',
                    'field'    => 'slug',
                    'terms'    => $category,
                ),
            ));
        } elseif (empty($category)) {
            $query->set('tax_query', '');
        }
    }
}

add_action('pre_get_posts', 'filter_confitures_by_category');


function custom_post_type_shortcode($atts)
{
    ob_start();

    $defaults = array(
        'post_type' => 'confiture',
        'posts_per_page' => 4, 
    );

    $args = shortcode_atts($defaults, $atts);
    $custom_posts = new WP_Query($args);

    if ($custom_posts->have_posts()) :
        echo '<div class="custom-post-mea-confiture">';

        while ($custom_posts->have_posts()) :
            $custom_posts->the_post();

            // Récupérer l'URL de l'image depuis le champ ACF "image"
            $confiture_image = get_field('image');

            // Récupérer les autres champs personnalisés
            $confiture_name = get_the_title();
            $confiture_price = get_post_meta(get_the_ID(), 'prix', true);
?>

            <div class="card custom-post">
                <a href="<?php the_permalink(); ?>">
                    <div class="card-image">
                        <img src="<?php echo esc_url($confiture_image['url']); ?>" alt="<?php echo esc_attr($confiture_name); ?>">
                        <div class="overlay"></div>
                        <div class="view-icon"><i class="fa fa-plus-circle"></i></div>
                        <div class="fav-heart">&#10084;</div>
                    </div>
                    <div class="card-body card-bottom">
                        <div class="card-title">
                            <h2><?php echo esc_html($confiture_name); ?></h2>
                        </div>
                        <div class="card-excerpt confiture-price">
                            <p><?php echo esc_html($confiture_price); ?></p>
                        </div>
                    </div>
                </a>
            </div>
    <?php
        endwhile;

        echo '</div>'; // Fermer le conteneur ici

        wp_reset_postdata();
    endif;

    return ob_get_clean();
}
add_shortcode('custom_post_type_mea', 'custom_post_type_shortcode');


function shortcode_filtre_categories_et_articles()
{
    ob_start();

    ?>
    <form action="" method="GET">
        <div>
            <button type="submit" name="category" value="">Toutes les catégories</button>
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => false,
            ));

            foreach ($terms as $term) {
                $boutons_categorie = (isset($_GET['category']) && $_GET['category'] === $term->slug) ? 'selected' : '';
                echo '<button type="submit" name="category" value="' . $term->slug . '" ' . $boutons_categorie . '>' . $term->name . '</button>';
            }
            ?>
        </div>
    </form>
<?php

    // Affichage des articles filtrés
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $args = array(
        'category_name' => $category,
        'post_type' => 'post',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            the_title();
            the_content();
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Aucun article trouvé dans cette catégorie.';
    endif;

    return ob_get_clean();
}

add_shortcode('filtre_categories_et_articles', 'shortcode_filtre_categories_et_articles');
