<?php 
	include dirname(__FILE__) . '/ajax/ajax_directory.php';
	include dirname(__FILE__) . '/ajax/ajax_theatre.php';

	add_filter('wpcf7_autop_or_not', '__return_false');
	
	add_filter('wpcf7_form_elements', function ($content) {
		$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
		return $content;
	});

	// Load Style
	function load_theme_styles() {
		// wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/assets/css/vendor/bootstrap/bootstrap.css' );
		// wp_enqueue_style( 'swiper_css', get_template_directory_uri() . '/assets/css/vendor/swiper/swiper.min.css' );
		wp_enqueue_style( 'main_css', get_template_directory_uri() . '/assets/css/app.css' );
        wp_enqueue_style( 'pannellum_css', '//cdn.jsdelivr.net/npm/pannellum@2.5.4/build/pannellum.css' );
        wp_enqueue_style( 'bootstrap_datepicker_css', get_template_directory_uri() . '/assets/css/vendor/bootstrap/bootstrap-datepicker.css' );
	}

	add_action( "wp_enqueue_scripts", "load_theme_styles" );

	// Load Script
	function load_theme_scripts() {
		// wp_deregister_script( "jquery" );
		// wp_enqueue_script( "jquery", "//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js", array(), "3.4.1");
		wp_enqueue_script( "jquery1", "//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js", array(), "3.1.1");
		wp_enqueue_script( "tweenlite", "//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenLite.min.js", array(), '1.19.1', true);
		wp_enqueue_script( "popper", "//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js", array(), '1.12.9', true );
		wp_enqueue_script( "panellum", "//cdn.jsdelivr.net/npm/pannellum@2.5.4/build/pannellum.js", array(), "2.5.4" );
		wp_enqueue_script( "gsap", "//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/plugins/CSSPlugin.min.js", array(), '1.19.1', true);
		wp_enqueue_script( "main_js", get_template_directory_uri() . "/assets/js/app.js", array(), "2.5.3", true );
		wp_enqueue_script( "bootstrap_js", get_template_directory_uri() . "/assets/js/vendor/bootstrap.js", array(), "", true );
		wp_enqueue_script( "bootstrap_datepicker_js", get_template_directory_uri() . "/assets/js/vendor/bootstrap-datepicker.js", array(), "", true );
	}


	add_action( "wp_enqueue_scripts", "load_theme_scripts" );
	add_action('wp_head', 'myplugin_ajaxurl');

	function myplugin_ajaxurl() {
	   echo '<script type="text/javascript">
	           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
	         </script>';
	}

	// Support Thumbnail
	add_theme_support( "post-thumbnails" );

	// Register Site Settings
	if ( function_exists( 'acf_add_options_page' ) ) {
		$parent = acf_add_options_page(
			array(
				'page_title' => 'Site Settings',
				'menu_title' => 'Site Settings',
				'menu_slug'  => 'site-settings',
				'redirect' 		=> false
			)
		);
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Archive Happening',
			'menu_title' 	=> 'Archive Happening',
			'parent_slug' 	=> $parent['menu_slug'],
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Archive Theatre',
			'menu_title' 	=> 'Archive Theatre',
			'parent_slug' 	=> $parent['menu_slug'],
		));
	}

	function convert_date($date)
	{
		$data = DateTime::createFromFormat('m/d/Y', $date);
		return $data->format('D, M j');
	}

	function add_additional_class_on_li($classes, $item, $args) {
	    if($args->add_li_class) {
	        $classes[] = $args->add_li_class;
	    }
	    return $classes;
	}
	add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

	add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
	function special_nav_class ($classes, $item) {
	    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
	        $classes[] = 'active ';
	    }
	    return $classes;
	}

	function get_latest_happening_theatre()
	{
		$args = [
			'post_type'	=> ['happening', 'theatre'],
			'post_status'	=> 'publish',
			'posts_per_page' => -1,
		];
		$thisMonth = date('m');
		$query = new WP_Query($args);
		$arr = [];
		foreach ($query->posts as $key => $value) {
			$fields = get_fields($value->ID);
			if ($value->post_type === 'happening') {
				$start = date('m', strtotime($fields['event_details']['date_&_time']['start_date']));
				$end = date('m', strtotime($fields['event_details']['date_&_time']['end_date']));
				if ($thisMonth === $start) {
					$arr[$key]['post_type'] = $value->post_type;
					$arr[$key]['post_id'] = $value->ID;
					$arr[$key]['post_title'] = $value->post_title;
					$arr[$key]['time'] = human_time_diff(strtotime($fields['event_details']['date_&_time']['start_date']), current_time('timestamp')) . ' ago';
					$arr[$key]['field'] = $fields;
				} else {
					if ($end === $thisMonth) {
						$arr[$key]['post_type'] = $value->post_type;
						$arr[$key]['post_id'] = $value->ID;
						$arr[$key]['post_title'] = $value->post_title;
						$arr[$key]['field'] = $fields;
					}
				}
			} else {
				$start = date('m', strtotime($fields['from']));
				$end = date('m', strtotime($fields['to']));
				if ($thisMonth === $start) {
					$arr[$key]['post_type'] = $value->post_type;
					$arr[$key]['post_id'] = $value->ID;
					$arr[$key]['post_title'] = $value->post_title;
					$arr[$key]['time'] = human_time_diff(strtotime($fields['from']), current_time('timestamp')) . ' ago';
					$arr[$key]['field'] = $fields;
				} else {
					if ($end === $thisMonth) {
						$arr[$key]['post_type'] = $value->post_type;
						$arr[$key]['post_id'] = $value->ID;
						$arr[$key]['post_title'] = $value->post_title;
						$arr[$key]['time'] = human_time_diff(strtotime($fields['from']), current_time('timestamp')) . ' ago';
						$arr[$key]['field'] = $fields;
					}
				}
			}
		}
		return $arr;
	}

	function get_latest_directory()
	{
		$args = [
			'post_type'	=> 'directory',
			'post_status'	=> 'publish',
			'posts_per_page' => 2,
			'date_query'	=> [
				'column'	=> 'post_date',
				'after'		=> '-7 days'
			]
		];

		$query = new WP_Query($args);
		return [
			'total'	=> count($query->posts),
			'post'	=> $query->posts
		];
	}
	
	function post_gallery_get($limit = null)
    {
       $args = [
         'post_type' => 'photo_gallery',
         'post_status'  => 'publish',
       ];
       
       if ($limit != null)
       {
          $args['posts_per_page'] = $limit;
       } else {
          $args['posts_per_page'] = -1;
       }
       
       $query = new WP_Query($args);
       if ($query->post_count > 0) {
          return $query->posts;
       } else {
          return false;
       }
       
    }
    
    function get_all_post_gallery()
    {
       $data = post_gallery_get();
       if ($data != false) {
          $arr = [];
          foreach($data as $key => $value) {
			$field = get_fields($value->ID);

			foreach ($field['gallery_photo'] as $kis => $vals) {
				$arr[][$kis] = [
					'img'	=> $vals['photo'],
					'caption'	=> $vals['photo_caption']
				];
			}
          }
          return $arr;
       } else {
          return false;
       }
    }
    
	
   function upcoming_shows()
   {
      
      $args = [
        'post_type'	=> 'theatre',
        'post_status'	=> 'publish',
        'posts_per_page' => 3,
      ];
      $query = new WP_Query($args);
      if ($query->post_count > 0) {
         $arr = [];
         foreach ($query->posts as $key => $value) {
            $field = get_fields($value->ID);
            $arr[$key]['title']	= $value->post_title;
            $arr[$key]['main_image'] = $field['main_image'];
            $arr[$key]['from'] = $field['from'];
            $arr[$key]['to'] = $field['to'];
            $arr[$key]['price'] = $field['price'];
            $arr[$key]['body_text']	= $field['body_text'];
            $arr[$key]['link']	= $field['link_&_text'];
         }
         return $arr;
      }
   }

	function now_showing()
	{

		$args = [
			'post_type'	=> 'now_showing',
			'post_status'	=> 'publish',
			'posts_per_page' => 3,
		];
		$query = new WP_Query($args);
		if ($query->post_count > 0) {
			$arr = [];
			foreach ($query->posts as $key => $value) {
				$field = get_fields($value->ID);
				$arr[$key]['title']	= $value->post_title;
				$arr[$key]['main_image'] = $field['main_image'];
				if (empty($field['to'])) {
					$arr[$key]['from'] = date('j M Y', strtotime($field['from']));
					$arr[$key]['to'] = 500;
				} else {
					$arr[$key]['from'] = date('j M', strtotime($field['from']));
					$arr[$key]['to'] = date('j M Y', strtotime($field['to']));
				}
				$arr[$key]['price'] = $field['price'];
				$arr[$key]['body_text']	= $field['body_text'];
				$arr[$key]['link']	= $field['link_&_text'];
			}
			return $arr;
		}
	}

	function happening_now_event($limit)
	{
		$first_next_month = date('Y-m-01');
		$end_next_month = date('Y-m-t');
		$args = [
			'post_type'	=> 'happening',
			'post_status'	=> 'publish',
			'posts_per_page'	=> (int)$limit,
			'meta_query'	=> [
				'relation'	=> 'OR',
				[
					'key'	=> 'event_details_date_&_time_start_date',
					'compare'	=> '>',
					'type'	=> 'DATE',
					'value'	=> $first_next_month
				],
				[
				    'key'   => 'event_details_date_&_time_start_date',
				    'compare'   => '<',
				    'type'  => 'DATE',
				    'value' => $end_next_month
				]
			],
			'orderby'	=> 'meta_value_num',
			'order'	=> 'ASC'
		];
		$query = new WP_Query($args);
		if ($query->post_count > 0) {
			return $query->posts;
		} else {
			return false;
		}
	}

	function upcoming_eventHappening($limit)
	{
		$today = date('Y-m-01');
		$first_next_month = date('Y-m-d', strtotime('+1 month', strtotime($today)));
		$end_next_month = date('Y-m-t', strtotime($first_next_month));
		$args = [
			'post_type'	=> 'happening',
			'post_status'	=> 'publish',
			'posts_per_page'	=> (int) $limit,
			'meta_query'	=> [
				'relation'	=> 'AND',
				[
					'key'	=> 'event_details_date_&_time_start_date',
					'compare'	=> 'BETWEEN',
					'type'	=> 'DATE',
					'value'	=> [$first_next_month, $end_next_month]
				]
			],
			'orderby'	=> 'meta_value_num',
			'order'	=> 'ASC'
		];
		$query = new WP_Query($args);
		if ($query->post_count > 0) {
			return $query->posts;
		} else {
			return false;
		}
	}

	function upcoming_show_auto($days, $limit = 5)
	{
		$today = date('Ymd', strtotime('now'));
		$intrvl = '+'.$days.' days';
		$next = date('Ymd', strtotime($intrvl));

		$args = [
			'post_type'	=> 'theatre',
			'post_status'	=> 'publish',
			'posts_per_page'	=> $limit,
			'meta_query'	=> [
				'relation'	=> 'AND',
				[
					'key'		=> 'from',
					'compare'	=> '<',
					'value'		=> $next
				]
			],
			'orderby'	=> 'meta_value_num',
			'order'		=> 'DESC'
		];
		$query = new WP_Query($args);
		if ($query->post_count > 0) {
			$arr = [];
			foreach ($query->posts as $key => $value) {
				$field = get_fields($value->ID);
				// if ($field['show_date'] > $today && $field['show_date'] < $next) {
					$arr[$key]['title']	= $value->post_title;
					$arr[$key]['main_image'] = $field['main_image'];
					$arr[$key]['from'] = date('j M', strtotime($field['from']));
					if (empty($field['to'])) {
						$arr[$key]['to'] = 500;
					} else {
						$arr[$key]['to'] = date('j M Y', strtotime($field['to']));
					}
					$arr[$key]['price'] = $field['price'];
					$arr[$key]['body_text']	= $field['body_text'];
					$arr[$key]['link']	= $field['link_&_text'];
				// }
			}
			return $arr;
		}
	}

	

