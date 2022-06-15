<?php
/*Template Name: Menus*/

$paged = get_query_var('paged'); // récupère la page actuelle

$args = array(
	'post_type' => 'menu',
	'posts_per_page' => 2,
	'paged' => $paged,
);

$menus = new WP_Query($args);

get_header();
?>

<h1>Menus</h1>
<?php if($menus->have_posts()) : ?>
	<?php while($menus->have_posts()) : $menus->the_post(); ?>
		<a href="<?php the_permalink(); ?>">
			<img src="<?php the_field('image'); ?>" alt="<?php the_title(); ?>">
			<h2><?php the_title(); ?></h2>
			<div>
				<div>
					<?php $ingredients = get_field('composition'); ?>
						<?php foreach ($ingredients as $ingredient) : ?>
							<?= $ingredient['ingredient'] ?>
						<?php endforeach; ?>
				</div>
				<div><?php the_field('prix'); ?>€</div>
			</div>
		</a>
	<?php endwhile; ?>
	
	<div class="paginiation">
		<?php previous_posts_link('Page précédente'); ?>
		<?php next_posts_link('Page suivante', $menus->max_num_pages); ?>
	</div>

<?php endif; ?>
	
		
<?php
get_footer();



