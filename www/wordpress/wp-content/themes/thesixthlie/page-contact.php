<?php
/*
 Template Name: Contact
*/
?>


<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="wrap cf">
						<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<h1 class="chapter-title    wrap" itemprop="headline"><span class="title-circle"><?php the_title(); ?></span></h1>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf contact' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<section class="entry-content cf" itemprop="articleBody">

								<?php if( !(is_page() && $post->post_parent) ) : ?>
								<p class="reserve-here"><a href="<?php echo get_permalink( 94 ); ?>">liveの予約はこちらから<i class="fa fa-angle-double-right"></i></a></p>
								<?php endif ?>

									<?php the_content(); ?>

								

							

								</section> <?php // end article section ?>

							</article>

							<?php endwhile; endif; ?>

						</main>
						<?php if (!is_mobile()) {
						get_sidebar();
						} ?>

				</div>

			</div>

<?php get_footer(); ?>
