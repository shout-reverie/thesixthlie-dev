<?php
/*
 * CUSTOM POST TYPE SINGLE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap cf">
					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						
						<h1 class="chapter-title   "><span class="title-circle">VIDEO</span></h1>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
								<section class="entry-content cf">
									<div class="video-container"><?php the_field('video_link'); ?></div>
									<h2><?php the_title(); ?></h2>
									<?php the_content(); ?>
									<?php if(get_field('lyrics')) { ?>
									<h3>Lyrics</h3>
									<?php the_field('lyrics'); } ?>
								</section>
							</article>
							<?php endwhile; ?>

							<?php else : ?>
									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the custom posty type archive template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

							<p class="back-to"><a href="<?php echo get_post_type_archive_link('video'); ?>"><i class="fa fa-angle-double-left"></i>back to VIDEO</a></p>
							<p class="back-to"><a href="<?php echo home_url(); ?>"><i class="fa fa-angle-double-left"></i>back to TOP</a></p>

						</main>

					<?php if (!is_mobile()) {
      			get_sidebar(); 
    			}?>

				</div>

			</div>

<?php get_footer(); ?>
