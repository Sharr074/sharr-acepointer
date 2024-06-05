<?php
/*
  * Template Name: Front Page
  */
$fields = get_fields();
get_header();
?>
<div class="hero-landing">
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <?php foreach ($fields['sliders'] as $key => $value) : ?>
        <div class="swiper-slide">
          <div class="item">
            <div class="img" style="background: url(<?= $value['background_image']; ?>)" alt=""></div>
            <div class="blackshadowhalf full"></div>
            <div class="text">
              <?php if ($value['title'] !== '') : ?>
                <div class="title"><?= $value['title']; ?></div>
              <?php endif; ?>
              <?php if ($value['body_text'] !== '') : ?>
                <div class="desc">
                  <?= $value['body_text']; ?>
                </div>
              <?php endif; ?>
              <?php if ($value['url_link'] !== '') : ?>
                <a class="explore" href="<?= $value['url_link']; ?>">
                  <img class="hero-more" src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt="">
                  <!-- <img class="hero-more-hover" src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt=""> -->
                  <?= $value['button_text']; ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <!-- <div class="pagination-wrap">
      <div class="swiper-count"></div>
      <div class="swiper-pagination"></div>
      <div class="total-slides"></div>
    </div> -->
    <div class="custom-arrow">
      <div class="swiper-button-next">
        <img src="<?= get_template_directory_uri(); ?>/assets/img/landing/icon-right.png" alt="">
        <!-- <img src="<?= get_template_directory_uri(); ?>/assets/img/next.png" alt=""> -->
      </div>
      <div class="swiper-button-prev">
        <img src="<?= get_template_directory_uri(); ?>/assets/img/landing/icon-left.png" alt="">
        <!-- <img src="<?= get_template_directory_uri(); ?>/assets/img/prev.png" alt=""> -->
      </div>
    </div>
  </div>
</div>

<?php if ($fields['happenings']['show_section']) : ?>
  <?php if ($fields['happenings']['happening_type'] === 'auto') : ?>
    <!-- Slides News -->
    <?php $news = get_latest_happening_theatre(); ?>
    <?php if (count($news) > 0) : ?>
      <div class="ln-latest">
        <div class="title">Happenings</div>
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <?php foreach ($news as $key => $value) : ?>
              <?php if ($value['post_type'] === 'theatre') : ?>
                <div class="swiper-slide">
                  <a class="item" href="<?= get_the_permalink($value['post_id']); ?>"><img src="<?= $value['field']['main_image']; ?>" alt="<?= $value['post_title']; ?>">
                    <div class="desc"><?= $value['post_title']; ?></div>
                    <div class="time"><?= $value['time'] ?></div>
                    <hr>
                  </a>
                </div>
              <?php else : ?>
                <div class="swiper-slide">
                  <a class="item" href="<?= get_the_permalink($value['post_id']); ?>"><img src="<?= $value['field']['main_image']; ?>" alt="<?= $value['post_title']; ?>">
                    <div class="desc"><?= $value['post_title']; ?></div>
                    <div class="time"><?= $value['time'] ?></div>
                    <hr>
                  </a>
                </div>
              <?php endif; ?>
            <?php endforeach ?>
          </div>
        </div>
        <div class="swiper-button-next swiper-button btn-lates-next"><img src="<?= get_template_directory_uri(); ?>/assets/img/bottom.png" alt=""></div>
        <div class="swiper-button-prev swiper-button btn-lates-prev"><img src="<?= get_template_directory_uri(); ?>/assets/img/top.png" alt=""></div>
      </div>
    <?php endif ?>
  <?php else : ?>
    <div class="ln-latest">
      <div class="title">Happenings</div>
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <?php foreach ($fields['happenings']['happening_post'] as $posts => $val) : ?>
            <?php $post = $val['post']; $field_post = get_fields($post->ID);?>
            <?php if ($post->post_type === 'theatre') : ?>
              <div class="swiper-slide">
                <a class="item" href="<?= get_the_permalink($post->ID); ?>"><img src="<?= $field_post['main_image']; ?>" alt="<?= $post->post_title; ?>">
                  <div class="desc"><?= $post->post_title; ?></div>
                  <div class="time"><?= $field_post['time'] ?></div>
                  <hr>
                </a>
              </div>
            <?php else : ?>
              <div class="swiper-slide">
                <a class="item" href="<?= get_the_permalink($post->ID); ?>"><img src="<?= $field_post['main_image']; ?>" alt="<?= $post->post_title; ?>">
                  <div class="desc"><?= $post->post_title; ?></div>
                  <div class="time"><?= $field_post['time']; ?></div>
                  <hr>
                </a>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="swiper-button-next swiper-button btn-lates-next"><img src="<?= get_template_directory_uri(); ?>/assets/img/bottom.png" alt=""></div>
      <div class="swiper-button-prev swiper-button btn-lates-prev"><img src="<?= get_template_directory_uri(); ?>/assets/img/top.png" alt=""></div>
    </div>
  <?php endif ?>
