<?php
    require_once("../../../wp-config.php");
    $now_post_num = $_POST['now_post_num'];
    $get_post_num = $_POST['get_post_num'];
    $now_page = $_POST['now_page'];
    $next_now_post_num = $now_post_num + $get_post_num;
    $next_get_post_num = $get_post_num + $get_post_num;
    if( $now_page == 'news' ) {
        $sql = "SELECT
                $wpdb->posts.ID,
                $wpdb->posts.post_title,
                $wpdb->posts.post_type,
                $wpdb->posts.post_content
            FROM 
                $wpdb->posts
            WHERE 
                ( $wpdb->posts.post_type = 'post' OR $wpdb->posts.post_type = 'live' OR $wpdb->posts.post_type = 'discography' OR $wpdb->posts.post_type = 'video' ) AND $wpdb->posts.post_status = 'publish'
            ORDER BY 
                $wpdb->posts.post_date DESC 
            LIMIT $now_post_num, $get_post_num";
                  
        $results = $wpdb->get_results($sql);
          
        $sql = "SELECT
                $wpdb->posts.ID, 
                $wpdb->posts.post_title,
                $wpdb->posts.post_type,
                $wpdb->posts.post_content 
            FROM 
                $wpdb->posts
            WHERE 
                ( $wpdb->posts.post_type = 'post' OR $wpdb->posts.post_type = 'live' OR $wpdb->posts.post_type = 'discography' OR $wpdb->posts.post_type = 'video' ) AND $wpdb->posts.post_status = 'publish'
            ORDER BY 
                $wpdb->posts.post_date DESC 
            LIMIT $next_now_post_num, $next_get_post_num";
          
        $next_results = $wpdb->get_results($sql);
          
        $noDataFlg = 0;
        if ( count($results) < $get_post_num || !count($next_results) ) {
            $noDataFlg = 1;
        }
    
        $html = "";
          
        foreach ($results as $result) {
            $title = $result->post_title;
            if( $title == null && $result->post_type == 'live' ) {
                $date = new DateTime( get_post_meta($result->ID,'date')[0] );
                $date = $date->format('m.d');
                $title = $date.'@'.get_post_meta($result->ID,'venue')[0];
            }
            $excerpt = mb_substr(strip_tags($result->post_content), 0, 108);
            $html .= '<article class="cf topnews hentry" role="article" itemscope itemtype="http://schema.org/BlogPosting">';
            $html .= '<header>'.get_post_time('M d, Y','false',$result->ID);
            $html .= '<span class="post-type-wrapper">'.$result->post_type.'</span></header>';
            $html .= '<section class="cf entry-content" itemprop="articleBody"><h3 class="entry-title"><a href="'.get_permalink($result->ID).'">'.apply_filters('the_title', $title).'</a></h3>';
            $html .= '<p>'.$excerpt;
            if( mb_strlen($excerpt) >= 108 ) {
                $html .= '<span style="font-family: Helvetica Neue, Lato">...</span>';
                $html .= '<a class="excerpt-read-more" href="'.get_permalink($result->ID).'">view more<i class="fa fa-angle-double-right"></i></a>';
            }
            $html .= '</p></section></article>';
        }
        $returnObj = array();
        $returnObj = array(
            'noDataFlg' => $noDataFlg,
            'html' => $html
        );
        $returnObj = json_encode($returnObj);

        echo $returnObj;
    } else if ( $now_page == 'video' ) {
        $sql = "SELECT
                $wpdb->posts.ID,
                $wpdb->posts.post_title,
                $wpdb->posts.post_content
            FROM 
                $wpdb->posts  
            WHERE 
                $wpdb->posts.post_type = 'video' AND $wpdb->posts.post_status = 'publish'
            ORDER BY 
                $wpdb->posts.post_date DESC 
            LIMIT $now_post_num, $get_post_num";
                  
        $results = $wpdb->get_results($sql);
          
        $sql = "SELECT
                $wpdb->posts.ID, 
                $wpdb->posts.post_title,
                $wpdb->posts.post_content 
            FROM 
                $wpdb->posts  
            WHERE 
                $wpdb->posts.post_type = 'video' AND $wpdb->posts.post_status = 'publish'
            ORDER BY 
                $wpdb->posts.post_date DESC 
            LIMIT $next_now_post_num, $next_get_post_num";
          
        $next_results = $wpdb->get_results($sql);
          
        $noDataFlg = 0;
        if ( count($results) < $get_post_num || !count($next_results) ) {
            $noDataFlg = 1;
        }
    
        $html = "";
          
        foreach ($results as $result) {
            $html .= '<article class="cf hentry video" role="article">';
            $html .= '<section class="cf entry-content" itemprop="articleBody"><div class="video-container">'.get_post_meta($result->ID,'video_link')[0].'</div><h2 class="entry-title"><a href="'.get_permalink($result->ID).'">'.apply_filters('the_title', $result->post_title).'</a></h2>';
            $html .= '<p>'.strip_tags($result->post_content).'</p>';
            $html .= '<a href="'.get_permalink($result->ID).'" class="view-lyrics">lyrics<i class="fa fa-angle-double-right"></i></a></section></article>';
        }
        $returnObj = array();
        $returnObj = array(
            'noDataFlg' => $noDataFlg,
            'html' => $html
        );
        $returnObj = json_encode($returnObj);

        echo $returnObj;
    } else if ( $now_page == 'discography' ) {
        $sql = "SELECT
                $wpdb->posts.ID,
                $wpdb->posts.post_title,
                $wpdb->posts.post_content
            FROM 
                $wpdb->posts  
            WHERE 
                $wpdb->posts.post_type = 'discography' AND $wpdb->posts.post_status = 'publish'
            ORDER BY 
                $wpdb->posts.post_date DESC 
            LIMIT $now_post_num, $get_post_num";
                  
        $results = $wpdb->get_results($sql);
          
        $sql = "SELECT
                $wpdb->posts.ID, 
                $wpdb->posts.post_title,
                $wpdb->posts.post_content 
            FROM 
                $wpdb->posts  
            WHERE 
                $wpdb->posts.post_type = 'discography' AND $wpdb->posts.post_status = 'publish'
            ORDER BY 
                $wpdb->posts.post_date DESC 
            LIMIT $next_now_post_num, $next_get_post_num";
          
        $next_results = $wpdb->get_results($sql);
          
        $noDataFlg = 0;
        if ( count($results) < $get_post_num || !count($next_results) ) {
            $noDataFlg = 1;
        }
    
        $html = "";
          
        foreach ($results as $result) {
            $songs = get_post_meta($result->ID,'songs')[0];
            $html .= '<article class="cf discography hentry" role="article">';
            $html .= '<section class="cf entry-content" itemprop="articleBody"><div class="discography-img"><img width="125" height="125" src="'.get_the_post_thumbnail( $result->ID ).'" class="attachment-post-thumbnail wp-post-image"></duv>';
            $html .= '<h2><a href="'.get_permalink($result->ID).'">'.apply_filters('the_title', $result->post_title).'</a></h2>';
            $html .= '<p class="release-date">'.get_post_meta($result->ID,'date')[0].'</p>';
            $html .= '<p>'.$songs.'</p>';
            $html .= '<p>'.strip_tags($result->post_content).'</p>';
            $html .= '</section></article>';
        }
        $returnObj = array();
        $returnObj = array(
            'noDataFlg' => $noDataFlg,
            'html' => $html
        );
        $returnObj = json_encode($returnObj);

        echo $returnObj;
    } else if ( $now_page == 'live' ) {
        $sql = "SELECT
                $wpdb->posts.ID,
                $wpdb->posts.post_title,
                $wpdb->posts.post_content
            FROM 
                $wpdb->posts
            INNER JOIN
                $wpdb->postmeta
            ON
                $wpdb->posts.ID = $wpdb->postmeta.post_id
            WHERE 
                $wpdb->posts.post_type = 'live' AND $wpdb->posts.post_status = 'publish' AND $wpdb->postmeta.meta_key = 'date'
            ORDER BY 
                $wpdb->postmeta.meta_value ASC 
            LIMIT $now_post_num, $get_post_num";
                  
        $results = $wpdb->get_results($sql);
          
        $sql = "SELECT
                $wpdb->posts.ID,
                $wpdb->posts.post_title,
                $wpdb->posts.post_content
            FROM 
                $wpdb->posts
            INNER JOIN
                $wpdb->postmeta
            ON
                $wpdb->posts.ID = $wpdb->postmeta.post_id
            WHERE 
                $wpdb->posts.post_type = 'live' AND $wpdb->posts.post_status = 'publish' AND $wpdb->postmeta.meta_key = 'date'
            ORDER BY 
                $wpdb->postmeta.meta_value DESC 
            LIMIT $next_now_post_num, $next_get_post_num";
          
        $next_results = $wpdb->get_results($sql);
          
        $noDataFlg = 0;
        if ( count($results) < $get_post_num || !count($next_results) ) {
            $noDataFlg = 1;
        }
    
        $html = "";
          
        foreach ($results as $result) {
            $title = $result->post_title;
            if( $title == null && $result->post_type == 'live' ) {
                $date = new DateTime(get_post_meta($result->ID,'date')[0]);
                $date = $date->format('m.d');
                $title = $date.'@'.get_post_meta($result->ID,'venue')[0];
            }
            $html .= '<article class="cf live hentry live-list" role="article">';
            $html .= '<section class="cf entry-content" itemprop="articleBody"><table><tbody>';
            $html .= '<tr class="live-title"><td colspan="3"><a href="'.get_permalink($result->ID).'">'.apply_filters('the_title', $title).'</a></td></tr>';
            $html .= '<tr><td>DATE</td><td>■</td><td class="live-info">'.get_post_meta($result->ID,'date')[0].'</td></tr>';
            $html .= '<tr><td>VENUE</td><td>■</td><td class="live-info">'.get_post_meta($result->ID,'venue')[0].'</td></tr>';
            $html .= '<tr><td>TIME</td><td>■</td><td class="live-info"><span class="open-time">OPEN</span>';
            if( get_post_meta($result->ID,'open')[0] ) {
                $html .= date( 'H:i', get_post_meta($result->ID,'open')[0] );
            } else {
                $html .= '--:--';
            }
            $html .= '<span class="slash"> / </span>';
            if( get_post_meta($result->ID,'start')[0] ) {
                $html .= date( 'H:i', get_post_meta($result->ID,'start')[0] );
            } else {
                $html .= '--:--';
            }
            $html .= '</td></tr>';
            if( get_post_meta($result->ID,'link')[0] ) {
                $html .= '<tr><td>LINK</td><td>■</td><td class="live-info"><a class="live-link" href="'.get_post_meta($result->ID,'link')[0].'" target="_blank">'.get_post_meta($result->ID,'link')[0].'</a></td></tr>';
            }
            $html .= '</tbody></table>';
            $html .= '<div class="live-info-img">'.get_the_post_thumbnail( $result->ID ).'</div>';
            $html .= '<p>'.strip_tags($result->post_content).'</p>';
            $html .= '<p class="viewmore"><a href="'.get_permalink($result->ID).'">view more<i class="fa fa-angle-double-right"></i></a></p></section></article>';
        }
        $returnObj = array();
        $returnObj = array(
            'noDataFlg' => $noDataFlg,
            'html' => $html
        );
        $returnObj = json_encode($returnObj);

        echo $returnObj;
    }
?>