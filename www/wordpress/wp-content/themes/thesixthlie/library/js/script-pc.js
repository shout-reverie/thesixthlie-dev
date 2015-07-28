/*
 * Put all your regular jQuery in here.
*/

(function($) {

jQuery(document).ready(function($) {
  if(is_home) {
    jQuery('.welcome').css({
      'height': viewport.height
    });
    jQuery('.welcome section').css({
      'bottom': viewport.height / 3
    });
  }
  jQuery('.wp-calendar tbody td a').hover(
    function(){
      var post_number = jQuery(this).data('n');
      jQuery('.calendar-post[data-n=' + post_number + ']').addClass('calendar-post-selected');
    },
    function(){
      var post_number = jQuery(this).data('n');
      jQuery('.calendar-post[data-n=' + post_number + ']').removeClass('calendar-post-selected');
    });

  jQuery('.w-title, .w-main, .w-desc').children().andSelf().contents().each(function() {
    if( this.nodeType == 3) {
      jQuery( this ).replaceWith(jQuery(this).text().replace(/(\S)/g, '<span>$1</span>' ));
    }
  });

  jQuery( '.plz-scroll' ).click(function() {
    /* Act on the event */
    jQuery('html, body').animate({scrollTop: viewport.height}, 800);
  });

}); /* end of as page load scripts */ 

})(jQuery);

jQuery(window).load(function(){
  if( is_home ) {
    var i, j, k;
    var passed = 600;
    jQuery( '.w-title' ).css( {'opacity': 1} );
    for( i=0; i <= jQuery( '.w-title' ).children().size(); i++) {
      jQuery( '.w-title' ).children('span:eq('+i+')').delay( 50*i + passed).animate( {'opacity':1}, 50 );
    };
    passed += 50*i;
    jQuery( '.w-main' ).css( {'opacity': 1} );
    for( j=0; j <= jQuery( '.w-main' ).children().size(); j++) {
      jQuery( '.w-main' ).children('span:eq('+j+')').delay( 100*j + passed).animate( {'opacity':1}, 100 );
    };
    passed += 100*j;
    jQuery( '.w-main' ).delay(passed).queue(function(){
      jQuery(this).css( {'border-color': '#fff'} ).dequeue();
    });
    jQuery( '.w-desc' ).css( {'opacity': 1} );
    for( k=0; k <= jQuery( '.w-desc' ).children().size(); k++) {
      jQuery( '.w-desc' ).children('span:eq('+k+')').delay( 50*k + passed).animate( {'opacity':1}, 50 );
    };
  }
});