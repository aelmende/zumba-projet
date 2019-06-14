<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'zumba' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ZX)nZoI[Ln>`*0c!tv+h]^H _RreN*8cHL<qXiix?AE%5_~7D8jIwB?Xh+rijZ({' );
define( 'SECURE_AUTH_KEY',  'bW56&G]?n{W~w{|6`J|t>,X>d&=!lkV2oB2K/FeGzR&M D[rQoG,EWMX,f=v`*,s' );
define( 'LOGGED_IN_KEY',    'IGu5LQ!%0a&[Ggs),7:>CcSy8#9A;$m=:h8G/R#9%0$MHaxtSQ38>^A<_y[SL1^/' );
define( 'NONCE_KEY',        '}m>VjxuEUYJGd~hzZz#<-?w[_N%LMZOb[ua-2~,:oOBK~0;C|tQ736dB!s|fpK~P' );
define( 'AUTH_SALT',        '80 ?MT7c.5$-3%;16H<FDH|=^z.Kanoal=/jm3hRKuNe9K2%!rgc9j)L{8W4HcHU' );
define( 'SECURE_AUTH_SALT', '$*NSOWqiU|}U@uL>h}WQlsMC5[{N07H&F+`ynGB{{?*3&L(y-xc*:jx_OtZ&2rlR' );
define( 'LOGGED_IN_SALT',   '- a3?lzXmx@nLN`{=49k{J3X;wP#WT&-$yyf&^|1I0:~xu+snbI*t+!K6+$u0T5@' );
define( 'NONCE_SALT',       'jfLx>)@*iF=z)*9Bp1,fzJouJ1#3qj+w2L0+}LVR+.KL:SHx<crJuG$c5r%JM=zH' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
