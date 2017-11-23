<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ankh-Morpork
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ankh_morpork_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ankh-morpork' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ankh-morpork' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( !is_front_page() ) : ?>
            <footer class="entry-footer">
                 <section class="entry-footer-section">
                    <?php ankh_morpork_entry_footer(); ?>
                 </section>
                 <section class="entry-share-section">
                 <?php
                     if ( function_exists( 'sharing_display' ) )
                         sharing_display( '', true );

                     echo ankh_morpork_synved_social_share_markup();
                 ?>
                 </section>
            </footer><!-- .entry-footer -->
        <?php endif ?>
</article><!-- #post-<?php the_ID(); ?> -->
