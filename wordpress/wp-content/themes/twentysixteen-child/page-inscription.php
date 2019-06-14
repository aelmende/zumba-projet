<?php
/**
 * Template pour la page d'inscription
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 * Template Name: inscription
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.

        // Execute la requete sur les inscriptions
        $query = new WP_Query( array('post_type' => 'inscriptions', 'posts_per_page' => 5 ) );
		while ( $query->have_posts() ) :

            // Affiche l'image mise en avant
            echo '<div class="entry-content">';
            $query->the_post();
            if ( $query->has_post_thumbnail() ) {
              $query->the_post_thumbnail();
            }
            //the_content();
            echo '</div>';

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

            // Affiche la date et l'heure de l'inscription à partir du custom field
            $sDateinscription = get_post_meta($post->ID, 'date-inscription', true);
            if (!empty($sDateinscription) ) {
                $sDateTemplate = '
                <div class="inscriptions-date">
                    <p>Cet événement aura lieu le : %s </p>
                </div>';
                printf( $sDateTemplate, $sDateinscription);
            }

            if( function_exists('reservation_inscriptions_pluginactif')) {
                reservation_inscriptions_getform($post->ID);
            }

            // If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
            wp_reset_postdata();
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
