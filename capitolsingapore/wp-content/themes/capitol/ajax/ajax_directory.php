<?php
add_action("wp_ajax_directoryBlock", "directoryBlock");
add_action("wp_ajax_nopriv_directoryBlock", "directoryBlock");
add_action("wp_ajax_directoryList", "directoryList");
add_action("wp_ajax_nopriv_directoryList", "directoryList");

function title_filter($where, &$wp_query)
{
	global $wpdb;
	if ($search_term = $wp_query->get('search_prod_title')) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql(like_escape($search_term)) . '%\'';
	}
	return $where;
}

function directoryBlock()
{
	$args = [
		'post_type'	=> 'directory',
		'post_status' => 'publish',
		'orderby' => 'title',
		'order' => 'asc',
		'posts_per_page' => -1
	];

	if ($_POST['query'] !== '' || $_POST['query'] != null) {
		$args['search_prod_title'] = $_POST['query'];
	}

	if ($_POST['category'] !== '' || $_POST['category'] != null) {
		$args['tax_query'][] = array(
			'relation' => 'AND',
			array(
				'taxonomy'  => 'directory_category',
				'field'     => 'term_id',
				'terms'     => $_POST['category']
			)
		);
	}

	if ($_POST['level'] !== '' || $_POST['level'] != null) {
		$args['tax_query'][] = array(
			'relation' => 'AND',
			array(
				'taxonomy'  => 'levels',
				'field'     => 'term_id',
				'terms'     => $_POST['level']
			)
		);
	}

	if ($_POST['zone'] !== '' || $_POST['zone'] != null) {
		$args['tax_query'][] = array(
			'relation' => 'AND',
			array(
				'taxonomy'  => 'zones',
				'field'     => 'term_id',
				'terms'     => $_POST['zone']
			)
		);
	}


	add_filter('posts_where', 'title_filter', 10, 2);
	$q = new WP_Query($args);
	remove_filter('posts_where', 'title_filter', 10, 2);

	if ($q->post_count > 0) {
		$arr = [];
		$post = $q->posts;
		echo '<div class="d-flex flex-warp">';
		foreach ($post as $key => $value) {
			$fields = get_fields($value->ID);
			echo '<a class="d-flex w-25s" href="' . get_the_permalink($value->ID) . '"><div class="item">';
			echo '<div class="image">';
			echo '<div class="img" style="background: url(' . $fields['main_image'] . ')" alt=""></div>';
			echo '</div>';
			echo '<div class="content">';
			echo '<div class="name">' . $value->post_title . '</div>';
			echo '<div class="place">';
			echo '<div class="left"><img src="' . get_template_directory_uri() . '/assets/img/point.png" alt="">' . $fields['location_mark'] . '</div>';

			echo '<div class="right">';
			if (!empty($fields['reserve_button']['chopee']['url'])) {
				echo '<img src="' . get_template_directory_uri() . '/assets/img/directory/chope.png" alt="">	';
			}

			if (!empty($fields['reserve_button']['hungry']['url'])) {
				echo '<img src="' . get_template_directory_uri() . '/assets/img/directory/hungry.png" alt="">';
			}

			if (!empty($fields['reserve_button']['quandoo']['url'])) {
				echo '<img src="' . get_template_directory_uri() . '/assets/img/directory/quandoo.png" alt="">';
			}
			echo '</div>';


							echo '<div class="reserved">';
			    
			    if ($fields['reserve_button']['chopee'] !== ''){
		        echo '<img src="'.get_template_directory_uri().'/assets/img/directory/chope.png" alt="">	';
		        }

		        if ($fields['reserve_button']['hungry'] !== ''){		          		
		        echo '<img src="'.get_template_directory_uri().'/assets/img/directory/hungry.png" alt="">';
				}
				
				if ($fields['reserve_button']['hungry'] !== ''){ 
				 echo '<img src="'.get_template_directory_uri().'/assets/img/directory/quandoo.png" alt="">';
		        }
					
		      	 echo '</div>';

			echo '</div>';
			echo '</div>';
			echo '</div></a>';
		}
		echo '</div>';
	}
	die();
}

function directoryList()
{
	$args = [
		'post_type'	=> 'directory',
		'post_status' => 'publish',
		'orderby' => 'title',
		'order' => 'ASC'
	];

	if ($_POST['query'] !== '' || $_POST['query'] != null) {
		$args['search_prod_title'] = $_POST['query'];
	}

	if ($_POST['category'] !== '' || $_POST['category'] != null) {
		$args['tax_query'][] = array(
			'relation' => 'AND',
			array(
				'taxonomy'  => 'directory_category',
				'field'     => 'term_id',
				'terms'     => $_POST['category']
			)
		);
	}

	if ($_POST['level'] !== '' || $_POST['level'] != null) {
		$args['tax_query'][] = array(
			'relation' => 'AND',
			array(
				'taxonomy'  => 'levels',
				'field'     => 'term_id',
				'terms'     => $_POST['level']
			)
		);
	}

	if ($_POST['zone'] !== '' || $_POST['zone'] != null) {
		$args['tax_query'][] = array(
			'relation' => 'AND',
			array(
				'taxonomy'  => 'zones',
				'field'     => 'term_id',
				'terms'     => $_POST['zone']
			)
		);
	}
	add_filter('posts_where', 'title_filter', 10, 2);
	$q = new WP_Query($args);
	remove_filter('posts_where', 'title_filter', 10, 2);

	if ($q->post_count > 0) {
		$arr = [];
		$post = $q->posts;
		foreach ($post as $key => $value) {
			$fields = get_fields($value->ID); ?>
			<div class="item">
				<a class="name" href="<?= get_the_permalink($value->ID); ?>">
					<?= $value->post_title; ?>
					<?php if ($fields['reserve_button']['chopee']['url'] !== '') : ?>
						<img src="<?= get_template_directory_uri(); ?>/assets/img/directory/chope.png" alt="">
					<?php endif ?>
					<?php if ($fields['reserve_button']['hungry']['url'] !== '') : ?>
						<img src="<?= get_template_directory_uri(); ?>/assets/img/directory/hungry.png" alt="">
					<?php endif ?>
					<?php if ($fields['reserve_button']['quandoo']['url'] !== '') : ?>
						<img src="<?= get_template_directory_uri(); ?>/assets/img/directory/quandoo.png" alt="">
					<?php endif ?>
				</a>
				<div class="place">
					<img class="nor" src="<?= get_template_directory_uri(); ?>/assets/img/list-place.png" alt="">
					<img class="hov" src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt="">
					<?= $fields['location_mark']; ?>
				</div>
				<div class="telp">
					<img class="nor" src="<?= get_template_directory_uri(); ?>/assets/img/list-phone.png" alt="">
					<img class="hov" src="<?= get_template_directory_uri(); ?>/assets/img/list-phone-2.png" alt="">
					<?= $fields['contact']['code_area']; ?> <?= $fields['contact']['phone_number']; ?>
				</div>

				<div class="onHover">
					<div class="image">
						<img src="<?= $fields['main_image']; ?>" alt="">
					</div>
					<div class="detail">
						<div class="title"><?= $value->post_title; ?></div>
						<div class="desc"><?= $fields['description']; ?></div>
						<div class="categories">
							<?php $categ = wp_get_object_terms($value->ID, 'directory_category'); ?>
							<?php if ($categ != false) : ?>
								<?php foreach ($categ as $key => $value) : ?>
									<div class="text"><?= $value->name; ?></div>
								<?php endforeach ?>
							<?php endif ?>
						</div>
					</div>
				</div>

			</div>
<?php }
	}
	die();
}
