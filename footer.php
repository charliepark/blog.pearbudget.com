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
			<li class="g gc1 gfl gmb0"><a href="/category/help">Need Help with PB?</a></li>
			<li class="g gc1 gfl gmb0"><a href="/contact">Twitter / Facebook</a></li>
			<li class="g gc1 gfl gmb0"><a href="">Subscribe</a></li>
		</ul>

		<div id="sidebar" class="g gfl gc2 gmr0">
			<?php if ( in_category('3') ) { ?>
				<h3>Help</h3>
				<p>We&rsquo;ve put our entire Help resource on our blog, to make it super-easy to search and find answers to your questions.</p>
				<form action="http://blog.pearbudget.com/" id="help-search-form" method="get" role="search"><input type="hidden" name="cat" value="3"><input type="text" id="s" name="s" placeholder="Search the 'Help' section"><button class="styled">search</button></form>
				<p>To find the answer to your help request, just search in this box. (It&rsquo;ll only include posts and articles in the &ldquo;help&rdquo; category.)</p>

				<h3>Frequently-Asked Questions</h3>
				<p>(coming soon)</p>
			<?php } else { ?>
				<?php if ( is_single() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
					<h3>About This Post</h3>
					<p>This was posted <span style="text-transform:lowercase"><?php wp_days_ago(); ?></span> (on <?php the_date(); ?>), by <?php the_author(); ?>.</p>
					<?php endwhile; ?>
				<?php endif; ?>
				
				<h3>About Us</h3>
				<p><strong><a href="https://pearbudget.com/">PearBudget</a> is a really simple budgeting tool.</strong> It&rsquo;s perfect for people who know they probably <em>should</em> budget, but who aren&rsquo;t sure how to go about it.</p>
				<p>You can <a href="https://pearbudget.com/">set up a budget for free</a>, and if you want to use it after the free 30-day trial, it&rsquo;s only $4.95 a month &mdash; you&rsquo;ll save at least ten times as much every month.</p>
			<?php } ?>

			<h3>Contact</h3>
			<p>You can e-mail Charlie (the guy who made PearBudget) or Ruth (our customer service manager), at <a href="mailto:help@pearbudget.com">help@pearbudget.com</a>. You can also send us a note on <a href="http://twitter.com/pearbudget">Twitter</a> or at <a href="http://facebook.com/pearbudget">Facebook</a>.</p>

			<h3>Archives</h3>
			<ul>
				<?php wp_get_archives( 'type=monthly' ); ?>
			</ul>

			<h3>Categories</h3>
			<ul>
				<?php wp_list_categories( 'title_li=' ); ?>
			</ul>
		</div><!-- #sidebar -->



<?php wp_footer(); ?>
</body>
</html>
