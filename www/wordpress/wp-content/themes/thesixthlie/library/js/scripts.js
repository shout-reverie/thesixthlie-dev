/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;

if( typeof is_home === "undefined" ) {
  var is_home = jQuery('body').hasClass('home');
}

jQuery(window).resize(function () {
    // if we're on the home page, we wait the set amount (in function above) then fire the function
    if( is_home ) { waitForFinalEvent( function() {
	    // update the viewport, in case the window size has changed
	    viewport = updateViewportDimensions();
      // if we're above or equal to 768 fire this off
      if( viewport.width >= 768 ) {
        console.log('On home page and window sized to 768 width or more.');
      } else {
        // otherwise, let's do this instead
        console.log('Not on home page, or window sized to less than 768.');
      }

    }, timeToWaitForLast, "your-function-identifier-string"); }
 });

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
// function loadGravatars() {
//   // set the viewport using the function above
//   viewport = updateViewportDimensions();
//   // if the viewport is tablet or larger, we load in the gravatars
//   if (viewport.width >= 768) {
//   jQuery('.comment img[data-gravatar]').each(function(){
//     jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
//   });
// 	}
// } // end function

/*
*  render_map
*/
function render_map( $el ) {
  // var
  var $markers = $el.find('.marker');
  // vars
  var args = {
    zoom    : 16,
    center    : new google.maps.LatLng(0, 0),
    mapTypeId : google.maps.MapTypeId.ROADMAP
  };
  // create map           
  var map = new google.maps.Map( $el[0], args);
  // add a markers reference
  map.markers = [];
  // add markers
  $markers.each(function(){
      add_marker( $(this), map );
  });
  // center map
  center_map( map );
}

/*
*  add_marker
*/
function add_marker( $marker, map ) {
  // var
  var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
  // create marker
  var marker = new google.maps.Marker({
    position  : latlng,
    map     : map
  });
  // add to array
  map.markers.push( marker );
  // if marker contains HTML, add it to an infoWindow
  if( $marker.html() ) {
    // create info window
    var infowindow = new google.maps.InfoWindow({
      content   : $marker.html()
    });
    // show info window when marker is clicked
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open( map, marker );
    });
  }
}

/*
*  center_map
*/
function center_map( map ) {
  // vars
  var bounds = new google.maps.LatLngBounds();
  // loop through all markers and create bounds
  $.each( map.markers, function( i, marker ){
    var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
    bounds.extend( latlng );
  });
  // only 1 marker?
  if( map.markers.length == 1 ) {
    // set center of map
      map.setCenter( bounds.getCenter() );
      map.setZoom( 16 );
  } else {
    // fit to bounds
    map.fitBounds( bounds );
  }
}

function getParam() {
  var url   = location.href;
  if ( !url.match( /live_id/ ) ) return false;
  var parameters    = url.split("?");
  var str = parameters[1];
  str = str.replace(/[&#]/g, "<>");
  var params   = str.split("<>");
  var paramsArray = [];
  for ( i = 0; i < params.length; i++ ) {
      neet = params[i].split("=");
      paramsArray.push(neet[0]);
      paramsArray[neet[0]] = neet[1];
  }
  var value = paramsArray["live_id"];
  return value;
}

function getNowPage() {
  var url   = location.href;
  if ( url.match( /news/ ) ) return 'news';
  if ( url.match( /live/ ) ) return 'live';
  if ( url.match( /discography/ ) ) return 'discography';
  if ( url.match( /video/ ) ) return 'video';
  return false;
}


/*
 * Put all your regular jQuery in here.
*/
(function($) {


jQuery(document).ready(function($) {

    if( !is_home ) {
      jQuery("body").removeClass( 'fade-body' );
    }

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  // loadGravatars();

  if( getParam() ) {
    jQuery('#reserve_live_title option').each(function() {
      if ( jQuery(this).val() == getParam() ) {
        jQuery('#reserve_live_title').val( getParam() );
        return false;
      }
    });
  }

  /***** top page carousel *****/
  jQuery('.bxslider').bxSlider({
    mode: 'fade',
    pager: false,
    controls: false,
    auto: true,
    speed: 1500,
    pause: 5000
  });

  /***** nav menu for mobile *****/
  jQuery('.mobile-menu').sidr({
    side: 'right'
  });

  jQuery( window ).touchwipe({
    // wipeLeft: function() {
    //   jQuery.sidr('open', 'sidr');
    // },
    wipeRight: function() {
      jQuery.sidr('close', 'sidr');
    },
    preventDefaultEvents: false
  });

  jQuery( '.mobile-menu-trigger' ).on( 'touchstart', function(){
    event.preventDefault();
    jQuery.sidr('close', 'sidr');
  })

  /**** for display google map ****/
  jQuery('.acf-map').each(function(){
    render_map( jQuery(this) );
  });

  jQuery('span.error').each(function(){
    jQuery(this).prev().toggleClass('error-view');
  });

  jQuery('form input, form textarea').focus(function(){
    jQuery(this).removeClass('error-view');
  });

}); /* end of as page load scripts */

/********** ajax ***************/
var now_post_num = 7; // 現在表示されている数
var get_post_num = 7; // もっと読むボタンを押した時に取得する数

jQuery("#more a").live("click", function() {
  console.log( getNowPage() );
  jQuery("#more").html('<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>');
  jQuery.ajax({
      type: 'post',
      url: ajaxurl,
      data: {
          'now_post_num': now_post_num,
          'get_post_num': get_post_num,
          'now_page': getNowPage()
      },
      success: function(data) {
          now_post_num = now_post_num + get_post_num;
          data = JSON.parse(data);
          if (data['html']) jQuery("#main").append(data['html']);
          jQuery("#more").remove();
          if (!data['noDataFlg']) {
              jQuery("#main").append('<p id="more"><a href="#">LOAD MORE</a></p>');
          }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          jQuery("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
          jQuery("#textStatus").html("textStatus : " + textStatus);
          jQuery("#errorThrown").html("errorThrown : " + errorThrown.message);
      }
  });
  return false;
});

})(jQuery);

jQuery(".welcome-load-img").bind('load', function() {
  jQuery("body").removeClass( 'fade-body' );
});

