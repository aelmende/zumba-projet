<?php
/*
Plugin Name: Soirees
Plugin URI: http://soirees.com
Description: Un plugin de gestion d'evenements pour le développement sous WordPress
Version: 0.1
Author: DADOUZOULOULOU
Author URI: http://dadouzouloulou.com
License: GPL2
*/

//demande a la fonction de se lancer au démarrage de du menu admin
add_action('init','soirees_init');

//contenu de l'onglet Soirées
function soirees_init() {
	register_post_type('slide', array(
		'public' => true,
		'label' => 'Soirées',
		'capability_type' => 'post',
	));
}
function soirees_show() {
	/*echo "bonjourbonjourbonjourbonjourbonjourbonjour";
	$meta_values = get_post_meta($postID, "soirée 1");
	var_dump($meta_values);*/
	$slides = new WP_query(array('post_type' => 'soirees', 'posts_per_page' => 5 ));
	while($slides->have_posts()){
		$slides->the_post();
		global $post;
		the_post_thumbnail('slider');
	}
}
?>