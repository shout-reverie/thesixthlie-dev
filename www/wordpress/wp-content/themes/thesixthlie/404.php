<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					<h1 class="chapter-title"><span class="title-circle">404 ERROR</span></h1>

						<article id="post-not-found" class="hentry cf">

							<header class="article-header">

								<h2>Page Not Found</h2>

							</header>

							<section class="entry-content">

								<p>お探しのページは見つかりませんでした</p>

								<p class="back-to"><a href="<?php echo home_url(); ?>"><i class="fa fa-angle-double-left"></i>back to TOP</a></p>

							</section>

						</article>

					</main>

										<?php if (!is_mobile()) {
						get_sidebar();
						} ?>

				</div>

			</div>

<?php get_footer(); ?>
