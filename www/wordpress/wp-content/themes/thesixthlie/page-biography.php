<?php
/*
 Template Name: Biography
 *
*/
?>


<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="cf biography">
						<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<h1 class="chapter-title    wrap" itemprop="headline"><span class="title-circle"><?php the_title(); ?></span></h1>

							<?php $image = get_field('artist_img');
							if( !empty($image) ): ?>
								<img class="artist-img" src="<?php echo $image['url'];?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>

							<article id="post-<?php the_ID(); ?>" class="wrap" role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<h2 class="chapter-item">MEMBER</h2>
								<section class="entry-content cf" itemprop="articleBody">
									<ul>
										<li>Vo: Arata</li>
										<li>Gt: Reiji</li>
										<li>Ba: Tatsu</li>
										<li>Dr: Ray</li>
									</ul>
								</section>

								<h2 class="chapter-item">HISTORY</h2>
								<section class="entry-content cf" itemprop="articleBody">
									<?php
										the_content();
									?>
								</section>

							</article>

							<?php endwhile; endif; ?>

						</main>
						<?php if (!is_mobile()) {
						get_sidebar();
						} ?>

				</div>

			</div>

<?php get_footer(); ?>
