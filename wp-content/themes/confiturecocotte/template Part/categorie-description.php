<?php 
$term = get_queried_object();

if($term && property_exists($term, 'taxonomy') && $term->taxonomy == 'categorie_confiture') {
    $term_description = term_description($term->term_id);

    if($term_description):
    ?>
        <div class="term-description">
            <p><?php echo esc_html($term_description); ?></p>
        </div>
    <?php
    endif;
}
?>