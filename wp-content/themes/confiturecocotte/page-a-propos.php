<?php get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
		the_content();
	endwhile;
endif;
?>


<?php
function shortcode_filtre_articles() {
    ob_start();

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
?>

<?php get_footer(); ?>