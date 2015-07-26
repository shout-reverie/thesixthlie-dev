<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
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

						<h1 class="chapter-title   "><span class="title-circle">LIVE</span></h1>

						<?php $num = 0; ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf live-list' ); ?> role="article">
								<section class="entry-content cf">
									<table>
										<tbody>
											<tr class="live-title">
												<td colspan="3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
											</tr>
											<tr>
												<td>DATE</td><td>■</td><td class="live-info"><?php echo my_date( get_field('date') );?></td>
											</tr>
											<tr>
												<td>VENUE</td><td>■</td><td class="live-info"><?php the_field('venue'); ?></td>
											</tr>
											<tr>
												<td>TIME</td><td>■</td>
												<td class="live-info">
													<span class="open-time">OPEN</span><?php if( get_field('open') ) { the_field('open'); } else { echo ('--:--'); } ?>
													<span class="slash"> / </span>
													<span class="start-time">START</span><?php if( get_field('start') ) { the_field('start'); } else { echo ('--:--'); } ?>
												</td>
											</tr>
											<?php if( get_field('link') ) { ?><tr>
												<td>LINK</td><td>■</td><td class="live-info"><a class="live-link" href="<?php esc_url(the_field('link')); ?>" target="_blank"><?php esc_url(the_field('link')); ?></a></td>
											</tr><?php } ?>
										</tbody>
									</table>
									<div class="live-info-img"><?php the_post_thumbnail(); ?></div>
									<?php the_content(); ?>
									<p class="viewmore"><a href="<?php the_permalink() ?>">view more<i class="fa fa-angle-double-right"></i></a></p>
								</section>
							</article>

							<?php $num += 1; ?>

							<?php endwhile; ?>

							<?php if ($num >= 5) : ?><p id="more"><a href="#">LOAD MORE</a></p><?php endif ?>

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

						</main>


					<?php if (!is_mobile()) {
						get_sidebar();
						} ?>

				</div>

			</div>

<?php get_footer(); ?>
