<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}

add_action('wp_enqueue_scripts', 'bones_fonts');


/****************************************************/
/********** WRITTEN BY SHOTA TAJIMA BELOW ***********/
/****************************************************/

/************* ACTIVATE EYE CATCH *************/
add_theme_support('post-thumbnails');


/************* JUDGE USER CIRCOMSTANCE *************/
function is_mobile() {
  $useragents = array(
    'iPhone',          // iPhone
    'iPod',            // iPod touch
    'Android',         // 1.5+ Android
    'dream',           // Pre 1.5 Android
    'CUPCAKE',         // 1.5+ Android
    'blackberry9500',  // Storm
    'blackberry9530',  // Storm
    'blackberry9520',  // Storm v2
    'blackberry9550',  // Storm v2
    'blackberry9800',  // Torch
    'webOS',           // Palm Pre Experimental
    'incognito',       // Other iPhone browser
    'webmate'          // Other iPhone browser
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

/************* MAKE PICKUP UNIQUE *************/
function check_pickup($post_id) {
  $post = get_post($post_id);
  if( $post -> {'importance'} == 'pickup' ) {
    $args = array(
      'numberposts' => 0,
      'post_status' =>'publish',
      'post_type' => 'any',
      'meta_query' => array( array( 'key' => 'importance',
                                    'value' => 'pickup' ) )
    );
    $allpickups = get_posts( $args );
    foreach( $allpickups as $postinfo ) {
      update_post_meta( $postinfo->ID, 'importance', 'normal');
    }
  }
}
add_action( 'publish_post', 'check_pickup' );

/************* FORMAT CUSTOM FIELD DATE *************/
function my_date($src) {
  $obj = new DateTime($src);
  return $obj->format('Y.m.d');
}

/************* FORMAT CUSTOM FIELD SONGS *************/
function my_songs($src) {
  $src = str_replace(array('\r\n','\r','\n'), '\n', $src);
  $array = explode("\n", $src);
  $array = array_map('trim', $array);
  $array = array_filter($array, 'strlen');
  $array = array_values($array);
  return $array;
}

/************* SORT LIVE EVENT ON LIVE PAGE *************/
function live_schedule_posts($query) {
  if (is_admin() || ! $query->is_main_query())
      return;
  if ($query->is_post_type_archive('live')) {
    $query->set( 'posts_per_page', 5 );
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'date' );
    $query->set( 'order', 'DESC' );
  }
}
add_action('pre_get_posts', 'live_schedule_posts');

/************ AUTO TITLE OF LIVE INFO *******************/
function my_auto_title($title_message){
  global $post;
  if ( !is_admin() && (is_post_type_archive('live') || is_singular('live')) ) {
    return $title_message;
  } else if( $post->post_type == 'live' && $title_message == null ){
    $date = get_field('date', $post->ID);
    $date = new DateTime($date);
    $date = $date->format('m.d');
    $venue = get_field('venue', $post->ID);
    $title_message = "${date}@${venue}";
  }
  return $title_message;
}
add_filter('single_post_title', 'my_auto_title');
add_filter('the_title', 'my_auto_title');

/************ CUSTOMIZE MW WP FORM **********************/
function my_error_message( $error, $key, $rule ) {
    if ( $rule === 'noempty' ) {
        return '';
    } else if ( $rule === 'mail' ) {
        return '';
    } else {
    return $error;
  }
}
add_filter( 'mwform_error_message_mw-wp-form-12', 'my_error_message', 10, 3 );
add_filter( 'mwform_error_message_mw-wp-form-93', 'my_error_message', 10, 3 );


/**
 * add_products
 * カスタム投稿タイプ「live」の投稿を選択肢として表示
 * @param array $children
 * @param array $atts
 */
function add_live( $children, $atts ) {
    if ( $atts['name'] == 'reserve_live_title' ) {
        $lives = get_posts( array(
            'post_type' => 'live',
            'posts_per_page' => -1
        ) );
        foreach ( $lives as $live ) {
          $live_id = $live->ID;
          if ( get_field('reserve', $live_id) ) {
            $live_title = $live->post_title;
            if ( $live_title == null ) {
              $live_title = get_field('date', $live_id).'@'.get_field('venue', $live_id);
            }
            $children[$live_id] = $live_title;
          }
        }
    }
    return $children;
}
add_filter( 'mwform_choices_mw-wp-form-93', 'add_live', 10, 2 );

//----------------------------------------
//キーを追加するためのフィルターフック
//----------------------------------------
function add_meta_query_vars( $public_query_vars ) {
     $public_query_vars[] = 'live_id';
     return $public_query_vars;
}
add_filter( 'query_vars', 'add_meta_query_vars' );

/****************** FOR AJAX **************************/


/****************** FOR CALENDER *********************/
//カスタム投稿タイプ用カレンダー
function my_get_calendar($cpt, $initial = true, $echo = true, $showNext = false) {
    global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

    $cache = array();
    $key = md5( $m . $monthnum . $year );
    if ( $cache = wp_cache_get( 'my_get_calendar', 'calendar' ) ) {
        if ( is_array($cache) && isset( $cache[ $key ] ) ) {
            if ( $echo ) {
                echo apply_filters( 'my_get_calendar',  $cache[$key] );
                return;
            } else {

                return apply_filters( 'my_get_calendar',  $cache[$key] );
            }
        }
    }
 
    if ( !is_array($cache) )
        $cache = array();
 
    // Quick check. If we have no posts at all, abort!
    if ( !$posts ) {
        $gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = '$cpt' AND post_status = 'publish' LIMIT 1");
        if ( !$gotsome ) {
            $cache[ $key ] = '';
            wp_cache_set( 'my_get_calendar', $cache, 'calendar' );
            return;
        }
    }
 
    if ( isset($_GET['w']) )
        $w = ''.intval($_GET['w']);
 
    // week_begins = 0 stands for Sunday
    $week_begins = intval(get_option('start_of_week'));
 
    // Let's figure out when we are
    if ( !empty($monthnum) && !empty($year) ) {
        $thismonth = ''.zeroise(intval($monthnum), 2);
        $thisyear = ''.intval($year);
    } elseif ( !empty($w) ) {
        // We need to get the month from MySQL
        $thisyear = ''.intval(substr($m, 0, 4));
        $d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
        $thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
    } elseif ( !empty($m) ) {
        $thisyear = ''.intval(substr($m, 0, 4));
        if ( strlen($m) < 6 )
                $thismonth = '01';
        else
                $thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
    } else {
        $thisyear = gmdate('Y', current_time('timestamp'));
        $thismonth = gmdate('m', current_time('timestamp'));
    }

    $thisday = gmdate('d', current_time('timestamp'));
 
    $unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
    $last_day = date('t', $unixmonth);
 
    /* translators: Calendar caption: 1: month name, 2: 4-digit year */
    $calendar_caption = _x('%1$s %2$s', 'calendar caption');
    $calendar_output = '<table id="wp-calendar">
    <caption>' . sprintf($calendar_caption, $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</caption>
    <thead>
    <tr>';
 
    $myweek = array();
 
    for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
        $myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
    }
 
    foreach ( $myweek as $wd ) {
        $day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
        $wd = esc_attr($wd);
        $calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
    }
 
    $calendar_output .= '</tr></thead>';
 
 
    $calendar_output .= '<tbody><tr>';

 
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
        $ak_title_separator = "\n";
    else
        $ak_title_separator = ', ';
 
    $daywithpost = array();
    $ak_titles_for_day = array();
    $ak_post_infos = $wpdb->get_results("SELECT ID, post_title as title, DAYOFMONTH(meta_value) as dom
        FROM $wpdb->posts
        INNER JOIN $wpdb->postmeta
        ON $wpdb->posts.ID = $wpdb->postmeta.post_id
        WHERE meta_key = 'date'
        AND meta_value >= '{$thisyear}-{$thismonth}-{$thisday}'
        AND meta_value <= '{$thisyear}-{$thismonth}-{$last_day}'
        AND post_type = '$cpt'
        AND post_status = 'publish'
        ORDER BY meta_value ASC"
    );
    if ( $ak_post_infos ) {
        foreach ( (array) $ak_post_infos as $ak_post_info ) {

          $daywithpost[] = $ak_post_info->dom;
 
                /** This filter is documented in wp-includes/post-template.php */
                if( $ak_post_info->title != null) {
                  $post_title = esc_attr( apply_filters( 'the_title', $ak_post_info->post_title, $ak_post_info->ID ) );
                } else {
                  $post_title = '';
                }

                if ( empty($ak_titles_for_day['day_'.$ak_post_info->dom]) )
                    $ak_titles_for_day['day_'.$ak_post_info->dom] = '';
                if ( empty($ak_titles_for_day["$ak_post_info->dom"]) ) // first one
                    $ak_titles_for_day["$ak_post_info->dom"] = $post_title;
                else
                    $ak_titles_for_day["$ak_post_info->dom"] .= $ak_title_separator . $post_title;
        }
    }
 
    // See how much we should pad in the beginning
    $pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
    if ( 0 != $pad )
        $calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';
 
    $daysinmonth = intval(date('t', $unixmonth));
    $isPassed = true;
    for ( $day = 1; $day <= $daysinmonth; ++$day ) {
        if ( isset($newrow) && $newrow )
            $calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
        $newrow = false;
 
        if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) ) {
            $calendar_output .= '<td id="today">';
            $isPassed = false;
        } else if ( $isPassed ) {
            $calendar_output .= '<td class="past-day">';
        } else {
            $calendar_output .= '<td>';
        }
 
        if ( in_array($day, $daywithpost) ) // any posts today?
                $calendar_output .= '<a data-n="'. $day . '">'.$day.'</a>';
        else
            $calendar_output .= $day;
        $calendar_output .= '</td>';
 
        if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
            $newrow = true;
    }
 
    $pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
    if ( $pad != 0 && $pad != 7 )
        $calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';
 
    $calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";

    if ( $ak_post_infos ) {
        foreach ( (array) $ak_post_infos as $ak_post_info ) {
          $calendar_output .= '<div class="calendar-post cf"><img src="'.get_template_directory_uri().'/library/images/artist-img.png"><a href="'.get_permalink($ak_post_info->ID).'" data-n="'.$ak_post_info->dom.'">'.$ak_post_info->dom.'日 @ '.get_post_meta($ak_post_info->ID, 'venue')[0];
          $calendar_output .= '<span class="viewmore">view more<i class="fa fa-angle-double-right"></i></span><p class="calendar-post-title">'.$ak_post_info->title.'</p></a></div>';
      }
    }

 
    $cache[ $key ] = $calendar_output;
    wp_cache_set( 'my_get_calendar', $cache, 'calendar' );
 
    if ( $echo ) {
        // echo apply_filters( 'my_get_calendar',  $calendar_output );
        echo $calendar_output;
      }
    else
        return apply_filters( 'my_get_calendar',  $calendar_output );
 
} 


