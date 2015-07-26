<?php
/*
 Template Name: News
*/
?>

<?php get_header(); ?>

<div id="content">
  <div id="inner-content" class="wrap cf">

    <main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

          <h1 class="chapter-title    "><span class="title-circle">NEWS</span></h1>
          <div class="chapter-content">
          <?php $num = 0; ?>
          <?php global $post;
            $posts = get_posts( array( 'posts_per_page' => 5, 'post_type' => array('post', 'live', 'discography', 'video') ) );
            foreach( $posts as $post ) : setup_postdata($post); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf topnews'  )  ;   ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                <header>
                  <?php the_time('Y.m.d'); ?>
                  <?php $post_type = get_post_type(); 
                  if( $post_type === 'post' ) $post_type = 'news' ?>
                  <span class='post-type-wrapper'><?php  echo $post_type ?></span>
                </header>
                <section class="cf entry-content" itemprop="articleBody">
                  <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?>
                </section>
              </article>

              <?php $num += 1; ?>

            <?php endforeach; ?>
          </div>

      <?php wp_reset_postdata(); ?>

      <?php if ($num >= 5) { ?><p id="more"><a href="#">LOAD MORE</a></p><?php } ?>


    </main>
    <?php if (!is_mobile()) {
      get_sidebar(); 
    }?>
  </div>
</div>

<?php get_footer(); ?>
