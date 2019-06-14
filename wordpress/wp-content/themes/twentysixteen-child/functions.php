<?php
/* Dans wordpress, les développeurs ne sont pas très soucieux de la structure
des fichiers source. Visiblement, ils ont l'habitude de mélanger "le programme principal"
et les déclarations de fonctions. Alors, faisons comme eux car il faut bien
s'adapter à l'écosystème dans lequel on développe ;)
*/

// Chargement de la feuille de style du thème parent
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Création du "Custom Post Type" pour les événements
function inscriptions_init() {
    $args = array(
      'label' => 'inscriptions',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'inscriptions'),
        'query_var' => true,
        'menu_icon' => 'dashicons-video-alt',
        'supports' => array(
            'title',
            'editor',
            'date',
            'custom-fields',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'inscriptions', $args );
}
add_action( 'init', 'inscriptions_init' );

// Ajout du champ custom 'date-inscription' à l'API
function rest_add_date_inscription() {
    register_rest_field( 'inscriptions',
        'date-inscription',
        array(
            'get_callback'  => 'rest_get_date_inscription',
            'update_callback'   => null,
            'schema'            => null,
         )
    );
}
function rest_get_date_inscription( $object, $field_name, $request ) {
    return(get_post_meta($object['id'], 'date-inscription', true));
}
add_action( 'rest_api_init', 'rest_add_date_inscription' );

function evenements_init() {
    $args = array(
      'label' => 'Evenements',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'evenements'),
        'query_var' => true,
        'menu_icon' => 'dashicons-video-alt',
        'supports' => array(
            'title',
            'editor',
            'date',
            'custom-fields',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'evenements', $args );
}
add_action( 'init', 'evenements_init' );

// Ajout du champ custom 'date-evenement' à l'API
function rest_add_date_evenement() {
    register_rest_field( 'evenements',
        'date-evenement',
        array(
            'get_callback'  => 'rest_get_date_evenement',
            'update_callback'   => null,
            'schema'            => null,
         )
    );
}
function rest_get_date_evenement( $object, $field_name, $request ) {
    return(get_post_meta($object['id'], 'date-evenement', true));
}
add_action( 'rest_api_init', 'rest_add_date_evenement' );

/*
* On utilise une fonction pour créer notre custom post type 'Séries TV'
*/

function wpm_custom_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Séries TV', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Série TV', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Séries TV'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Toutes les séries TV'),
		'view_item'           => __( 'Voir les séries TV'),
		'add_new_item'        => __( 'Ajouter une nouvelle série TV'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer la séries TV'),
		'update_item'         => __( 'Modifier la séries TV'),
		'search_items'        => __( 'Rechercher une série TV'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'Séries TV'),
		'description'         => __( 'Tous sur séries TV'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'series-tv'),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'seriestv', $args );

}

add_action( 'init', 'wpm_custom_post_type', 0 );
