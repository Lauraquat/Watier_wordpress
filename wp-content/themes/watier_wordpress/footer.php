<?php
$reseaux = get_field("reseaux", "option");
?>

	<footer>
		<?php if($reseaux) : ?>
			<ul class ="reseaux">
				<?php foreach ($reseaux as $reseau) : ?>
					<li>
						<a href="<?= $reseau['url'] ?>">
							<img width="50" src="<?= $reseau['image'] ?>" alt="<?= $reseau['name'] ?>">
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</footer>


<?php wp_footer(); ?>

	</div><!--ferme la div qui est ouverte dans le template "header.php"-->
</body>
</html>
