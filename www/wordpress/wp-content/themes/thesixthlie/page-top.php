<?php
/*
 Template Name: Top
*/
?>

<?php //抜粋からhtmlタグを削除 ?>
<?php remove_filter('the_excerpt', 'wpautop'); ?>

<?php get_header(); ?>

    <?php if(is_front_page()) : ?>
      <article class="welcome cf" id="welcome">
      <?php if(is_mobile()) : ?>
        <ul class="bxslider">
          <li><img class="welcome-image welcome-load-img" src="<?php echo home_url(); ?>/wp-content/themes/thesixthlie/library/images/top-mobile-1.jpg"></li>
          <li><img class="welcome-image" src="<?php echo home_url(); ?>/wp-content/themes/thesixthlie/library/images/top-mobile-2.jpg"></li>
          <li><img class="welcome-image" src="<?php echo home_url(); ?>/wp-content/themes/thesixthlie/library/images/top-mobile-3.jpg"></li>
          <li><img class="welcome-image" src="<?php echo home_url(); ?>/wp-content/themes/thesixthlie/library/images/top-mobile-4.jpg"></li>
        </ul>
      <?php endif ?> 
        <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
          <section>
            <h2 class="h2 w-title"><?php the_field('welcome_title'); ?></h2>
            <?php if(get_field('welcome_link') != null) { ?>
              <a href="<?php the_field('welcome_link') ?>"><h3 class="h2 w-main"><?php the_field('welcome_main'); ?></h3></a>
            <?php } else { ?>
              <h3 class="h2 w-main"><?php the_field('welcome_main'); ?></h3>
            <?php } ?>
            <p class="h4 w-desc"><?php the_field('welcome_description'); ?></p>
            <!-- <p class="more">view more</p> -->
          </section>
          <div class="plz-scroll"><i class="fa fa-arrow-circle-o-down fa-4x"></i></div>
        <?php endwhile; endif; ?>
      </article>
      <div class="first-followme cf"><?php get_template_part('followme'); endif;?></div>
      <div class="something"></div>
<div id="content">
  <div id="inner-content inner-content-top" class="wrap cf">

    <main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

    <!-- ピックアップを表示 -->
      <?php global $post; ?>
      <?php $args = array( 'numberposts' => 1, 'post_type' => 'any', 'meta_query' => array( array( 'key' => 'importance', 'value' => 'pickup') ) ); ?>
      <?php $pickups = get_posts( $args ); ?>
      <?php if ( $pickups ) : ?>
        <div>
          <h2 class="chapter-title h1"><span class="title-circle">PICK UP</span></h2>
          <div class="chapter-content">
            <?php foreach( $pickups as $post ) : setup_postdata($post); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf pickup'  )  ;   ?> role="article" itemscope itemtype="http://schema.org/    BlogPosting">
                <section class="cf" itemprop="articleBody">
                  <?php if ( get_field('video_link') ) { ?>
                    <div class="video-container"><?php the_field('video_link'); ?></div>
                  <?php } ?>
                  <h3 class="pickup-title"><?php the_title(); ?></h3>
                  <?php the_content(); ?>
                </section>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif;
      wp_reset_postdata(); ?>

    <!-- 最新3件の投稿を表示 -->
      <div class="topnews-wrapper">
        <h2 class="chapter-title h1"><span class="title-circle">NEWS</span></h2>
        <div class="chapter-content">
          <?php global $post; ?>
          <?php $args = array( 'numberposts' => 3, 'orderby' => 'post_date', 'post_type' => 'any', 'meta_query' => array( array( 'key' => 'importance', 'value' => 'normal') ) ); ?>
          <?php $news = get_posts( $args );
          foreach( $news as $post ) : setup_postdata($post); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf topnews' )  ;   ?> role="article" itemscope itemtype="http://schema.org/  BlogPosting">
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
          <?php endforeach; 
          wp_reset_postdata();?>
        </div>
      </div>

    </main>
    <?php if (!is_mobile()) {
      get_sidebar(); 
    }?>
  </div>
</div>

<?php get_footer(); ?>
