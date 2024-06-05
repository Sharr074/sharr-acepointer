<?php get_header(); ?>
<?php $arc = get_field('happening_archive', 'option'); ?>
<!-- HERO HAPPENING -->
<div class="hero-happening">
  <div class="container">
    <div class="tagline"><?= post_type_archive_title('', false); ?></div>
  </div>
  <div class="carousel" id="happening-swipper">
    <div class="container">
      <div class="swiper-container swiper-container-horizontal">
        <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
          <?php foreach ($arc['hero_slider'] as $key => $value) : ?>
            <div class="swiper-slide swiper-slide-active" style="width: 1110px;">
              <div class="image" style="background: url(<?= $value['image_banner']; ?>)"></div>
            </div>
          <?php endforeach ?>
        </div>
        <div class="swiper-button-next swiper-button" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false">
          <img src="<?= get_template_directory_uri(); ?>/assets/img/next.png" alt="">
        </div>
        <div class="swiper-button-prev swiper-button swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true">
          <img src="<?= get_template_directory_uri(); ?>/assets/img/prev.png" alt="">
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
      </div>
    </div>
  </div>
</div>
<!-- END HERO HAPPENING -->

<div class="happening-section">
  <div class="container">
    <div class="title">
      <div class="text"><?= $arc['happening_title']; ?></div>
      <div class="lines">
        <hr>
      </div>
    </div>
    <div class="content">
      <?php if ($arc['set_content_hap_now'] === 'manual') : ?>
        <?php foreach ($arc['happening_now_post'] as $key => $value) : ?>
          <?php $ids = $key; ?>
          <?php $categ = wp_get_object_terms($value['happening_post']->ID, 'happening_category'); ?>
          <?php $fields = get_fields($value['happening_post']->ID); ?>
          <a class="item" href="<?= get_post_permalink($value['happening_post']->ID); ?>">
            <div class="image">
              <div class="img" style="background: url(<?= $fields['main_image']; ?>)"></div>
              <div class="date"><?= convert_date($fields['event_details']['date_&_time']['start_date']); ?></div>
            </div>
            <?php if ($categ != false) : ?>
              <div class="categories">
                <?php $counts = count($categ) - 1; ?>
                <?php foreach ($categ as $key => $value) : ?>
                  <?php if ($key != $counts) : ?>
                    <?= $value->name; ?> •
                  <?php else : ?>
                    <?= $value->name; ?>
                  <?php endif ?>
                <?php endforeach ?>
              </div>
            <?php endif ?>

            <div class="name"> <span><?= $arc['happening_now_post'][$ids]['happening_post']->post_title; ?></span></div>
            <!-- <div class="addres">
              <div class="icon"><img src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt=""></div>
              <div class="text"><?= $fields['event_details']['location']; ?></div>
            </div> -->
          </a>
        <?php endforeach ?>
      <?php else : ?>
        <?php $hapNow = happening_now_event($arc['limit_show_happening']);?>
        <?php if ($hapNow != false) : ?>
          <?php foreach ($hapNow as $key => $value) :  ?>
            <?php $ids2 = $key; ?>
            <?php $categs = wp_get_object_terms($value->ID, 'happening_category'); ?> 
            <?php $field = get_fields($value->ID); ?>
            <a class="item" href="<?= get_post_permalink($value->ID); ?>">
              <div class="image">
                <div class="img" style="background: url(<?= $field['main_image']; ?>)"></div>
                <div class="date">
                  <?php if (date('Y', strtotime ($field['event_details']['date_&_time']['start_date'])) == date('Y', strtotime ($field['event_details']['date_&_time']['end_date']))) : ?>
                    <?php echo date('j M', strtotime ($field['event_details']['date_&_time']['start_date'])); ?> - <?php echo date('j M Y', strtotime ($field['event_details']['date_&_time']['end_date'])); ?>
                  <?php else : ?>
                    <?php echo date('j M Y', strtotime ($field['event_details']['date_&_time']['start_date'])); ?> - <?php echo date('j M Y', strtotime ($field['event_details']['date_&_time']['end_date'])); ?>
                  <?php endif; ?>
                </div>
              </div>
              <?php if ($categs != false) : ?>
                <div class="categories">
                  <?php $counts = count($categs) - 1; ?>
                  <?php foreach ($categs as $key => $value) : ?>
                    <?php if ($key != $counts) : ?>
                      <?= $value->name; ?> •
                    <?php else : ?>
                      <?= $value->name; ?>
                    <?php endif ?>
                  <?php endforeach ?>
                </div>
              <?php endif ?>

              <div class="name"> <span><?= $hapNow[$ids2]->post_title; ?></span></div>
              <!-- <div class="addres">
                <div class="icon"><img src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt=""></div>
                <div class="text"><?= $field['event_details']['location']; ?></div>
              </div> -->
            </a>
          <?php endforeach; ?>
        <?php else : ?>
          <h3>There are no happenings events.</h3>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- <div class="happening-section">
  <div class="container">
    <div class="title">
      <div class="text"><?= $arc['happening_title_upcoming']; ?></div>
      <div class="lines">
        <hr>
      </div>
    </div>
    <div class="content">
      <?php if ($arc['set_content_up_event'] === 'manual') : ?>
        <?php foreach ($arc['upcoming_event'] as $key => $value) : ?>
          <?php $ids = $key; ?>
          <?php $categ = wp_get_object_terms($value['upcoming_post']->ID, 'happening_category'); ?>
          <?php $fields = get_fields($value['upcoming_post']->ID); ?>
          <a class="item" href="<?= get_post_permalink($value['upcoming_post']->ID); ?>">
            <div class="image">
              <div class="img" style="background: url(<?= $fields['main_image']; ?>)"></div>
              <div class="date"><?= convert_date($fields['event_details']['date_&_time']['start_date']); ?></div>
            </div>
            <?php if ($categ != false) : ?>
              <div class="categories">
                <?php $counts = count($categ) - 1; ?>
                <?php foreach ($categ as $key => $value) : ?>
                  <?php if ($key != $counts) : ?>
                    <?= $value->name; ?> •
                  <?php else : ?>
                    <?= $value->name; ?>
                  <?php endif ?>
                <?php endforeach ?>
              </div>
            <?php endif ?>

            <div class="name"> <span><?= $arc['upcoming_event'][$ids]['upcoming_post']->post_title; ?></span></div>
            <div class="addres">
              <div class="icon"><img src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt=""></div>
              <div class="text"><?= $fields['event_details']['location']; ?></div>
            </div>
          </a>
        <?php endforeach ?>
      <?php else : ?>
        <?php $arc_happ = upcoming_eventHappening($arc['limit_show_up_event']); ?>
        <?php if ($arc_happ != false) : ?>
          <?php foreach ($arc_happ as $key => $value) : ?>
            <?php $ids3 = $key; ?>
            <?php $categs = wp_get_object_terms($value->ID, 'happening_category'); ?>
            <?php $field = get_fields($value->ID); ?>
            <a class="item" href="<?= get_post_permalink($value->ID); ?>">
              <div class="image">
                <div class="img" style="background: url(<?= $field['main_image']; ?>)"></div>
                <div class="date"><?= convert_date($field['event_details']['date_&_time']['start_date']); ?></div>
              </div>
              <?php if ($categs != false) : ?>
                <div class="categories">
                  <?php $counts = count($categs) - 1; ?>
                  <?php foreach ($categs as $key => $value) : ?>
                    <?php if ($key != $counts) : ?>
                      <?= $value->name; ?> •
                    <?php else : ?>
                      <?= $value->name; ?>
                    <?php endif ?>
                  <?php endforeach ?>
                </div>
              <?php endif ?>

              <div class="name"> <span><?= $arc_happ[$ids3]->post_title; ?></span></div>
              <div class="addres">
                <div class="icon"><img src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt=""></div>
                <div class="text"><?= $field['event_details']['location']; ?></div>
              </div>
            </a>
          <?php endforeach; ?>
        <?php else : ?>
          <h3>There are no upcoming events.</h3>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div> -->


<div class="space"></div>
<?php get_footer(); ?>