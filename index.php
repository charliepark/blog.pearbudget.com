<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?<?php echo time(); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class('cf'); ?>>
	<?php $page_heading_tag = ( is_single() ) ? 'h2' : 'h1'; ?>
	<<?php echo $page_heading_tag; ?> class="g gfl gc5 page_title"  style="background:#191919;margin-top:72px;margin-bottom:43px;"><a href="/">PearBudget <span>is a really simple budgeting tool. This is the PearBudget blog.</span></a></<?php echo $page_heading_tag; ?>>
	<form action="http://blog.pearbudget.com/" id="search-form" method="get" role="search"><input type="text" id="s" name="s" placeholder="Search"></form>
			<div id="content" class="g gfl gc3 cf">

			<?php /* If there are no posts to display, such as an empty archive page */ ?>
			<?php if ( ! have_posts() ) : ?>
				<div id="post-0" class="post cf error404 not-found">
					<h1>Not Found</h1>
						<p>Sadly, we couldn&rsquo;t find any results for that request. You might try searching again.</p>
						<?php get_search_form(); ?>
				</div><!-- #post-0 -->
			<?php endif; ?>

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
					<<?php echo $post_heading_tag; ?> class="post_title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></<?php echo $post_heading_tag; ?>>

					<?php if ( ! is_single() ) : ?>
						<div class="entry-meta">
							<?php
							printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
								'meta-prep meta-prep-author',
								sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
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

						<div class="entry-utility">
							<?php if ( count( get_the_category() ) ) : ?>
								<span class="cat-links">
									<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
								</span>
								<span class="meta-sep">|</span>
							<?php endif; ?>
							<?php
								$tags_list = get_the_tag_list( '', ', ' );
								if ( $tags_list ):
							?>
								<span class="tag-links">
									<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
								</span>
								<span class="meta-sep">|</span>
							<?php endif; ?>
							<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
							<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-utility -->
					</div><!-- #post-## -->

					<?php comments_template( '', true ); ?>

			<?php endwhile; // End the loop. Whew. ?>

			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
							<div id="nav-below" class="navigation">
								<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
								<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
							</div><!-- #nav-below -->
			<?php endif; ?>
			</div><!-- #content -->

		<ul id="nav_header" class="g gc5 gfl gmb0 gw" style="position:absolute;top:20px;">
			<li class="g gc1 gfl gmb0"><a href="http://blog.pearbudget.com">blog home</a></li>
			<li class="g gc1 gfl gmb0"><a href="https://pearbudget.com/">PearBudget home</a></li>
			<li class="g gc1 gfl gmb0"><a href="/help">Need Help with PB?</a></li>
			<li class="g gc1 gfl gmb0"><a href="/contact">Twitter / Facebook</a></li>
			<li class="g gc1 gfl gmb0"><a href="">Subscribe</a></li>
		</ul>

		<div id="sidebar" class="g gfl gc2 gmr0">
			<?php if ( is_single() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<h3>About This Post</h3>
				<p>This was posted <span style="text-transform:lowercase"><?php wp_days_ago(); ?></span> (on <?php the_date(); ?>), by <?php the_author(); ?>.</p>
				<?php endwhile; ?>
			<?php endif; ?>
			
			<h3>About Us</h3>
			<p><a href="https://pearbudget.com/">PearBudget</a> is a really simple budgeting tool. It&rsquo;s perfect for people who know they probably <em>should</em> budget, but who aren&rsquo;t totally sure how to go about it.</p>
			<p>You can <a href="https://pearbudget.com/">set up a budget for free</a>, and if you want to use it after the free 30-day trial, it&rsquo;s only $4.95 a month &mdash; you&rsquo;ll easily save ten times that much every month.</p>

			<h3>Contact</h3>
			<p>You can e-mail Charlie (the guy who made PearBudget) or Ruth (our customer service manager), at <a href="mailto:help@pearbudget.com">help@pearbudget.com</a>. You can also send us a note on <a href="http://twitter.com/pearbudget">Twitter</a> or at <a href="http://facebook.com/pearbudget">Facebook</a>.</p>

			<h3>Archives</h3>
			<ul>
				<?php wp_get_archives( 'type=monthly' ); ?>
			</ul>
		</div><!-- #sidebar -->



<?php wp_footer(); ?>
</body>
</html>
