<?php
/*Template Name: Accueil*/

$images = get_field('images');

get_header();
?>
	<div id="home">
		<h1>Home</h1>

		<div id="galery">
			<?php foreach ($images as $image) : ?>
				<img width="100" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
				<p><i><?= $image['caption'] ?></i></p>
				<p><?= $image['description'] ?></p>
			<?php endforeach; ?>
		</div>
		<hr>
		<div class="constructeur">
			<?php if (have_rows('blocs')) : ?>
				<?php while (have_rows('blocs')) : the_row(); ?>

					<?php if (get_row_layout() == 'bloc1') : ?>
						<div class="box_cols">
							<div class="col_left">
								<img src="<?= get_sub_field('img') ?>">
							</div>
							<div class="col_right">
                                <?= get_sub_field('texte') ?>
                            </div>
						</div>
					<?php endif; ?>

					<?php if (get_row_layout() == 'bloc2') : ?>
						<div class="box_cols">
							<div class="col_left">
                                <?= get_sub_field('texte') ?>
                            </div>
							<div class="col_right">
								<img src="<?= get_sub_field('img') ?>">
							</div>
						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<style>
			.box_cols {
				display: flex;
			}
			.col_left, .col_right {
				width: 50%;
			}
		</style>
	</div>
<?php
get_footer();
