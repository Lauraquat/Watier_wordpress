<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package watier_wordpress
 */

$image = get_field('image');

get_header();
?>

	<main id="primary" class="site-main">
		<div class="card">
			<h1><?php the_title(); ?></h1>
			<img class="image" src="<?= $image['url'] ?>" alt="<?php the_title(); ?>">
			<p class="titre">Publication :</p><p><?= get_the_date(); ?></p>
			<p class="titre">Description :</p><p><?php the_field('description'); ?></p>
			<p class="titre">Contenu :</p><p><?php the_field('contenu'); ?></p>
		</div>

		<?php
		the_post_navigation(
			[
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Article précédent :', 'watier_wordpress' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Article suivant :', 'watier_wordpress' ) . '</span> <span class="nav-title">%title</span>',
			]
		);
		?>

	</main>