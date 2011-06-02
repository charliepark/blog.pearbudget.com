<?php get_header(); ?>
<?php if ( is_home() ) { query_posts($query_string . '&cat=-3'); } ?>
			<?php
				/* Start the Loop.
				 *
				 * In Twenty Ten we use the same loop in multiple contexts.
				 * It is broken into three main parts: when we're displaying
				 * posts that are in the gallery category, when we're displaying
				 * posts in the asides category, and finally all other posts.
				 *
				 * Additionally, we sometimes check for whether we are on an
				 * archive page, a search page, etc., allowing for small differences
				 * in the loop on each template without actually duplicating
				 * the rest of the loop that is shared.
				 *
				 * Without further ado, the loop:
				 */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php $post_heading_tag = ( is_single() ) ? 'h1' : 'h2'; ?>
					<<?php echo $post_heading_tag; ?> class="post_title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></<?php echo $post_heading_tag; ?>>

					<?php if ( ! is_single() and ! in_category(3) ) : ?>
						<div class="entry-meta">
							<?php
							printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
								'meta-prep meta-prep-author',
								sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>,',
									get_permalink(),
									esc_attr( get_the_time() ),
									get_the_date()
								),
								sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
									get_author_posts_url( get_the_author_meta( 'ID' ) ),
									sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
									get_the_author()
								)
							);
							?>
								<?php if ( count( get_the_category() ) ) : ?>
										<?php printf( __( '<span style="text-transform:lowercase">in %1$s</span>' ), get_the_category_list( ', ' ) ); ?>
								<?php endif; ?>
							
						</div><!-- .entry-meta -->
				<?php endif; ?>

				<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
				<?php else : ?>
						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->
				<?php endif; ?>

				<?php if ( ! is_single() and ! in_category(3) ) : ?>
							<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php endif; ?>		
					</div><!-- #post-## -->
				<?php if ( ! in_category(3) ) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>
			<?php endwhile; // End the loop. Whew. ?>
<?php get_footer(); ?>