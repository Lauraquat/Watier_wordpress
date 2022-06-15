<?php
/*Template Name: Contact*/

/* $header_image = get_field('header');*/
$contacts = get_field('contact');
$couleur = get_field('couleur');

$paged = get_query_var('paged'); // récupère la page actuelle
$args = array(
	'post_type' => 'menu',
	'posts_per_page' => 3,
	'paged' => $paged,
);
$menus = new WP_Query($args);


//$email = get_field('email');


get_header();

?>

<div class="header">
    <?php if (have_rows('header')) : ?>
        <?php while (have_rows('header')) : the_row(); ?>

            <?php if (get_row_layout() == 'imgtitre') : ?>
                <div>
                    <div>
                        <img width="100%" src="<?= get_sub_field('image') ?>">
                    </div>
                    <div>
                        <?= get_sub_field('titre') ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<!--<img width="100%" src="<?= $header_image['url'] ?>" alt="<?= $header_image['alt'] ?>"-->


<!--code ci-dessous à utiliser avec le $email = get_field('email');   => mis en variable pour pouvoir travailler avec-->
<!--h2><?php echo $email ?></!--h2>-->


<!--Code ci dessous récupéré dans la doc wordpress pour afficher un champ texte => echo automatique-->
<!--On modifie le paramètre de "the_field" pour mettre le nom qu'on a donné au champ-->
<!--<h2><?php the_field('email'); ?></h2>-->


<!--Formulaire de contact-->
<form method="post" id="contact_form">
    <div>   
        <select name="contact" id="contact">
            <option selected disabled>Choisissez votre contact</option>
            <?php foreach ($contacts as $contact) : ?>
                <option name="form_to" value="<?= $contact['mail'] ?>"><?= $contact['nom'] ?></option>
			<?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="form_email">e-mail&nbsp;:</label>
        <input type="email" id="form_email" name="form_email">
    </div>
    <div>
        <label for="form_message">Message :</label>
        <textarea id="form_message" name="form_message"></textarea>
    </div>
    <button type="submit">Envoyer</button>
</form>


<!--3 derniers menus-->
<h3 style="color:<?php echo $couleur ?>;">Nos derniers menus</h3>
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
<?php endif; ?>


<?php

get_footer();