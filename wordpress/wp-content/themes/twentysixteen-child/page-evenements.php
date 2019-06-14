<?php
/**
 * Template pour la page evenements
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 * Template Name: evenements
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.

        // Execute la requete sur les evenements
        $query = new WP_Query( array('post_type' => 'evenements', 'posts_per_page' => 5 ) );
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

            // Affiche la date et l'heure de l'evenement à partir du custom field
            $sDateEvenement = get_post_meta($post->ID, 'date-evenement', true);
            if (!empty($sDateEvenement) ) {
                $sDateTemplate = '
                <div class="evenements-date">
                    <p>Cet événement aura lieu le : %s </p>
                </div>';
                printf( $sDateTemplate, $sDateEvenement);
            }

            if( function_exists('reservation_evenements_pluginactif')) {
                reservation_evenements_getform($post->ID);
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
