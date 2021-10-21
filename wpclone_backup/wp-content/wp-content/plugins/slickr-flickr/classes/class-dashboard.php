<?php
class Slickr_Flickr_Dashboard extends Slickr_Flickr_Admin {
	private $settings = array(
			'flickr_id',
			'flickr_group',
			'flickr_api_key',
			'flickr_items',
			'flickr_type',
			'flickr_size',
			'flickr_album_order',
			'flickr_captions',
			'flickr_autoplay',
			'flickr_delay',
			'flickr_transition',
			'flickr_responsive',
			'flickr_lightbox',
			'flickr_thumbnail_border',
			'flickr_galleria',
			'flickr_galleria_theme',
			'flickr_galleria_theme_loading',
			'flickr_galleria_themes_folder',
			'flickr_galleria_options',
			'flickr_scripts_in_footer',
			'flickr_use_rss',
			'flickr_message',
			'flickr_silent',
			'flickr_per_page',
			);

	private $galleria_versions = array(
		'galleria-latest' => 'Galleria latest version',
		'galleria-original' => 'Galleria original version',
		'galleria-none' => 'Galleria not required so do not load the script'
	);

    private $lightboxes  = array(
		'sf-lightbox' => 'Default LightBox (pre-installed with this plugin)',
		'thickbox' => 'Thickbox (pre-installed with Wordpress)',
		'evolution' => 'Evolution LightBox for Wordpress (requires separate installation)',
		'fancybox' => 'FancyBox (requires separate installation)',
		'colorbox' => 'LightBox Plus for Wordpress (requires separate installation)',
		'responsive' => 'Responsive LightBox (requires separate installation)',
		'shutter' => 'Shutter Reloaded for Wordpress (requires separate installation)',
		'slimbox'=> 'SlimBox for Wordpress (requires separate installation)',
		'lightbox' => 'Some Other LightBox(requires separate installation)'
    );

    private $sizes = array('medium' => 'Medium (500px by 375px)',
			'm640' => 'Medium 640 (640px by 480px)',
			'm800' => 'Medium 800 (800px by 600px)',
			'large' => 'Large (1024px by 768px)',
			'original' => 'Original (2400px by 1800px)');

    private $types = array('gallery' => 'a gallery of thumbnail images',
			'galleria' => 'a galleria slideshow with thumbnail images below',
			'slideshow' => 'a slideshow of medium size images');

    private $tips;

	function init() {
		add_action('admin_menu',array($this, 'admin_menu'));
		add_filter('plugin_action_links',array($this, 'plugin_action_links'), 10, 2 );
        add_action('admin_enqueue_scripts', array($this ,'register_tooltip_styles'));
        add_action('admin_enqueue_scripts', array($this ,'register_admin_styles'));
	}

	function admin_menu() {
		$this->screen_id = add_options_page(SLICKR_FLICKR_PLUGIN_NAME, SLICKR_FLICKR_PLUGIN_NAME, 'manage_options', $this->get_slug(), array($this, 'page_content'));
		add_action('load-'.$this->get_screen_id(), array($this, 'load_page'));
	}
 
	function page_content() {
 		$this->print_admin_form_with_sidebar($this->admin_heading(), __CLASS__, $this->get_keys());
	} 

