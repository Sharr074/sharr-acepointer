<?php get_header(); ?>
<?php
global $post;
global $query_string;
$paged = (get_query_var('page')) ? get_query_var('page') : 1;
$cat = (isset($_GET['category'])) ? $_GET['category'] : null;
wp_reset_query();
$args = array(
  'post_type' => 'directory',
  'posts_per_page' => 24,
  'post_status' => 'publish',
  'paged' => $paged,
  'order' => 'asc',
  'orderby' => 'title'
);

if ($cat != null) {
  $args['tax_query'] = array(
    array(
      'taxonomy'  => 'directory_category',
      'field'     => 'term_id',
      'terms'     => $cat
    )
  );
}


$dir = new WP_Query($args);

$category = get_terms([
  'taxonomy'  => 'directory_category',
  'exclude'=> [36]
  //    'hide_empty'  => false
]);
$levels = get_terms([
  'taxonomy'  => 'levels',
  //    'hide_empty'  => false
]);
$zones = get_terms([
  'taxonomy'  => 'zones',
  //    'hide_empty'  => false
]);
?>
<div class="hero-directory">
  <div class="container">
    <div class="tagline"><?= post_type_archive_title('', false); ?></div>
    <p style="margin: 16px auto; text-align: center;"><?php echo get_fields('options')['settings']['directory_desc']; ?></p>
  </div>
</div>
<!-- FILTER THING -->

<div class="filter">
  <div class="container">
    <div class="filter-content">
      <div class="search">
        <div class="input-group">
          <div class="input-group-prepend">
            <img src="<?= get_template_directory_uri(); ?>/assets/img/search-2.png" alt="">
          </div>
          <input class="form-control" id="filter-search" type="text" placeholder="Search by Shop Name">
        </div>
      </div>
      <div class="fil-categories">
        <select class="form-control" id="filter-categories" name="fil-categories">
          <option selected="" value="">Categories</option>
          <?php foreach ($category as $key => $value) : ?>
            <?php if ($cat != null && $cat == $value->term_id) : ?>
              <option value="<?= $value->term_id; ?>" selected><?= $value->name; ?></option>
            <?php else : ?>
              <option value="<?= $value->term_id; ?>"><?= $value->name; ?></option>
            <?php endif ?>
          <?php endforeach ?>
        </select>
      </div>
      <div class="fil-level">
        <select class="form-control" id="filter-level" name="fil-level">
          <option selected="" value="">Level</option>
          <?php foreach ($levels as $key => $value) : ?>
            <option value="<?= $value->term_id; ?>"><?= $value->name; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="fil-zone">
        <select class="form-control" id="filter-zone" name="fil-zone">
          <option selected="" value="">Zone</option>
          <?php foreach ($zones as $key => $value) : ?>
            <option value="<?= $value->term_id; ?>"><?= $value->name; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="change-view" id="view"><img id="list" src="<?= get_template_directory_uri(); ?>/assets/img/list.png" alt=""><img id="box" src="<?= get_template_directory_uri(); ?>/assets/img/box.png" alt=""></div>
    </div>
  </div>
</div>
<!-- END FILTER THING -->
<!-- CONTENT BOX -->
<div class="content-directory" id="content-box">
  <div class="container" id="ajaxContentBlock">
    <div class="d-flex flex-warp">
      <?php if ($dir->have_posts()) : ?>
        <?php while ($dir->have_posts()) : $dir->the_post(); ?>
          <?php $fields = get_fields(get_the_ID()); ?>
          <a class="d-flex w-25s" href="<?php the_permalink(); ?>">
            <div class=" item ">
              <div class="image">
                <div class="img" style="background: url(<?= $fields['main_image']; ?>)" alt=""></div>
              </div>
              <div class="content">
                <div class="name"><?php the_title(); ?></div>
                <div class="place">
                  <div class="left"><img src="<?= get_template_directory_uri(); ?>/assets/img/point.png" alt=""><?= $fields['location_mark']; ?></div>
                  <div class="right">

                  </div>
                </div>
                <div class="reserved">
                  <?php if ($fields['reserve_button']['chopee'] != null) : ?>
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/chope.png" alt="">
                  <?php endif ?>
                  <?php if ($fields['reserve_button']['hungry'] != null) : ?>
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/hungry.png" alt="">
                  <?php endif ?>
                  <?php if ($fields['reserve_button']['quandoo'] != null) : ?>
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/quandoo.png" alt="">
                  <?php endif ?>
                  <?php if ( get_the_ID() == 1636 ) :  ?> 
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/Wine-Dine_SG.jpeg" alt="">
                  <?php endif ?>
                </div>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      <?php endif ?>
    </div>
  </div>
</div>
<!-- END CONTENT BOX -->
<!-- CONTENT LIST  -->
<div class="content-directory-list" id="content-list">
  <div class="container" id="ajaxContentList">
    <?php if ($dir->have_posts()) : ?>
      <?php while ($dir->have_posts()) : $dir->the_post(); ?>
        <?php $fields = get_fields(get_the_ID()); ?>
        <div class="item">
          <a class="name" href="<?php the_permalink(); ?>">
            <span><?php the_title(); ?></span>
            <?php if ($fields['reserve_button']['chopee'] != null) : ?>
              <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/chope.png" alt="">
            <?php endif ?>
            <?php if ($fields['reserve_button']['hungry'] != null) : ?>
              <img src="<?= get_template_directory_uri(); ?>/assets/img/directory/hungry.png" alt="">
            <?php endif ?>
            <?php if ($fields['reserve_button']['quandoo'] != null) : ?>
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
              <div class="title"><?php the_title(); ?></div>
              <div class="desc"><?php the_content(); ?></div>
              <div class="categories">
                <?php $categ = wp_get_object_terms(get_the_ID(), 'directory_category'); ?>
                <?php if ($categ != false) : ?>
                  <?php foreach ($categ as $key => $value) : ?>
                    <div class="text"><?= $value->name; ?></div>
                  <?php endforeach ?>
                <?php endif ?>
              </div>
            </div>
          </div>

        </div>
      <?php endwhile; ?>
    <?php endif ?>

  </div>
</div>
<!-- END CONTENT LIST -->
<!-- PAGINATION -->

<?php
$args = array(
  'base'      => site_url() . '/directory/%_%',
  'format'    => '?page=%#%',
  'total'     => $dir->max_num_pages,
  'current'   => max(1, get_query_var('page')),
  'prev_next' => true,
  'prev_text' => __('<img src="' . get_template_directory_uri() . '/assets/img/prev.png" alt="">'),
  'next_text' => __('<img src="' . get_template_directory_uri() . '/assets/img/next.png" alt="">'),
  'type'      => 'array',
);
$paginate = paginate_links($args); ?>

<div class="pages">
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
</div>
<!-- END PAGINATION -->
<div class="space"></div>
<?php get_footer(); ?>