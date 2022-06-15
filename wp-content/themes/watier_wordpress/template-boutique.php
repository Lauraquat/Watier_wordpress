<?php
/*
* Template Name: Boutique
* Template Post Type: post, page
*/


get_header();
?>
<div class="boutique">
	<h1>Boutique</h1>
	<div class="constructeur_boutique">
		<?php if (have_rows('constructeur_boutique')) : ?>
			<?php while (have_rows('constructeur_boutique')) : the_row(); ?>
			
			<?php if (get_row_layout() == 'titre') : ?>
				<?= get_sub_field('titre') ?>					
				<?php endif; ?>
				
				
				<?php if (get_row_layout() == 'texte') : ?>
					<div class="center">
						<?= get_sub_field('texte') ?>
					</div>
					<hr>		
				<?php endif; ?>

				<?php if (get_row_layout() == 'bloc_double') : ?>
					<div class="box_cols">
						<div class="col_left">
						<?= get_sub_field('bloc1') ?>
					</div>
					<div class="col_right">
							<?= get_sub_field('bloc2') ?>
						</div>
					</div>
					<?php endif; ?>
					
				<?php if (get_row_layout() == 'galerie') : ?>
					<?php $images = get_sub_field('images'); ?>
				<div>
					<?php foreach ($images as $image) : ?>
						<img width="100" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
						<p><i><?= $image['caption'] ?></i></p>
						<p><?= $image['description'] ?></p>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>
		
	<style>
		.center{
			text-align: center;
		}
		.box_cols {
			display: flex;
		}
		.col_left, .col_right {
			width: 50%;
		}
	</style>

<?php
get_footer();