/****************************************************/
/******************* SHORT CODE ********************/
/****************************************************/
function back_to_top() {
  return home_url();
}
add_shortcode('backToTop', 'back_to_top');

function back_to_contact() {
  return get_permalink();
}
add_shortcode('backToContact', 'back_to_contact');

function back_to_live() {
  if( get_query_var( 'live_id' ) ) {
    return home_url().'/live/'.get_query_var( 'live_id' );
  }
  return home_url().'/live';
}
add_shortcode('backToLive', 'back_to_live');


/****************************************************/
/********** CUSTOMIZE MANAGEMENT SCREEN ***********/
/****************************************************/

/************ REMOVE HELP LINK IN DASHBOARD **********************/
function disable_help_link() {
    echo '<style type="text/css">
            #contextual-help-link-wrap {display: none !important;}
          </style>';
}
add_action('admin_head', 'disable_help_link');

// Custom Backend Footer
function bones_custom_admin_footer() {
  return 'Developed by shout-reverie ( Email:reverie.1026@gmail.com Tell:09027681529 )';
}
add_filter( 'admin_footer_text', 'bones_custom_admin_footer' );

// change login logo
function custom_login_logo() {
 echo '<style type="text/css">h1 a { width: 100% !important; background: url('.get_bloginfo('template_directory').'/library/images/login-logo.jpg) 50% 50% no-repeat !important; }</style>';
 }
add_action('login_head', 'custom_login_logo');

// ダッシュボードウィジェット非表示
function example_remove_dashboard_widgets() {
  if ( !current_user_can('level_10') ) { //level10以下のユーザーの場合ウィジェットをunsetする
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
  }
 }
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');

// '投稿'を'その他'に変更
function edit_admin_menus() {  
    global $menu;
    global $submenu;
 
    $menu[5][0] = 'その他';
    $submenu['edit.php'][5][0] = 'その他一覧';
}  
add_action( 'admin_menu', 'edit_admin_menus' ); 

// 左メニューに固定ページ追加
function test_admin_menu() {
    add_menu_page( 'BIOGRAPHY', 'BIOGRAPHY', 'read', 'post.php?post=34&action=edit', '', get_bloginfo('template_directory').'/library/images/custom-post-live-icon.png');
    add_menu_page( 'TOP', 'TOP', 'read', 'post.php?post=8&action=edit', '', get_bloginfo('template_directory').'/library/images/custom-post-live-icon.png');
}
add_action( 'admin_menu', 'test_admin_menu' );


/* DON'T DELETE THIS CLOSING TAG */ ?>
