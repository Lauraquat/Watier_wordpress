<?php
/*
    Plugin Name: Logs
*/


register_activation_hook(__FILE__, "logs_enable");

function logs_enable(){
    global $table_prefix, $wpdb;
    $table_name = $table_prefix . 'logs';
    
    if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            logs_username VARCHAR(255) NOT NULL,
            logs_userId INT NOT NULL,
            logs_postname VARCHAR(255) NOT NULL,
            logs_action VARCHAR(255) NOT NULL,
            logs_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        dbDelta($sql);
    }
}

//Désactiver le plugin
register_deactivation_hook(__FILE__, "logs_disable");

function logs_disable() {
    //
}


//Création d'un menu page
add_action('admin_menu', 'addMenuPage');

function addMenuPage(){
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'Custom Menu Page Title', 'Menu Page', 'manage_options', 'custom_menu.php', '', 'dashicons-welcome-widgets-menus', 90 );
}




// add_action('init', 'logs_init');
// function logs_init(){
//     $user = wp_get_current_user();
//     var_dump($user->user_login);
// }



//Insertion des données dans la table
// 10 = priorité du hook. 3 = nombre de paramètres dans la fonction
add_action('save_post', 'add_logs', 10, 3);

function add_logs($post_id, $post, $update){
    $user = wp_get_current_user();

    if($update){
        global $table_prefix, $wpdb;
        $table_name = $table_prefix . 'logs'; //$table_prefix = "wp_" donc pas la peine de le remettre dans le nom de la table
        $datas = [
            'logs_username' => $user->user_login,
            'logs_userId' => $user->user_ID,
            'logs_postname' => $post->name,
            'logs_action' => "",
            'logs_date' => Date('Y-m-d'),
        ];

        $wpdb->insert($table_name, $datas);
    }
}