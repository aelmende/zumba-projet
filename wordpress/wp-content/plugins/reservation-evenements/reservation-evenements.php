<?php
/**
 * Plugin Name: reservation-evenements
 * Description: Reservation aux evenements pour les abonnés
 */
defined( 'ABSPATH' ) or die( 'No direct access' );

define('RESERVATION_TEMPLATE', '
<form action="%s" method="POST">
	%s
    <input type="hidden" name="id-evenement" value="%s" />
    <input type="hidden" name="action" value="%s" />
	<p>
		<input id="submit" type="submit" name="reservation" class="submit" value="%s" />
	</p>
</form>
');

// Action pour traiter le formulaire de reservation
add_action('template_redirect', 'reservation_evenements_traitement');

// Recuperation du code HTML du formaulaire de reservation
function reservation_evenements_getform( $postId ) {
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $sEmail = $user->user_email;
        
        $aListeReservation = json_decode(get_post_meta($postId, 'reservations-evenement', true), true);
        
        if (in_array($sEmail, $aListeReservation)) {
            $sAction = 'annuler';
            $sDescBouton = 'Annuler réservation';
        } else {
            $sAction = 'reserver';
            $sDescBouton = 'Réserver';
        }

        printf(RESERVATION_TEMPLATE,
                    get_site_url() . '/soirees/',
                    wp_nonce_field('reserver', 'reservation-verif'),
                    $postId,
                    $sAction,
                    $sDescBouton);
    } else {
        echo "<p>Connectez-vous pour pouvoir réserver</p>";
    }

}

// Traitement des reservations
function reservation_evenements_traitement() {

    if (isset($_POST['id-evenement']) && isset($_POST['reservation-verif']))  {

        // Verifie que la requete est valide
        if (wp_verify_nonce($_POST['reservation-verif'], 'reserver')) {

            $user = wp_get_current_user();
            $sEmail = $user->user_email;

            $aListeReservation = json_decode(get_post_meta($_POST['id-evenement'], 'reservations-evenement', true), true);
            
            if ($aListeReservation===null) {
                $aListeReservation = [$sEmail];
            } else 
            {
                if (!in_array($sEmail, $aListeReservation)) 
                {
                    array_push($aListeReservation, $sEmail);
                } else 
                {
                    foreach ($aListeReservation as $key => $value)
                    {
                        if($sEmail==$value)
                        {
                            unset($aListeReservation[$key]);
                        }
                    }
                }
            }

            update_post_meta( $_POST['id-evenement'], 'reservations-evenement', json_encode($aListeReservation) );
        }
    }

}

// Ajout du champ custom 'reservations-evenement' à l'API
function rest_add_reservations_evenement() {
    register_rest_field( 'evenements',
        'reservations-evenement',
        array(
            'get_callback'  => 'rest_get_reservations_evenement',
            'update_callback'   => null,
            'schema'            => null,
         )
    );
}
function rest_get_reservations_evenement( $object, $field_name, $request ) {
    return(get_post_meta($object['id'], 'reservations-evenement', true));
}
add_action( 'rest_api_init', 'rest_add_reservations_evenement' );

// Pour verifier si le plugin est activé
function reservation_evenements_pluginactif( $post_object ) {
}
