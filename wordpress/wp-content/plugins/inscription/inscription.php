<?php
/**
 * Plugin Name: Inscription
 * Description: demande d'inscription a l'association
 */
defined( 'ABSPATH' ) or die( 'No direct access' );

define('INSCRIPTION_TEMPLATE', '
<form action="%s" method="POST">
    <h1>Inscription</h1>
    <input type="text" placeholder="NOM" name="nom" class="text" required>
    <input type="text" placeholder="PRENOM" name="prenom" class="text" required></br>
    <input type="text" placeholder="ADRESSE" name="adresse" class="text" required>
    <input type="text" placeholder="CODE POSTAL" name="codePostal" class="text" required></br>
    <input type="text" placeholder="VILLE" name="ville" class="text" required>
    <input type="text" placeholder="E-MAIL" name="mail" class="text" required></br>
    <input type="text" placeholder="Mot de passe" name="MDP" class="text" required>
    <input type="submit" id="submit" value="Valider" name="reservation" class="bouton">
</form>
');


// Action pour traiter le formulaire de reservation
add_action('template_redirect', 'reservation_inscriptions_traitement');

// Recuperation du code HTML du formaulaire de reservation
function reservation_inscriptions_getform( $postId ) {
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $sEmail = $user->user_email;
        
        $aListeReservation = json_decode(get_post_meta($postId, 'reservations-inscription', true), true);
        

        printf(INSCRIPTION_TEMPLATE,
                    get_site_url() . '/inscription/',
                    wp_nonce_field('reserver', 'reservation-verif'),
                    $postId,
                    $sAction,
                    $sDescBouton);
    } else {
        echo "<p>Connectez-vous pour pouvoir réserver</p>";
    }

}

// Traitement des reservations
function reservation_inscriptions_traitement() {
    var_dump($_POST);

    if (isset($_POST['id-inscription']) && isset($_POST['reservation-verif']))  {

        // Verifie que la requete est valide
        if (wp_verify_nonce($_POST['reservation-verif'], 'reserver')) {

            $user = wp_get_current_user();
            $sEmail = $user->user_email;

            $aListeReservation = json_decode(get_post_meta($_POST['id-inscription'], 'reservations-inscription', true), true);
            
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

            update_post_meta( $_POST['id-inscription'], 'reservations-inscription', json_encode($aListeReservation) );
        }
    }

}

// Ajout du champ custom 'reservations-inscription' à l'API
function rest_add_reservations_inscription() {
    register_rest_field( 'inscriptions',
        'reservations-inscription',
        array(
            'get_callback'  => 'rest_get_reservations_inscription',
            'update_callback'   => null,
            'schema'            => null,
         )
    );
}
function rest_get_reservations_inscription( $object, $field_name, $request ) {
    return(get_post_meta($object['id'], 'reservations-inscription', true));
}
add_action( 'rest_api_init', 'rest_add_reservations_inscription' );

// Pour verifier si le plugin est activé
function reservation_inscriptions_pluginactif( $post_object ) {
}