<?php endif; ?>


<?php $total_happening = count($fields['directory']['display_category']); ?>
<div class="ln-custom-<?= $total_happening; ?> directory-hp">
  <div class="title"><?= $fields['directory']['heading_title']; ?></div>


  <?php if ($total_happening == 1) : ?>
    <div class="row content">
      <?php foreach ($fields['directory']['display_category'] as $key => $value) : ?>
        <?php $tax = $value['category']; ?>
        <?php $image = get_field('category_image', $value['category']);
            $terms = get_terms($value['category']); ?>
        <div class="col-sm-12">
          <a class="item" href="<?= site_url() . '/directory/?category=' . $terms[0]->term_id; ?>">
            <div class="img" style="background: url(<?= $image; ?>)" alt=""></div>
            <div class="blackshadowhalf"></div>
            <div class="text"><?= $tax->name; ?></div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if ($total_happening == 2) : ?>
    <div class="row content">
      <?php foreach ($fields['directory']['display_category'] as $key => $value) : ?>
        <?php $tax = $value['category']; ?>
        <?php $image = get_field('category_image', $value['category']);
            $terms = get_terms($value['category']); ?>
        <div class="col-sm-6">
          <a class="item" href="<?= site_url() . '/directory/?category=' . $terms[0]->term_id; ?>">
            <div class="img" style="background: url(<?= $image; ?>)" alt=""></div>
            <div class="blackshadowhalf"></div>
            <div class="text"><?= $tax->name; ?></div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if ($total_happening == 3) : ?>
    <div class="row content">
      <?php $tax_1 = $fields['directory']['display_category'][0]['category']; ?>
      <?php $image_1 = get_field('category_image', $fields['directory']['display_category'][0]['category']);
        $terms_1 = get_terms($fields['directory']['display_category'][0]['category']); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_1[0]->term_id; ?>">
          <div class="img" style="background: url(<?= $image_1; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $tax_1->name; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <?php $image_2 = get_field('category_image', $fields['directory']['display_category'][1]['category']);
          $terms_2 = get_terms($fields['directory']['display_category'][1]['category']); ?>
        <div class="row m-rl-0">
          <div class="col-sm-12">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_2[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_2; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][1]['category']->name; ?></div>
            </a>
          </div>
        </div>
        <?php $image_3 = get_field('category_image', $fields['directory']['display_category'][2]['category']);
          $terms_3 = get_terms($fields['directory']['display_category'][2]['category']); ?>
        <div class="row m-rl-0">
          <div class="col-sm-12">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_3[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_3; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][2]['category']->name; ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($total_happening == 4) : ?>
    <div class="row content">
      <?php $tax_1 = $fields['directory']['display_category'][0]['category']; ?>
      <?php $image_1 = get_field('category_image', $fields['directory']['display_category'][0]['category']);
        $terms_1 = get_terms($fields['directory']['display_category'][0]['category']); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_1[0]->term_id; ?>">
          <div class="img" style="background: url(<?= $image_1; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $tax_1->name; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <?php $image_2 = get_field('category_image', $fields['directory']['display_category'][1]['category']);
          $terms_2 = get_terms($fields['directory']['display_category'][1]['category']); ?>
        <div class="row m-rl-0">
          <div class="col-sm-12">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_2[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_2; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][1]['category']->name; ?></div>
            </a>
          </div>
        </div>

        <div class="row m-rl-0">
          <?php $image_3 = get_field('category_image', $fields['directory']['display_category'][2]['category']);
            $terms_3 = get_terms($fields['directory']['display_category'][2]['category']); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_3[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_3; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][2]['category']->name; ?></div>
            </a>
          </div>
          <?php $image_4 = get_field('category_image', $fields['directory']['display_category'][3]['category']);
            $terms_4 = get_terms($fields['directory']['display_category'][3]['category']); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_4[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_4; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][3]['category']->name; ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($total_happening == 5) : ?>
    <div class="row content">
      <?php $tax_1 = $fields['directory']['display_category'][0]['category']; ?>
      <?php $image_1 = get_field('category_image', $fields['directory']['display_category'][0]['category']);
        $terms_1 = get_terms($fields['directory']['display_category'][0]['category']); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_1[0]->term_id; ?>">
          <div class="img" style="background: url(<?= $image_1; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $tax_1->name; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <div class="row m-rl-0">
          <?php $image_2 = get_field('category_image', $fields['directory']['display_category'][1]['category']);
            $terms_2 = get_terms($fields['directory']['display_category'][1]['category']); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_2[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_2; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][1]['category']->name; ?></div>
            </a>
          </div>
          <?php $image_3 = get_field('category_image', $fields['directory']['display_category'][2]['category']);
            $terms_3 = get_terms($fields['directory']['display_category'][2]['category']); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_3[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_3; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][2]['category']->name; ?></div>
            </a>
          </div>
        </div>

        <div class="row m-rl-0">
          <?php $image_4 = get_field('category_image', $fields['directory']['display_category'][3]['category']);
            $terms_4 = get_terms($fields['directory']['display_category'][3]['category']); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_4[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_4; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][3]['category']->name; ?></div>
            </a>
          </div>
          <?php $image_5 = get_field('category_image', $fields['directory']['display_category'][4]['category']);
            $terms_5 = get_terms($fields['directory']['display_category'][4]['category']); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_5[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_5; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][4]['category']->name; ?></div>
            </a>
          </div>

        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($total_happening == 6) : ?>
    <div class="row content">
      <?php $tax_1 = $fields['directory']['display_category'][0]['category']; ?>
      <?php $image_1 = get_field('category_image', $fields['directory']['display_category'][0]['category']);
        $terms_1 = get_terms($fields['directory']['display_category'][0]['category']); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_1[0]->term_id; ?>">
          <div class="img" style="background: url(<?= $image_1; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $tax_1->name; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <?php $image_2 = get_field('category_image', $fields['directory']['display_category'][1]['category']);
          $terms_2 = get_terms($fields['directory']['display_category'][1]['category']); ?>
        <div class="row m-rl-0">
          <div class="col-sm-12">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_2[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_2; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][1]['category']->name; ?></div>
            </a>
          </div>
        </div>

        <div class="row m-rl-0">
          <?php $image_3 = get_field('category_image', $fields['directory']['display_category'][2]['category']);
            $terms_3 = get_terms($fields['directory']['display_category'][2]['category']); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_3[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_3; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][2]['category']->name; ?></div>
            </a>
          </div>
          <?php $image_4 = get_field('category_image', $fields['directory']['display_category'][3]['category']);
            $terms_4 = get_terms($fields['directory']['display_category'][3]['category']); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_4[0]->term_id; ?>">
              <div class="img" style="background: url(<?= $image_4; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['directory']['display_category'][3]['category']->name; ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php $image_5 = get_field('category_image', $fields['directory']['display_category'][4]['category']);
        $terms_5 = get_terms($fields['directory']['display_category'][4]['category']); ?>
      <div class="col-xl-5 col-lg-5 col-md-4 small-img">
        <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_5[0]->term_id; ?>">
          <div class="img" style="background: url(<?= $image_5; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['directory']['display_category'][4]['category']->name; ?></div>
        </a>
      </div>
      <?php $image_6 = get_field('category_image', $fields['directory']['display_category'][5]['category']);
        $terms_6 = get_terms($fields['directory']['display_category'][5]['category']); ?>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <a class="item" href="<?= site_url() . '/directory/?category=' . $terms_6[0]->term_id; ?>">
          <div class="img" style="background: url(<?= $image_6; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['directory']['display_category'][5]['category']->name; ?></div>
        </a>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php $total_arcade = count($fields['arcade']['content']); ?>
