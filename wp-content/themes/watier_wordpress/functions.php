<?php
/**
 * watier_wordpress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package watier_wordpress
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function watier_wordpress_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on watier_wordpress, use a find and replace
		* to change 'watier_wordpress' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'watier_wordpress', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'watier_wordpress' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'watier_wordpress_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'watier_wordpress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function watier_wordpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'watier_wordpress_content_width', 640 );
}
add_action( 'after_setup_theme', 'watier_wordpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function watier_wordpress_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'watier_wordpress' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'watier_wordpress' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'watier_wordpress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function watier_wordpress_scripts() {
	wp_enqueue_style('watier_wordpress-style', get_template_directory_uri().'/css/style.css'); // mon fichier css
	wp_enqueue_script('watier_wordpress-jquery', get_template_directory_uri().'/js/jquery.js'); // mon fichier jquery
	wp_enqueue_script('watier_wordpress-script', get_template_directory_uri().'/js/script.js'); // mon fichier js
	wp_localize_script('watier_wordpress-script', 'ajaxurl', admin_url('admin-ajax.php')); // pour utiliser Ajax WordPress
}
add_action( 'wp_enqueue_scripts', 'watier_wordpress_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


///////////////////////////////////////////////////////////////
////////// Menu d'option récupéré dans la doc PRO ACF /////////
///////////////////////////////////////////////////////////////
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Mes options',
		'menu_title'	=> 'Menu options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		//position pour positionner le menu dans la barre de gauche de wordpress
		'position'		=> 10,
		// nom de l'icone trouvable sur la doc wordpress
		'icon_url'		=> 'dashicons-admin-settings',
	));
}



//Hook qui permet de modifier le footer de l'administration
function my_custom_function1($text){
	$text = "Mon texte dans le footer de l'administration";
	return $text;
}
//"admin_footer_text" est un hooks existant dans wordpress
add_action("admin_footer_text", "my_custom_function1");


//fontion d'envoi de mail
function ecv_send_contact_form() {
	//récupération des données envoyées par la requête Ajax grâce à la variable $_POST
	$email = htmlentities($_POST['form_email']);
	$message = htmlentities($_POST['form_message']);
	// récupération de l’email du destinataire
	$to = $_POST['form_to'];


	// on définit un sujet à l’email
	$subject = 'ECV - Message de contact';

	// création de l’email avec les données du formulaire
	$content = '<table>';
	$content .= '<tr><td><b>Adresse email :</b> '.$email.'</td></tr>';
	$content .= '<tr><td><b>Message :</b></td></tr>';
	$content .= '<tr><td>'.$message.'</td></tr>';
	$content .= '</table>';

	// le header de l’email
	$headers = 'From: ECV <contact@ecv.com>' . "\r\n"; // cette ligne est personnalisable
	$headers .= "X-Mailer: PHP ".phpversion()."\n";
	$headers .= "Content-Transfer-Encoding: 8bit\n";
	$headers .= "Content-type: text/html; charset= utf-8\n";

	// function d’envoi d’email de WordPress
	$send = wp_mail($to, $subject, $content, $headers);

	// la fonction wp_mail renvoie “true” si l’email a bien été envoyé
	if ($send) {
		$datas['send'] = true; // on définit un tableau avec une valeur “true”
		wp_send_json_success($datas); // la fonction wp_send_json_success retourne le tableau à la requête Ajax
	}

	wp_die(); // on stop tout traitement
}
add_action('wp_ajax_send_contact_form', 'ecv_send_contact_form');
add_action('wp_ajax_nopriv_send_contact_form', 'ecv_send_contact_form');