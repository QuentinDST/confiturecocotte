<?php get_header(); ?>

<main class="product-page">
	<?php if (have_posts()) : while (have_posts()) : the_post();
			$image = get_field('image');

	?>
			<div class="product-page__header">
				<h1 class="product__title"><?php the_title(); ?></h1>
			</div>

			<div class="product-content">
				<?php if ($image) : ?>
					<div class="product-image">
						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					</div>
				<?php endif; ?>

				<div class="product-details">

					<p class="product-description"><?php the_field('description'); ?></p>

					<p class="product-ingredients">
						<?php
						$ingredients = get_field('ingredients');

						if ($ingredients) :
							$ingredients_list = explode(' ', $ingredients);
							if (!empty($ingredients_list)) : ?>
					<p class="product-ingredients">Ingrédients:</p>
					<ul>
						<?php foreach ($ingredients_list as $ingredient) : ?>
							<li><?php echo esc_html($ingredient); ?></li>
						<?php endforeach; ?>
					</ul>
			<?php endif;
						endif;
			?>
			</p>

			<p class="product-price"><?php the_field('prix'); ?> €</p>

			<div class="product-quantity">
				Quantité: <input type="number" min="1" value="1">
				<button class="add-to-cart">Ajouter au panier</button>
			</div>
			</div>

			
			<section class="product-reviews">
				
			</section>

			<section class="related-products">
				
			</section>

	<?php endwhile;
	endif; ?>
</main>

<?php get_footer(); ?>