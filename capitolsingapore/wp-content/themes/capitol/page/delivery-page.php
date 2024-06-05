<?php
/*
* Template Name: Delivery Page
*/
get_header(); ?>
<?php
global $post;
global $query_string;
$paged = (get_query_var('page')) ? get_query_var('page') : 1;
wp_reset_query();

$args = array(
  'post_type' => 'directory',
  'posts_per_page' => -1, //12
  // 'paged' => $paged,
  'orderby' => 'title',
  'order' => 'asc',
  'meta_key'    => 'delivery_url',
  'meta_value'  => '',
  'compare'     => 'NOT LIKE'
);
// $args['tax_query'][] = [
//   'relation'  => 'AND',
//   [
//     'taxonomy' => 'directory_category',
//     'field' => 'name',
//     'terms' => 'delivery',
//   ]
// ];
$dir = new WP_Query($args);
?>

<style type="text/css">
.bottom div {
    color: white;
    background: #998542;
    padding: 10px 15px;
    font-size: 12px;
    border-radius: 24px;
    cursor: pointer;
    margin-top: 8px;
}
.content-directory .container .para a {
  color: #9D8751;
}
</style>

<div class="hero-directory" style="margin-bottom: 16px;">
  <div class="container">
    <div class="tagline"><?php the_title(); ?></div>
  </div>
</div>

<!-- CONTENT BOX -->
<div class="content-directory" id="content-box">
  <div class="container">
  <!-- <div class="arc-message mb-5"> -->
    <div class="arc-message mb-5">
    <div class="para" style="text-align: center; line-height: 1.4em;"><?php echo get_field('delivery_desc'); ?></div>
    </div>

    <div class="d-flex flex-warp">
    <?php if ($dir->have_posts()) : ?>
      <?php 
      // $count = 1;
      while ($dir->have_posts()) : $dir->the_post(); ?>
        <?php $fields = get_fields(get_the_ID()); ?>
        <?php
            $link = $fields['website_url'];
            if (get_field('delivery_url') != null) :
            ?>
        <a class="d-flex w-25s" href="<?php echo get_field('delivery_url'); ?>" target="_blank">
        <!-- <a class="d-flex w-25s" href="<?= $link; ?>" target="_blank"> -->
        <div class="item">
          <div class="image">
            <div class="img" style="background: url(<?= $fields['main_image']; ?>)" alt=""></div>
          </div>
          <div class="content">
            <div class="name"><?php the_title(); ?></div>
            <div class="place">
              <div class="left"><img src="<?= get_template_directory_uri(); ?>/assets/img/point.png" alt=""><?= $fields['location_mark']; ?></div>
              <div class="right">
                <?php if ($fields['reserve_button']['chopee'] != null) : ?>
                  <!-- <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/chope.png" alt=""> -->
                <?php endif ?>
                <?php if ($fields['reserve_button']['hungry'] != null) : ?>
                  <!-- <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/hungry.png" alt=""> -->
                <?php endif ?>
                <?php if ($fields['reserve_button']['quandoo'] != null) : ?>
                  <!-- <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/quandoo.png" alt=""> -->
                <?php endif ?>
              </div>
            </div>
            <div class="bottom">
              <div class="btn-capitol" id="<?php the_title(); ?>">
                Order Now
              </div>
              <!-- <div class="btn-chijmes">
                Order from CHIJMES
              </div> -->
            </div>
          </div>
        </div>
        </a>
      <?php endif ?>
      <?php //$count++; 
    endwhile; ?>
    </div>
    <?php else : ?>
      <h4 class="tagline" style="text-align: center !important;margin: auto;color: black;font-size: 25px;">There's no post for this page at this moment</h4>
    <?php endif ?>
  </div>
</div>
<!-- END CONTENT BOX -->
<!-- CONTENT LIST  -->
<div class="content-directory-list" id="content-list">
  <div class="container">
    <?php if ($dir->have_posts()) : ?>
      <?php while ($dir->have_posts()) : $dir->the_post(); ?>
        <div class="item">
          <div class="name"> 1933 by Toast Box
            <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/chope.png" alt="">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/hungry.png" alt="">
          </div>
          <div class="place">
            <img class="nor" src="<?= get_template_directory_uri(); ?>/assets/img/list-place.png" alt="">
            <img class="hov" src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt="">
            #01-06
          </div>
          <div class="telp">
            <img class="nor" src="<?= get_template_directory_uri(); ?>/assets/img/list-phone.png" alt="">
            <img class="hov" src="<?= get_template_directory_uri(); ?>/assets/img/list-phone-2.png" alt="">
            +65 6873 2750
          </div>
          <div class="onHover">
            <div class="image">
              <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/10.png" alt="">
            </div>
            <div class="detail">
              <div class="title">Cane &amp; Juice</div>
              <div class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
              <div class="categories">
                <div class="text">Food &amp; Beverage</div>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>


  </div>
</div>
<!-- END CONTENT LIST -->
<!-- PAGINATION -->
<?php
$args = array(
  'base'      => site_url() . '/arcade/%_%',
  'format'    => '?page=%#%',
  'total'     => $dir->max_num_pages,
  'current'   => max(1, get_query_var('page')),
  'prev_next' => true,
  'prev_text' => __('<img src="' . get_template_directory_uri() . '/assets/img/prev.png" alt="">'),
  'next_text' => __('<img src="' . get_template_directory_uri() . '/assets/img/next.png" alt="">'),
  'type'      => 'array',
);
$paginate = paginate_links($args); ?>

<!-- <div class="pages">
  <div class="container">
    <nav>
      <?php if (!empty($paginate)) : ?>
        <ul class="pagination">
          <?php foreach ($paginate as $key => $value) : ?>
            <?php if ($value == $paged) : ?>
              <li class="page-item">
                <?= $value; ?>
              </li>
            <?php else : ?>
              <li class="page-item">
                <?= $value; ?>
              </li>
            <?php endif ?>
          <?php endforeach ?>
        </ul>
      <?php endif;
      wp_reset_postdata(); ?>
    </nav>
  </div>
</div> -->
<!-- END PAGINATION -->
<!-- END PAGINATION -->
<div class="space"></div>
<?php get_footer(); ?>