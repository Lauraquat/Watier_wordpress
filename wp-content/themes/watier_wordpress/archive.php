<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package watier_wordpress
 */


get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>
			
			<div class = "articles">
				<?php
				while ( have_posts() ) :
					the_post();
					$image = get_field('image');
					?>
					
					<div class="card">
						<h2><?php the_title(); ?></h2>
						<img class="image" src="<?php echo $image['url'] ?>" alt="<?php the_title(); ?>">
						<div>
							<p class="titre">Publication :</p><p><?= get_the_date(); ?></p>
							<p class="titre">Description :</p><p><?php the_field('description'); ?></p>
							<div class="center">
								<button class="more" onclick="window.location.href='<?php the_permalink(); ?>'">Lire la suite</button>
							</div>
						</div>
					</div>
					
				<?php
				endwhile;
				?>
			</div>
			
			<?php
			the_posts_navigation();

		else :

			?>
			<div class="articles">
                <div class="card">
					<h2><?php the_title(); ?></h2>
					<img class="image" src="<?php echo $image['url'] ?>" alt="<?php the_title(); ?>">
                    <div>
						<p class="titre">Publication : </p><p><?= get_the_date(); ?></p>
						<p class="titre">Description : </p><p><?php the_field('description'); ?></p>
                    </div>
                </div>
            </div>
			<?php

		endif;
		?>

	</main>