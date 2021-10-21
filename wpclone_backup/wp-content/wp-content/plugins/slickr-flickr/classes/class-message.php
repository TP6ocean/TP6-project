<?php
class Slickr_Flickr_Message {

    function __construct() {}

    function message($message_id) {
        $message ='';
        switch ($message_id) {

             /* Plugin info */
            case 'plugin_changelog':
               $message = __('See the <a href="%1$s" rel="external" target="_blank">changelog</a> for the full plugin history.',
               'slickr-flickr'); break;

            case 'plugin_description':
               $message = __("
<p>Slickr Flickr is a plugin which makes it easy to display your Flickr photos in slideshows, galleries and lightboxes.</p> 
<p><b>For a quick start, we recommend you fill in your Flickr ID in the Flickr Identity section. All the other fields are optional.</b></p>
                ",
               'slickr-flickr'); break;

            case 'plugin_features':
               $message = __("
<p>Slickr Flickr features include: 
<ol>
<li>photos selected by Flickr photosets, tags, galleries and favourites;</li>
<li>different types of display: slideshows, galleries and lightboxes ;</li>
<li>captions using titles and descriptions;</li>
<li>external linking;</li>
<li>various sizes</li>
</ol>
</p>
               ",
               'slickr-flickr'); break;
               
            case 'plugin_help':
               $message = __('For help and tutorials visit the <a href="%1$s">Slickr Flickr home page</a>.',
               'slickr-flickr'); break;
               
            case 'plugin_news':
               $message = __('Slickr Flickr News',
               'slickr-flickr'); break;
               
            case 'plugin_version':
               $message = __('This version of %1$s is %2$s.',
               'slickr-flickr'); break;

            /* end plugin info */
 
  
             /* Section titles */
            case 'section_overview_title':
               $message = __('Overview',
               'slickr-flickr'); break;

            case 'section_general_title':
               $message = __('General Settings',
               'slickr-flickr'); break;

            case 'section_extras_title':
               $message = __('Extras',
               'slickr-flickr'); break;


             /* END SECTION TITLES */

             /*  tabs */

            case 'tab_advanced':
               $message = __('Advanced',
               'slickr-flickr'); break;
               
            case 'tab_cache':
               $message = __('Clear RSS Cache',
               'slickr-flickr'); break;

            case 'tab_display':
               $message = __('Display',
               'slickr-flickr'); break;

            case 'tab_features':
               $message = __('Features',
               'slickr-flickr'); break;
                              
            case 'tab_galleria':
               $message = __('Galleria',
               'slickr-flickr'); break;

            case 'tab_help':
               $message = __('Help',
               'slickr-flickr'); break;
               
            case 'tab_identity':
               $message = __('Identity',
               'slickr-flickr'); break;

            case 'tab_intro':
               $message = __('Intro',
               'slickr-flickr'); break;
                              
            case 'tab_lightbox':
               $message = __('Lightbox',
               'slickr-flickr'); break;

            case 'tab_lightboxes':
               $message = __('Lightboxes',
               'slickr-flickr'); break;

            case 'tab_links':
               $message = __('Useful Links',
               'slickr-flickr'); break;
               
            case 'tab_no_photos':
               $message = __('No Photos',
               'slickr-flickr'); break;
               
            case 'tab_starting':
               $message = __('Getting Started',
               'slickr-flickr'); break;

            case 'tab_version':
               $message = __('Version',
               'slickr-flickr'); break;
  
             /* END TABS */
             
            /* Comment Tooltips */
            case 'flickr_id_heading':
               $message = __('Flickr ID',
               'slickr-flickr'); break;

            case 'flickr_id_tip':
               $message = __('The Flickr ID is required for you to be able to access your photos.<br/>You can find your Flickr ID by entering the URL of your Flickr photostream at https://idgettr.com',
               'slickr-flickr'); break;

            case 'flickr_group_heading':
               $message = __('Flickr User or Group',
               'slickr-flickr'); break;

            case 'flickr_group_tip':
               $message = __('Typically your default account will be a User account unless your site is supporting a Flickr Group.',
               'slickr-flickr'); break;

            case 'flickr_api_key_heading':
               $message = __('Flickr API Key',
               'slickr-flickr'); break;
               
 
            case 'flickr_api_key_tip':
               $message = __('The Flickr API Key is used if you want to be able to get more than 20 photos at a time.<br/>A Flickr API key looks something like this : 5aa7aax73kljlkffkf2348904582b9cc.<br/>You can find your Flickr API Key by logging in to Flickr and clicking the Get Your Flickr API Keys link in the Getting Started section.',
               'slickr-flickr'); break;

            case 'flickr_items_heading':
               $message = __('Number Of Photos',
               'slickr-flickr'); break;

            case 'flickr_items_tip':
               $message = __('Flickr recommend a maximum of 30 photos per page.',
               'slickr-flickr'); break;

            case 'flickr_type_heading':
               $message = __('Type of Display',
               'slickr-flickr'); break;

            case 'flickr_type_tip':
               $message = __('Choose the most common type of display for your photos.',
               'slickr-flickr'); break;

            case 'flickr_size_heading':
               $message = __('Photo Size',
               'slickr-flickr'); break;

            case 'flickr_size_tip':
               $message = __('Choose the default display size for your photos.',
               'slickr-flickr'); break;

            case 'flickr_album_order_heading':
               $message = __('Album order',
               'slickr-flickr'); break;

            case 'flickr_album_order_tip':
               $message = __('Show albums in the same order as Flickr.',
               'slickr-flickr'); break;

            case 'flickr_captions_heading':
               $message = __('Captions',
               'slickr-flickr'); break;

            case 'flickr_captions_tip':
               $message = __('Click to mark as spam any submission if a field specifically for the website holds a deep link (not the home page)',
               'slickr-flickr'); break;
               
            case 'flickr_autoplay_heading':
               $message = __('Autoplay',
               'slickr-flickr'); break;

            case 'flickr_autoplay_tip':
               $message = __('Enable autoplay if you generally want slideshows to play automatically.',
               'slickr-flickr'); break;
                 
            case 'flickr_delay_heading':
               $message = __('Delay Between Images',
               'slickr-flickr'); break;

            case 'flickr_delay_tip':
               $message = __('Set a default for the delay between slideshow images. This is typically in the range of 3 to 7 seconds.',
               'slickr-flickr'); break;

            case 'flickr_transition_heading':
               $message = __('Slideshow Transition',
               'slickr-flickr'); break;

            case 'flickr_transition_tip':
               $message = __('Set a default transition period between one slide disappearing and another appearing. This is typically between 0.5 and 2.0 seconds.',
               'slickr-flickr'); break;

            case 'flickr_responsive_heading':
               $message = __('Mobile Responsive',
               'slickr-flickr'); break;

            case 'flickr_responsive_tip':
               $message = __('Click to use the mobile responsive slider.',
               'slickr-flickr'); break;

            case 'flickr_lightbox_heading':
               $message = __('Lightbox',
               'slickr-flickr'); break;

            case 'flickr_lightbox_tip':
               $message = __('You can use a default Slickr Flickr LightBox, or Thickbox which comes with WordPress, or use another LightBox you have installed separately in your theme or another plugin.',
               'slickr-flickr'); break;

            case 'flickr_thumbnail_border_heading':
               $message = __('Highlight Color',
               'slickr-flickr'); break;

            case 'flickr_thumbnail_border_tip':
               $message = __('The highlight color appears in the photo border when the user moves their cursor over the image.',
               'slickr-flickr'); break;
	
            case 'flickr_galleria_heading':
               $message = __('Galleria Version',
               'slickr-flickr'); break;

            case 'flickr_galleria_tip':
               $message = __('Choose which version of the galleria you want to use. We recommend you use the latest version of the galleria as this has the most features.',
               'slickr-flickr'); break;

            case 'flickr_galleria_theme_heading':
               $message = __('Theme/Skin',
               'slickr-flickr'); break;

            case 'flickr_galleria_theme_tip':
               $message = __('Available themes are azur, classic, folio, fullscreen, miniml and twelve. Only enter a different value if you have purchased a premium Galleria theme or written one and located it under the themes folder specified below.',
               'slickr-flickr'); break;

            case 'flickr_galleria_theme_loading_heading':
               $message = __('Theme Load Method',
               'slickr-flickr'); break;

            case 'flickr_galleria_theme_loading_tip':
               $message = __('Choose <i>Static</i> if you are using the same Galleria theme thoughout the site otherwise choose <i>Dynamic</i> if you are using different themes on different pages.',
               'slickr-flickr'); break;

            case 'flickr_galleria_themes_folder_heading':
               $message = __('Custom Themes Folder',
               'slickr-flickr'); break;

            case 'flickr_galleria_themes_folder_tip':
               $message = __('The recommended location  for custom Galleria themes is "galleria/themes". This should be located outside the plugins folder since WordPress wipes the plugin folder of any extra files that are not part of the plugin during the update process.',
               'slickr-flickr'); break;

            case 'flickr_galleria_options_heading':
               $message = __('Galleria Options',
               'slickr-flickr'); break;

            case 'flickr_galleria_options_tip':
               $message = __('Here you can set default options for the Galleria.<br/>The correct format is like CSS with colons to separate the parameter name from the value and semi-colons to separate each pair: param1:value1;param2:value2;<br/>For example, transition:slide;transitionSpeed:1000; sets a one second slide transition.',
               'slickr-flickr'); break;
		  
            case 'flickr_silent_heading':
               $message = __('Silent Mode',
               'slickr-flickr'); break;

            case 'flickr_silent_tip':
               $message = __('Click the checkbox to suppress any response at all when no photos are found.',
               'slickr-flickr'); break;

            case 'flickr_message_heading':
               $message = __('Error Message',
               'slickr-flickr'); break;

            case 'flickr_message_tip':
               $message = __('Any message you enter here will replace the default message that is displayed when no photos are available for whatever reason.',
               'slickr-flickr'); break;

            case 'flickr_scripts_in_footer_heading':
               $message = __('Load Script In Footer',
               'slickr-flickr'); break;

            case 'flickr_scripts_in_footer_tip':
               $message = __('This option allows you to load Javascript in the footer instead of the header. This can be useful as it may reduce potential jQuery conflicts with other plugins.<br/>However, it will not work for all WordPress themes, specifically those that do not support loading of scripts in the footer using standard WordPress hooks and filters.',
               'slickr-flickr'); break;
               
            case 'flickr_use_rss_heading':
               $message = __('Default access method',
               'slickr-flickr'); break;

            case 'flickr_use_rss_tip':
               $message = __('Use Flickr RSS or Flickr API by default',
               'slickr-flickr'); break;

            /* END TOOLTIPS */ 
 
            /* Settings messages */                       
 
            case 'settings_name':
               $message = __('Slickr Flickr',
               'slickr-flickr'); break;
               
            case 'settings_not_found':
               $message = __('settings have not been found.',
               'slickr-flickr'); break;
               
            case 'settings_saved':
               $message = __('settings saved successfully.',
               'slickr-flickr'); break;

            case 'settings_unchanged':
               $message = __('settings have not been changed.',
               'slickr-flickr'); break;

            case 'cache_cleared':
               $message = __('WordPress RSS Slickr Flickr cache has been cleared.',
               'slickr-flickr'); break;

            case 'cache_instructions':
               $message = __('If you have a RSS caching issue where your Flickr updates have not yet appeared on Wordpress then click the button below to clear the RSS cache.',
               'slickr-flickr'); break;

        }
       return $message;     
    }

}