// DISABLE XMLRPC
add_filter( 'xmlrpc_enabled', '__return_false' );
	

// ******************************************* START OF CHANGING LOGIN SLUG ******************************************* //
/* KELVIN ADDED HERE
// redirect wp-admin & wp-login.php to 404
add_action('init','redirect_to_change_avatar');
function redirect_to_change_avatar() {
    if ( strpos($_SERVER['REQUEST_URI'], '/wp-admin') !== false || strpos($_SERVER['REQUEST_URI'], '/wp-login.php') !== false ) {
        wp_redirect('/404/'); //change your error page link here 
        exit;
    }
}

// change wp-login.php > login
add_filter('site_url',  'wplogin_filter', 10, 3);
function wplogin_filter( $url, $path, $orig_scheme )
{
 $old  = array( "/(wp-login\.php)/");
 $new  = array( "login");
 return preg_replace( $old, $new, $url, 1);
}

// prevent after login goes to 404
add_filter( 'site_url',  'wpadmin_filter', 10, 3 );
function wpadmin_filter( $url, $path, $orig_scheme ) {
        return preg_replace( "/(wp-admin)/", WP_ADMIN_DIR, $url, 1 );
}

add_action( 'login_form', 'redirect_wp_admin' );
function redirect_wp_admin(){
        $redirect_to = $_SERVER['REQUEST_URI'];

        if ( count( $_REQUEST ) > 0 && array_key_exists( 'redirect_to', $_REQUEST ) ) {
                $check_wp_admin = stristr( $_REQUEST['redirect_to'], 'wp-admin' );
                if( $check_wp_admin ) {
                        wp_redirect( home_url() );
                        exit;
                }
        }
}

// redirect to login page when logout
add_action('wp_logout','unlog');
function unlog(){
  wp_redirect( site_url() . '/login' );
  exit();
}
KELVIN ENDED HERE */
// ******************************************* END OF CHANGING LOGIN SLUG ******************************************* //
