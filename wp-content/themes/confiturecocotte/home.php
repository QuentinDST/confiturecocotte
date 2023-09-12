<?php get_header(); 
?>

<main class="article-page">

 <h1>L'actu Confiture Cocotte et nos idées recettes</h1>

<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        the_title('<h2>', '</h2>');
        the_content();
    endwhile;
else :
    echo 'Aucun article trouvé.';
endif;
?>

   
</main>


<?php get_footer(); ?>