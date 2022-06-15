<?php
/*
* Template Name: Articles
* Template Post Type: post, page
*/


$paged = get_query_var('paged'); // récupère la page actuelle

$args = array(
	'post_type' => 'post',
	'paged' => $paged,
);

$articles = new WP_Query($args);

$categories = get_categories([
    'orderby' => 'name',
    'order'   => 'ASC'
]);

get_header();
?>
<?= "<div class='articles'>" ."<h2>Catégories :</h2> " ?>
<?php foreach( $categories as $category ) {
    $category_link = sprintf( 
        '<a class="categorie" href="%1$s" alt="%2$s">%3$s</a>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
        esc_html( $category->name ),
    );
	     
    echo sprintf( esc_html__( '%s', 'textdomain' ), $category_link ) . '</br>' ;
} ?>
<?= "</div>" ?>


<h1>Articles</h1>

<?php if($articles->have_posts()) : ?>
	
	<div class="articles">
		<?php while($articles->have_posts()) : $articles->the_post();
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
		<?php endwhile; ?>
	</div>
	
	<?php previous_posts_link('Page précédente'); ?>
	<?php next_posts_link('Page suivante', $articles->max_num_pages); ?>

<?php endif; ?>