<?php
if ($total_arcade > 6) {
  $cts = 6;
} else {
  $cts = $total_arcade;
}
?>
<div class="ln-custom-<?= $cts; ?>">
  <div class="title"><?= $fields['arcade']['heading_title']; ?></div>

  <?php if ($total_arcade == 1) : ?>
    <div class="row content">
      <?php foreach ($fields['arcade']['content'] as $key => $value) : ?>
        <?php $fields = get_fields($value['arcade_post']->ID); ?>
        <div class="col-sm-12">
          <a class="item" href="<?= $fields['website_url']; ?>" target="t_blank">
            <div class="img" style="background: url(<?= $fields['main_image']; ?>)" alt=""></div>
            <div class="blackshadowhalf"></div>
            <div class="text"><?= $value['arcade_post']->post_title; ?></div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if ($total_arcade == 2) : ?>
    <div class="row content">
      <?php foreach ($fields['arcade']['content'] as $key => $value) : ?>
        <?php $fields = get_fields($value['arcade_post']->ID); ?>
        <div class="col-sm-6">
          <a class="item" href="<?= $fields['website_url']; ?>" target="t_blank">
            <div class="img" style="background: url(<?= $fields['main_image']; ?>)" alt=""></div>
            <div class="blackshadowhalf"></div>
            <div class="text"><?= $value['arcade_post']->post_title; ?></div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if ($total_arcade == 3) : ?>
    <div class="row content">
      <?php $fields_1 = get_fields($fields['arcade']['content'][0]['arcade_post']->ID); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= $fields_1['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_1['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][0]['arcade_post']->post_title; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <?php $fields_2 = get_fields($fields['arcade']['content'][1]['arcade_post']->ID); ?>
        <div class="row m-rl-0">
          <div class="col-sm-12">
            <a class="item" href="<?= $fields_2['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_2['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][1]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>
        <?php $fields_3 = get_fields($fields['arcade']['content'][2]['arcade_post']->ID); ?>
        <div class="row m-rl-0">
          <div class="col-sm-12">
            <a class="item" href="<?= $fields_3['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_3['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][2]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($total_arcade == 4) : ?>
    <div class="row content">
      <?php $fields_1 = get_fields($fields['arcade']['content'][0]['arcade_post']->ID); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= $fields_1['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_1['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][0]['arcade_post']->post_title; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <?php $fields_2 = get_fields($fields['arcade']['content'][1]['arcade_post']->ID); ?>
        <div class="row m-rl-0">
          <div class="col-sm-12">
            <a class="item" href="<?= $fields_2['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_2['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][1]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>

        <div class="row m-rl-0">
          <?php $fields_3 = get_fields($fields['arcade']['content'][2]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_3['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_3['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][2]['arcade_post']->post_title; ?></div>
            </a>
          </div>
          <?php $fields_4 = get_fields($fields['arcade']['content'][3]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_4['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_4['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][3]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($total_arcade == 5) : ?>
    <div class="row content">
      <?php $fields_1 = get_fields($fields['arcade']['content'][0]['arcade_post']->ID); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= $fields_1['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_1['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][0]['arcade_post']->post_title; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <div class="row m-rl-0">
          <?php $fields_2 = get_fields($fields['arcade']['content'][1]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_2['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_2['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][1]['arcade_post']->post_title; ?></div>
            </a>
          </div>
          <?php $fields_3 = get_fields($fields['arcade']['content'][2]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_3['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_3['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][2]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>
        <div class="row m-rl-0">
          <?php $fields_4 = get_fields($fields['arcade']['content'][3]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_4['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_4['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][3]['arcade_post']->post_title; ?></div>
            </a>
          </div>
          <?php $fields_5 = get_fields($fields['arcade']['content'][4]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_5['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_5['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][4]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($total_arcade == 6) : ?>
    <div class="row content">
      <?php $fields_1 = get_fields($fields['arcade']['content'][0]['arcade_post']->ID); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= $fields_1['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_1['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][0]['arcade_post']->post_title; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <?php $fields_2 = get_fields($fields['arcade']['content'][1]['arcade_post']->ID); ?>
        <div class="row m-rl-0">
          <div class="col-sm-12">
            <a class="item" href="<?= $fields_2['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_2['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][1]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>

        <div class="row m-rl-0">
          <?php $fields_3 = get_fields($fields['arcade']['content'][2]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_3['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_3['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][2]['arcade_post']->post_title; ?></div>
            </a>
          </div>
          <?php $fields_4 = get_fields($fields['arcade']['content'][3]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_4['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_4['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][3]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php $fields_5 = get_fields($fields['arcade']['content'][4]['arcade_post']->ID); ?>
      <div class="col-xl-5 col-lg-5 col-md-4 small-img">
        <a class="item" href="<?= $fields_5['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_5['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][4]['arcade_post']->post_title; ?></div>
        </a>
      </div>
      <?php $fields_6 = get_fields($fields['arcade']['content'][5]['arcade_post']->ID); ?>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <a class="item" href="<?= $fields_6['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_6['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][5]['arcade_post']->post_title; ?></div>
        </a>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($total_arcade == 7) : ?>
    <div class="row content">
      <?php $fields_1 = get_fields($fields['arcade']['content'][0]['arcade_post']->ID); ?>
      <div class="col-xl-5 col-lg-5 col-md-4">
        <a class="item" href="<?= $fields_1['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_1['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][0]['arcade_post']->post_title; ?></div>
        </a>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <div class="row m-rl-0">
          <?php $fields_2 = get_fields($fields['arcade']['content'][1]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_2['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_2['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][1]['arcade_post']->post_title; ?></div>
            </a>
          </div>
          <?php $fields_3 = get_fields($fields['arcade']['content'][2]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_3['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_3['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][2]['arcade_post']->post_title; ?></div>
            </a>
          </div>
        </div>

        <div class="row m-rl-0">
          <?php $fields_4 = get_fields($fields['arcade']['content'][3]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_4['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_4['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][3]['arcade_post']->post_title; ?></div>
            </a>
          </div>
          <?php $fields_5 = get_fields($fields['arcade']['content'][4]['arcade_post']->ID); ?>
          <div class="col-sm-6">
            <a class="item" href="<?= $fields_5['website_url']; ?>" target="t_blank">
              <div class="img" style="background: url(<?= $fields_5['main_image']; ?>)" alt=""></div>
              <div class="blackshadowhalf"></div>
              <div class="text"><?= $fields['arcade']['content'][4]['arcade_post']->post_title; ?></div>
            </a>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <?php $fields_6 = get_fields($fields['arcade']['content'][5]['arcade_post']->ID); ?>
      <div class="col-xl-5 col-lg-5 col-md-4 small-img">
        <a class="item" href="<?= $fields_6['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_6['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][5]['arcade_post']->post_title; ?></div>
        </a>
      </div>
      <?php $fields_7 = get_fields($fields['arcade']['content'][6]['arcade_post']->ID); ?>
      <div class="col-xl-7 col-lg-7 col-md-8">
        <a class="item" href="<?= $fields_7['website_url']; ?>" target="t_blank">
          <div class="img" style="background: url(<?= $fields_7['main_image']; ?>)" alt=""></div>
          <div class="blackshadowhalf"></div>
          <div class="text"><?= $fields['arcade']['content'][6]['arcade_post']->post_title; ?></div>
        </a>
      </div>
    </div>
  <?php endif; ?>
</div>

<style>
.ln-cap-sgn .swiper-container .swiper-wrapper .swiper-slide .image:after {
  display: none;
}
#sb_instagram .sbi_type_carousel .sbi_playbtn, #sb_instagram .sbi_type_video .sbi_playbtn {
  left: 44%;
}
#sb_instagram.sbi_medium .sbi_type_carousel .sbi_photo_wrap .fa-clone {
  right: 0;
  width: 30px;
}
#sb_instagram svg:not(:root).svg-inline--fa {
  right: 0;
  width: 40px;
}

  /* Media queries */
@media all and (max-width: 640px){
  #sb_instagram.sbi_col_3 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_4 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_5 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_6 #sbi_images .sbi_item{
    width: 33.3%;
  }
  #sb_instagram.sbi_col_7 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_8 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_9 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_10 #sbi_images .sbi_item{
    width: 33%;
  }
  #sb_instagram .sbi_type_carousel .sbi_playbtn, #sb_instagram .sbi_type_video .sbi_playbtn{
    top: 65%;
  }
  #sb_instagram .sbi_type_carousel .fa-clone {
    right: 0;
    width: 25px;
    top: 7px;
  }
  #sb_instagram svg:not(:root).svg-inline--fa {
    height: 15px;
  }
}

@media all and (max-width: 480px){
  #sb_instagram.sbi_col_3 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_4 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_5 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_6 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_7 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_8 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_9 #sbi_images .sbi_item,
  #sb_instagram.sbi_col_10 #sbi_images .sbi_item{
    width: 33.3%;
  }
}
</style>

<div class="ln-cap-sgn">
  <a  class="title" href="https://www.instagram.com/capitolsingapore/" target="t_blank">
    <div class="img-warp h-32 mr-2"><img src="<?= get_template_directory_uri(); ?>/assets/img/insta_icon_main.png"></div> @<?= get_option('ig_username'); ?>
  </a>
  <div class="swiper-content">
    <div class="swiper-container"><?php echo do_shortcode('[instagram-feed]'); ?>
      <div class="swiper-wrapper">
        <?php $i = 1; ?>
        <?php foreach (serve_ig_scrape() as $key => $value) : ?>
          <?php $upload = wp_upload_dir(); ?>
          <div class="swiper-slide col">
            <a href="<?= $value->image_link; ?>" target="_blank">
              <?php if (file_exists($upload['baseurl'] . '/instagram-cache/' . $value->image_cache)) : ?>
                <div class="image" style="background: url('<?= $upload['baseurl'] . '/instagram-cache/' . $value->image_cache; ?>')" alt=""></div>
              <?php else : ?>
                <div class="image" style="background: url('<?= $value->image_url; ?>')" alt=""></div>
              <?php endif; ?>
            </a>
          </div>
          <?php if ($fields['instagram']['total_show'] == $i) {
              break;
            }
            $i++; ?>
        <?php endforeach ?>
      </div>
    </div>
    <!-- <div class="swiper-button-next swiper-button btn-cap-next"><img src="<?= get_template_directory_uri(); ?>/assets/img/arrow-r.png" alt=""></div>
    <div class="swiper-button-prev swiper-button btn-cap-prev"><img src="<?= get_template_directory_uri(); ?>/assets/img/arrow-l.png" alt=""></div> -->
  </div>
</div>
<script type="text/javascript">
  
function sbiResize() {
  setTimeout(function(){
    jQuery('.sbi').each(function() {
      jQuery(this).find('.sbi_photo').css('height', jQuery(this).find('.sbi_photo').eq(0).innerWidth() );
    });
  }, 501);
}sbiResize();

jQuery(window).resize(function(){
  sbiResize();
});

</script>
<?php get_footer(); ?>