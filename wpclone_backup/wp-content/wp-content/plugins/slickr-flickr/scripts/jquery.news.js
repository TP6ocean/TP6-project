function slickr_flickr_news_ajax(url) {
	var data = { action: slickr_flickr_news.ajaxaction, security: slickr_flickr_news.ajaxnonce, url: url };     
	jQuery.post( slickr_flickr_news.ajaxurl, data, function( response ) {
   	var ele = jQuery(slickr_flickr_news.ajaxresults);
      if( response.success ) 
      	ele.append( response.data );
/*      else if ( response.data.error )
      	ele.append( response.data.error );
*/
   });
}    

jQuery(document).ready(function($) {
	if (typeof slickr_flickr_news0 != 'undefined') slickr_flickr_news_ajax(slickr_flickr_news0.feedurl );
	if (typeof slickr_flickr_news1 != 'undefined') slickr_flickr_news_ajax(slickr_flickr_news1.feedurl );   
	if (typeof slickr_flickr_news2 != 'undefined') slickr_flickr_news_ajax(slickr_flickr_news2.feedurl );
});