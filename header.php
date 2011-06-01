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