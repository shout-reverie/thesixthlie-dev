<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="wrap cf">
					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<h1 class="chapter-title   "><span class="title-circle">LIVE</span></h1>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf live-list' ); ?> role="article">
								<section class="entry-content cf">
									<table>
										<tbody>
											<tr class="live-title">
												<td colspan="3"><?php the_title(); ?></td>
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
											<tr><?php if( get_field('turn') ) { ?>
												<td>TURN</td><td>■</td><td class="live-info"><span class="open-time">THE SIXTH LIE</span><?php the_field('turn'); ?>-</td>
											<?php } ?></tr>
											<?php if( get_field('link') ) { ?><tr>
												<td>LINK</td><td>■</td><td class="live-info"><a class="live-link" href="<?php esc_url(the_field('link')); ?>" target="_blank"><?php esc_url(the_field('link')); ?></a></td>
											</tr><?php } ?>
										</tbody>
									</table>
									<div class="live-info-img"><?php the_post_thumbnail(); ?></div>
									<?php the_content(); ?>
									<?php $location = get_field('place');
										if( !empty($location) ) : ?>
										<div class="acf-map">
											<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
										</div>
										<p class="link-to-map"><a href="http://maps.google.com/maps?q=<?php echo $location['address']; ?>+<?php the_field('place'); ?>" target="_blank">Google Map</a></p>
										<?php endif; ?>
										<?php if( get_field( 'reserve' ) ) : ?>
										<p class="reserve-here"><a href="<?php
											$query = array('live_id' => get_the_ID());
											 echo add_query_arg( $query, home_url().'/contact/reservation' );
										?>">ご予約はこちらから<i class="fa fa-angle-double-right"></i></a></p>
									<?php endif ?>
								</section>
							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

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

							<p class="back-to"><a href="<?php echo get_post_type_archive_link('live'); ?>"><i class="fa fa-angle-double-left"></i>back to LIVE</a></p>
							<p class="back-to"><a href="<?php echo home_url(); ?>"><i class="fa fa-angle-double-left"></i>back to TOP</a></p>


						</main>

					<?php if (!is_mobile()) {
						get_sidebar();
						} ?>

				</div>

			</div>

<?php get_footer(); ?>
