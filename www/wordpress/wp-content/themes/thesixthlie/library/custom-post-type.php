<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function custom_post_live() { 
	// creating (registering) the custom type 
	register_post_type( 'live', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
			'name' => 'ライブ', /* This is the Title of the Group */
			'singular_name' => 'ライブ', /* This is the individual type */
			'all_items' => 'ライブ一覧', /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => '新規ライブを追加', /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => 'ライブを編集', /* Edit Display Title */ 
			'new_item' => '新規ライブ', /* New Display Title */
			'view_item' => 'ライブを表示', /* View Display Title */
			'search_items' => 'ライブを検索', /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => 'ライブを投稿します', /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-live-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'live', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'live', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type( 'category', 'custom_type' );
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type( 'post_tag', 'custom_type' );

	flush_rewrite_rules(false);
	
}

function custom_post_video() { 
	// creating (registering) the custom type 
	register_post_type( 'video', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
			'name' => 'ビデオ', /* This is the Title of the Group */
			'singular_name' => 'ビデオ', /* This is the individual type */
			'all_items' => 'ビデオ一覧', /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => '新規ビデオを追加', /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => 'ビデオを編集', /* Edit Display Title */ 
			'new_item' => '新規ビデオ', /* New Display Title */
			'view_item' => 'ビデオを表示', /* View Display Title */
			'search_items' => 'ビデオを検索', /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => 'ビデオを投稿します', /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-video-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'video', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'video', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type( 'category', 'custom_type' );
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type( 'post_tag', 'custom_type' );

	flush_rewrite_rules(false);
	
}

function custom_post_discography() { 
	// creating (registering) the custom type 
	register_post_type( 'discography', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
			'name' => '楽曲', /* This is the Title of the Group */
			'singular_name' => '楽曲', /* This is the individual type */
			'all_items' => '楽曲一覧', /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => '新規楽曲を追加', /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => '楽曲を編集', /* Edit Display Title */ 
			'new_item' => '新規楽曲', /* New Display Title */
			'view_item' => '楽曲を表示', /* View Display Title */
			'search_items' => '楽曲を検索', /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => '楽曲を投稿します', /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 7, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-discography-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'discography', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'discography', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type( 'category', 'custom_type' );
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type( 'post_tag', 'custom_type' );

	flush_rewrite_rules(false);
	
}


// adding the function to the Wordpress init
add_action( 'init', 'custom_post_live');
add_action( 'init', 'custom_post_video');
add_action( 'init', 'custom_post_discography');

// use number instead of post title for permanent link
// add_filter( 'post_type_link', 'my_post_type_link', 1, 2 );
// function my_post_type_link( $link, $post ){
// 	if ( 'live' === $post->post_type ) {
// 		return home_url( '/live/' . $post->ID );
// 	} else if ( 'video' === $post->post_type ) {
// 		return home_url( '/video/' . $post->ID );
// 	} else if ( 'discography' === $post->post_type ) {
// 		return home_url( '/discography/' . $post->ID );
// 	} else {
// 		return $link;
// 	}
// }

// add_filter( 'rewrite_rules_array', 'my_rewrite_rules_array' );
// function my_rewrite_rules_array( $rules ) {
// 	$new_rules = array( 
// 		'live/([0-9]+)/?$' => 'index.php?post_type=live&p=$matches[1]',
// 		'video/([0-9]+)/?$' => 'index.php?post_type=video&p=$matches[1]',
// 		'discography/([0-9]+)/?$' => 'index.php?post_type=discography&p=$matches[1]',
// 		'with_front' => false,
// 	);
// 	return $new_rules + $rules;
// }

	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// // now let's add custom categories (these act like categories)
	// register_taxonomy( 'custom_cat', 
	// 	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	// 	array('hierarchical' => true,     /* if this is true, it acts like categories */
	// 		'labels' => array(
	// 			'name' => __( 'Custom Categories', 'bonestheme' ), /* name of the custom taxonomy */
	// 			'singular_name' => __( 'Custom Category', 'bonestheme' ), /* single taxonomy name */
	// 			'search_items' =>  __( 'Search Custom Categories', 'bonestheme' ), /* search title for taxomony */
	// 			'all_items' => __( 'All Custom Categories', 'bonestheme' ), /* all title for taxonomies */
	// 			'parent_item' => __( 'Parent Custom Category', 'bonestheme' ), /* parent title for taxonomy */
	// 			'parent_item_colon' => __( 'Parent Custom Category:', 'bonestheme' ), /* parent taxonomy title */
	// 			'edit_item' => __( 'Edit Custom Category', 'bonestheme' ), /* edit custom taxonomy title */
	// 			'update_item' => __( 'Update Custom Category', 'bonestheme' ), /* update title for taxonomy */
	// 			'add_new_item' => __( 'Add New Custom Category', 'bonestheme' ), /* add new title for taxonomy */
	// 			'new_item_name' => __( 'New Custom Category Name', 'bonestheme' ) /* name title for taxonomy */
	// 		),
	// 		'show_admin_column' => true, 
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array( 'slug' => 'custom-slug' ),
	// 	)
	// );
	
	// // now let's add custom tags (these act like categories)
	// register_taxonomy( 'custom_tag', 
	// 	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	// 	array('hierarchical' => false,    /* if this is false, it acts like tags */
	// 		'labels' => array(
	// 			'name' => __( 'Custom Tags', 'bonestheme' ), /* name of the custom taxonomy */
	// 			'singular_name' => __( 'Custom Tag', 'bonestheme' ), /* single taxonomy name */
	// 			'search_items' =>  __( 'Search Custom Tags', 'bonestheme' ), /* search title for taxomony */
	// 			'all_items' => __( 'All Custom Tags', 'bonestheme' ), /* all title for taxonomies */
	// 			'parent_item' => __( 'Parent Custom Tag', 'bonestheme' ), /* parent title for taxonomy */
	// 			'parent_item_colon' => __( 'Parent Custom Tag:', 'bonestheme' ), /* parent taxonomy title */
	// 			'edit_item' => __( 'Edit Custom Tag', 'bonestheme' ), /* edit custom taxonomy title */
	// 			'update_item' => __( 'Update Custom Tag', 'bonestheme' ), /* update title for taxonomy */
	// 			'add_new_item' => __( 'Add New Custom Tag', 'bonestheme' ), /* add new title for taxonomy */
	// 			'new_item_name' => __( 'New Custom Tag Name', 'bonestheme' ) /* name title for taxonomy */
	// 		),
	// 		'show_admin_column' => true,
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 	)
	// );
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
	

?>