	function load_page() {
		$this->tips = $this->init_tips($this->settings);
		$this->set_tooltips($this->tips);
 		if (isset($_POST['options_update'])) $this->save() ;
		if (isset($_GET['cache'])) $this->clear_cache();  		
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin'));

		$this->add_meta_box('overview', $this->message('section_overview_title'), 'overview_panel');
		$this->add_meta_box('general', $this->message('section_general_title'), 'general_panel',array ('options' => $this->plugin->get_options()->get_options()), 'normal');
		$this->add_meta_box('extras', $this->message('section_extras_title'), 'extras_panel', null,'advanced');
		$this->add_meta_box('news', $this->message('plugin_news'), 'news_panel', null, 'advanced');
		$this->add_meta_box('help', 'Free Tutorials', 'tutorials_panel', null, 'side');
		$current_screen = get_current_screen();
		if (method_exists($current_screen,'add_help_tab')) {
			$current_screen->add_help_tab( array( 'id' => 'slickr_flickr_overview', 'title' => 'Overview', 		
				'content' => '<p>This admin screen is used to configure your Flickr settings, set display defaults, and choose which LightBox and version of the Galleria /theme you wish to use with Slickr Flickr.</p>'));	
			$current_screen->add_help_tab( array( 'id' => 'slickr_flickr_troubleshooting', 'title' => 'Troubleshooting', 		
				'content' => '<p>Make sure you only have one version of jQuery installed, and have a single LightBox activated otherwise you may have conflicts. For best operation your page should not have any JavaScript errors. Some Javascript conflicts are removed by loading Slickr Flickr in the footer (see Advanced Options)</p>
				<p>For help go to <a href="http://www.slickrflickr.com/slickr-flickr-help/">Slickr Flickr Help</a> or for priority support upgrade to <a href="http://www.slickrflickr.com/upgrade/">Slickr Flickr Pro</a></p>'));	
		}
	}

	function overview_panel($post, $metabox) {
      print $this->tabbed_metabox($metabox['id'],  array (
         $this->message('tab_intro') => $this->intro_panel(),
         $this->message('tab_features') => $this->features_panel(),
         $this->message('tab_version') => $this->version_panel(),
         $this->message('tab_help') => $this->help_panel(),
      ));
   }
			
	function intro_panel() {
		return $this->message('plugin_description');
	}

	function features_panel() {
		return $this->message('plugin_features');
	}
	
   	function version_panel() {
		return sprintf('<p>%1$s %2$s</p>', 
		  sprintf($this->message('plugin_version'), $this->get_name(), $this->get_version()), 
		  sprintf($this->message('plugin_changelog'),$this->plugin->get_changelog()) ); 
	}
	
	function help_panel() {
		return sprintf($this->message('plugin_help'), $this->plugin->get_home());
    }
    
	function general_panel($post,$metabox) {
      $options = $metabox['args']['options'];
      print $this->tabbed_metabox( $metabox['id'], array(
         $this->message('tab_identity') => $this->id_panel($options),
         $this->message('tab_display') => $this->display_panel($options),
         $this->message('tab_lightbox') => $this->lightbox_panel($options),
         $this->message('tab_galleria') => $this->galleria_panel($options),
         $this->message('tab_no_photos') => $this->no_photos_panel($options),
         $this->message('tab_advanced') => $this->advanced_panel($options)
		),1);
   }

	function id_panel($options) {		
      return 
		$this->fetch_form_field ('flickr_id', $options['id'], 'text', array(), array('maxlength' => 15, 'size' =>15)).
		$this->fetch_form_field ('flickr_group', $options['group'], 'select', array('n' => 'user', 'y' => 'group')).
		$this->fetch_form_field ('flickr_api_key', $options['api_key'], 'text', array(), array('maxlength' => 32,'size' =>32));
	}

	function display_panel($options) {		
	 	return
		$this->fetch_form_field ('flickr_items', $options['items'], 'text', array(), array('maxlength' => 4, 'size' => 4)).
		$this->fetch_form_field ('flickr_type', $options['type'], 'select', $this->types).
		$this->fetch_form_field ('flickr_size', $options['size'], 'select', $this->sizes).
		$this->fetch_form_field ('flickr_album_order', $options['album_order'], 'checkbox').		
		$this->fetch_form_field ('flickr_captions', $options['captions'], 'radio', array('on' => 'on','off' => 'off')).
		$this->fetch_form_field ('flickr_autoplay', $options['autoplay'], 'radio', array('on' => 'on','off' => 'off')).
		$this->fetch_form_field ('flickr_delay', $options['delay'], 'text', array(), array('maxlength' => 3, 'size' => 3, 'suffix' => 's')).
		$this->fetch_form_field ('flickr_transition', $options['transition'], 'text', array(), array('maxlength' => 3, 'size' => 3, 'suffix' => 's')).
		$this->fetch_form_field ('flickr_responsive', $options['responsive'], 'checkbox');
	}

	function lightbox_panel($options) {		
      return
		$this->fetch_form_field ('flickr_lightbox', $options['lightbox'], 'select', $this->lightboxes).
		$this->fetch_form_field ('flickr_thumbnail_border', $options['thumbnail_border'], 'text', array(), array('size' => 7, 'class' => 'color-picker'));
	}

	function galleria_panel($options) {		
      return
		$this->fetch_form_field ('flickr_galleria', $options['galleria'], 'select', $this->galleria_versions).
		$this->fetch_form_field ('flickr_galleria_theme', $options['galleria_theme'], 'text', array(), array('maxlength' => 20, 'size' => 12)).
		$this->fetch_form_field ('flickr_galleria_theme_loading', $options['galleria_theme_loading'], 'select', array('static' => 'Static','dynamic' => 'Dynamic')).
		$this->fetch_form_field ('flickr_galleria_themes_folder', $options['galleria_themes_folder'], 'text', array(), array('maxlength' => 255, 'size' => 50)).
		$this->fetch_form_field ('flickr_galleria_options', $options['galleria_options'], 'textarea', array(), array('cols' => 60, 'rows' => 4));
	}
	
	function no_photos_panel($options) {		
 		return	
		$this->fetch_form_field ('flickr_silent', $options['silent'], 'checkbox').
		$this->fetch_form_field ('flickr_message', $options['message'], 'text', array(), array( 'size' => 50));
	}

	function advanced_panel($options) {		
 		return	
		$this->fetch_form_field ('flickr_scripts_in_footer', $options['scripts_in_footer'], 'checkbox').
		$this->fetch_form_field ('flickr_use_rss', $options['use_rss'], 'select', array('y' => 'Flickr RSS', 'n' => 'Flickr API'));
	}

 	function extras_panel($post, $metabox) {
      print $this->tabbed_metabox( $metabox['id'], array(
         $this->message('tab_starting') => $this->starting_panel(),
         $this->message('tab_links') => $this->links_panel(),
         $this->message('tab_lightboxes') => $this->lightboxes_panel(),
         $this->message('tab_cache') => $this->cache_panel()
		),3);
   }	
	

    private function display_links($links) {
        $out = array();
        foreach ($links as $href => $text) 
        	$out[] = sprintf('<li><a href="%1$s" rel="external" target="_blank">%2$s</a></li>', $href, $text);	 
        return sprintf('<ul>%1$s</ul>', implode('', $out));
    }

 	function starting_panel() {	
		$home = $this->plugin->get_home();
        return $this->display_links (array(
            $home.'/40/how-to-use-slickr-flickr-admin-settings/' => 'How To Use Admin Settings',
            'https://idgettr.com/' => 'Find your Flickr ID',
            'https://www.flickr.com/services/api/keys/' => 'Get Your Flickr API Keys',
            $home.'/56/how-to-use-slickr-flickr-to-create-a-slideshow-or-gallery/' => 'How To Use The Plugin',
            $home.'/slickr-flickr-videos/' => 'Get FREE Video Tutorials',
        ));            
	}	

	function links_panel() {	 
		$home = $this->plugin->get_home();
        return $this->display_links (array(
            $home => 'Plugin Home Page',
            $home.'/1717/using-slickr-flickr-with-other-lightboxes' => 'Using Slickr Flickr with other lightboxes',
            'https://galleriajs.github.io/themes/' => 'Galleria Themes',
            $home.'/2328/load-javascript-in-footer-for-earlier-page-display/' => 'Loading Slickr Flickr scripts in the footer',
            $home.'/slickr-flickr-help/' => 'Get Help',
            $home.'/pro/' => 'Slickr Flickr Pro Bonus Features',
        ));   
	}

	function lightboxes_panel() {	 		
        return $this->display_links (array(
            'https://s3.envato.com/files/1099520/index.html' => 'Evolution Lightbox',
            'https://wordpress.org/extend/plugins/easy-fancybox/' => 'FancyBoxBox',
            'https://wordpress.org/extend/plugins/lightbox-plus/' => 'Lightbox Plus (ColorBox) for WordPress',
            'https://wordpress.org/extend/plugins/responsive-lightbox/' => 'Responsive Lightbox',
            'https://wordpress.org/extend/plugins/shutter-reloaded/' => 'Shutter Lightbox for WordPress',
            'https://wordpress.org/extend/plugins/slimbox/' => 'SlimBox',
        )); 
	}

	function cache_panel() {
		$url = $_SERVER['REQUEST_URI'];
		if (strpos($url, 'cache') === FALSE) $url .= '&cache=clear';	
		return sprintf('<p>%1$s</p>', $this->message('cache_instructions')) .
		  SPRINTF('<a id="slickr_flickr_cache" class="button-primary" href="%1$s" >Clear Cache</a>', $url);
	}	
 
   function clear_cache() {
        $_SERVER['REQUEST_URI'] = remove_query_arg( 'cache');  
        $cache = new Slickr_Flickr_Cache();
   		$cache->clear_all();
   		$this->add_admin_notice($this->message('cache_cleared'));
   		return true;
   }

	private function check_numeric_range($val, $default, $min, $max) {
		if ($good_val = filter_var ($val, FILTER_VALIDATE_INT, 
			array('options' => array('default' => $default, 'min_range' => $min, 'max_range' => $max))))
			return $good_val;
		else
			return $default;
	}

	function save() {
		check_admin_referer(__CLASS__);
		$settings = $this->message('settings_name');
		$updated = false;
        $options = $this->plugin->get_options();

  		$allowed_options = explode(',', stripslashes($_POST['page_options']));
  		if ($allowed_options) {
  			$flickr_options = array();
    		// retrieve option values from POST variables
    		foreach ($allowed_options as $option) {
       			$option = trim($option);
       			$key = substr($option,7);
       			$val = array_key_exists($option, $_POST) ? trim(stripslashes($_POST[$option])) : '';
				switch ($option) {
       				case 'flickr_per_page': $flickr_options[$key] = $this->check_numeric_range($val, 50, 50, 500); break;
 					default: $flickr_options[$key] = $val;
	    		}
    		} //end for
			
   			$updates = $options->save_options($flickr_options) ;
   			if ($updates)  {
            	$updated = true;
				$this->add_admin_notice($settings, $this->message('settings_saved'));
            } else {
      			$this->add_admin_notice($settings, $this->message('settings_unchanged'), true);
            }
  		} else {
         	$this->add_admin_notice($settings, $this->message('settings_not_found'), true);
  		}
  		return $updated ;
	}

 	function tutorials_panel($post,$metabox) {	
		$images_url = plugins_url('images',dirname(__FILE__));	
		$home = SLICKR_FLICKR_HOME;
		printf ('
<form id="slickr_flickr_signup" method="post" action="%1$s"
onsubmit="return slickr_flickr_validate_form(this)">
<img src="%2$s/free-video-tutorials-banner.png" alt="Slickr Flickr Tutorials Signup" />
<fieldset>
<input type="hidden" name="form_storm" value="submit"/>
<input type="hidden" name="destination" value="slickr-flickr"/>
<label for="firstname">First Name
<input id="firstname" name="firstname" type="text" value="" /></label><br/>
<label for="email">Email
<input id="email" name="email" type="text" /></label><br/>
<label id="lsubject" for="subject">Subject
<input id="subject" name="subject" type="text" /></label>
<input type="submit" value="" />
</fieldset>
</form>', $home, $images_url);
	}	
	
}
 