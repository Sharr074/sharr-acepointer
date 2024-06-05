<?php 
	add_action( "wp_ajax_changeGallery", "changeGallery" );
	add_action( "wp_ajax_nopriv_changeGallery", "changeGallery" );

	function changeGallery()
	{
		$id = $_POST['id'];
		if ($id !== 'all') {
			$field = get_fields($id);
			$arr = [];
			foreach ($field['gallery_photo'] as $key => $value) {
				echo '<div class="swiper-slide" data-toggle="modal" data-target="#galleryModal" data-slide-to="' . $key . '" data-key="gallery_' . $key . '"><div class="img" style="background:url(' . $value['photo'] . ') no-repeat;"></div></div>';
			}
		} else {
			$gallery = get_all_post_gallery();
			foreach ($gallery as $key => $value) {
				foreach ($value as $kis => $val) {
					echo '<div class="swiper-slide allPhoto" data-toggle="modal" data-target="#galleryModal" data-slide-to="'.$key.'" data-key="gallery_'.$key.'"><div class="img" style="background:url('.$val['img'].') no-repeat;"></div></div>';
				}
			}
		}
		die();
	}


	add_action( "wp_ajax_changeGalleryModal", "changeGalleryModal" );
	add_action( "wp_ajax_nopriv_changeGalleryModal", "changeGalleryModal" );

	function changeGalleryModal()
	{
		$id = $_POST['id'];
		if ($id !== 'all') {
			$field = get_fields($id);
			$arr = [];
			foreach ($field['gallery_photo'] as $key => $value) {
				if ($key == 0) {
					echo '<div class="carousel-item active"><img src="' . $value['photo'] . '" alt=""><div class="caption"><p>'.$value['photo_caption'].'</p></div></div>';
				} else {
					echo '<div class="carousel-item"><img src="' . $value['photo'] . '" alt=""><div class="caption"><p>' . $value['photo_caption'] . '</p></div></div>';
				}
			}
		} else {
			$gallery = get_all_post_gallery();
			foreach ($gallery as $key => $value) {
				foreach ($value as $kis => $val) {
					if ($kis == 0 && $key == 0) {
						echo '<div class="carousel-item active"><img src="' . $val['img'] . '" alt=""><div class="caption"><p>'.$val['caption'].'</p></div></div>';
					} else {
						echo '<div class="carousel-item"><img src="' . $val['img'] . '" alt=""><div class="caption"><p>' . $val['caption'] . '</p></div></div>';
					}
				}
			}
		}
		die();
	}

	add_action("wp_ajax_filterNowShowing", "filterNowShowing");
	add_action("wp_ajax_nopriv_filterNowShowing", "filterNowShowing");

	function filterNowShowing()
	{
		if ($_POST['date'] === '') : $date = null; else : $date = date('Ymd', strtotime($_POST['date'])); endif;
		$paging = $_POST['page'];

		$args = [
			'post_type' => 'now_showing',
			'posts_per_page'	=> 3,
			'paged'	=> $paging,
			'orderby' => 'id',
			'order'	=> 'ASC'
		];

		if ($_POST['genre'] !== 'all') {
			$args['tax_query'][] = [
				'relation'	=> 'AND',
				[
					'taxonomy' => 'now_showing_category',
					'field' => 'term_id',
					'terms' => $_POST['genre'],
				]
			];
		}


		if ($date != null) {
			$args['meta_query'][] = [
				'relation'	=> 'AND',
				[
					'key'	=> 'from',
					'value'	=> $date,
					'type'	=> 'DATE',
					'compare'=> '>='
				],
				
			];
		}

		$query = new WP_Query($args);
		$arr = [];

		if ((int)$query->found_posts > 0) {
			foreach ($query->posts as $key => $value) {
				$fields = get_fields($value->ID);
				$arr[$key]['title'] = $value->post_title;
				$arr[$key]['data'] = $fields;
				if (empty($fields['to'])) {
					$arr[$key]['data']['from_date'] = date('j M Y', strtotime($fields['from']));
					$arr[$key]['data']['to_date'] = 500;	
				} else {
					$arr[$key]['data']['from_date'] = date('j M', strtotime($fields['from']));
					$arr[$key]['data']['to_date'] = date('j M Y', strtotime($fields['to']));
				}
				
				$arr[$key]['data']['link'] = $fields['link_&_text'];
			}
			if ($paging != $query->max_num_pages) {
				$next = $paging + 1;
				if ($paging > 1) {
					$prev = $paging - 1;
				} else {
					$prev = null;
				}
			} else {
				$next = null;
				$prev = $paging - 1;
			}

		} else {
			$arr = null;
			$next = null;
			$prev = null;
		}

		$data = [
			'post'	=> $arr,
			'total_post'	=> $query->found_posts,
			'total_num_page' => $query->max_num_pages,
			'next_post'	=> $next,
			'prev_post'	=> $prev
		];
		echo json_encode($data);
		die();
	}
