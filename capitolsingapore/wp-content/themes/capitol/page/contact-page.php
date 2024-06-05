<?php
/*
* Template Name: Contact Page
*/
$fields = get_fields();
$link = $fields['general']['maps']['link_&_text'];
get_header(); ?>
<!-- MAPS -->
<div class="map-information">
  <div class="tagline"><?= $fields['general']['heading_title']; ?></div>
  <div class="content">
    <div class="col-md-3"></div>
    <div class="col-sm-4 howtoget">
      <div class="title"><?= $fields['general']['maps']['title']; ?></div>
      <div class="address mt-30"><?= $fields['general']['maps']['subtitle']; ?></div>
      <div class="road"><?= $fields['general']['maps']['address']; ?></div>
      <?php if (isset($link['target']) && $link['target'] !== '') : ?>
        <a class="getdirection mt-25" href="<?= $link['url']; ?>" target="_blank">
          <img class="mr-10" src="<?= get_template_directory_uri(); ?>/assets/img/hero-more.png" alt=""><?= $link['title']; ?>
        </a>
      <?php else : ?>
        <a class="getdirection mt-25" href="<?= $link['url']; ?>">
          <img class="mr-10" src="<?= get_template_directory_uri(); ?>/assets/img/hero-more.png" alt=""><?= $link['title']; ?>
        </a>
      <?php endif ?>

    </div>
    <div class="col-sm-9 map">
      <iframe src="<?= $fields['general']['maps']['embed_src']; ?>" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
  </div>
</div>
<!-- END MAPS -->

<!-- DETAIL -->
<div class="detail contact-us">
  <div class="container">
    <div class="row border-bottom">
      <div class="col-sm-6 border-right">
        <div class="train pt20-pd65 pb-55">
          <div class="icon mr-15"><img src="<?= $fields['train_icon']; ?>" alt=""></div>

          <div class="right-side pt-12">
            <h5><?= $fields['train_title']; ?></h5>
            <?php foreach ($fields['station'] as $key => $value) : ?>
              <div class="cityHall">
                <div class="stop mr-15"><?= $value['station_name']; ?></div>
                <?php if ($value['station_number']['east_west_line_code'] !== '') : ?>
                  <?php if (strpos($value['station_number']['east_west_line_code'], ',') == true) : ?>
                    <?php $exp_red = explode(',', $value['station_number']['east_west_line_code']); ?>
                    <?php foreach ($exp_red as $keys => $vas) : ?>
                      <div class="red mr-15"><?= $vas; ?></div>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <div class="red mr-15"><?= $value['station_number']['east_west_line_code']; ?></div>
                  <?php endif; ?>
                <?php endif; ?>


                <?php if ($value['station_number']['north_south_line_code'] !== '') : ?>
                  <?php if (strpos($value['station_number']['north_south_line_code'], ',') == true) : ?>
                    <?php $exp_green = explode(',', $value['station_number']['north_south_line_code']); ?>
                    <?php foreach ($exp_green as $keys => $vas) : ?>
                      <div class="green mr-15"><?= $vas; ?></div>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <div class="green mr-15"><?= $value['station_number']['north_south_line_code']; ?></div>
                  <?php endif; ?>
                <?php endif; ?>


              </div>
              <div class="estimate"><?= $value['note']; ?></div>
            <?php endforeach ?>
          </div>

        </div>
      </div>
      <div class="col-sm-6">
        <div class="bus pt20-pd65 pb-55">
          <div class="icon mr-15"><img src="<?= $fields['buses_icon'] ?>" alt=""></div>
          <div class="right-side pt-12">
            <h5><?= $fields['buses']; ?></h5>
            <?php foreach ($fields['buss_station'] as $key => $value) : ?>
              <div class="stop"><?= $value['station_name']; ?></div>
              <div class="stop-point"><?= $value['station']; ?></div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row car pt65-pd65">
      <div class="col-sm-4">
        <div class="car-part">
          <div class="icon mr-15"><img src="<?= $fields['car_park_icon']; ?>" alt=""></div>
          <h5 class="pt-12"><?= $fields['heading_title_car_park']; ?></h5>
        </div>
      </div>
      <div class="col-sm-8">
        <?php foreach ($fields['car_park'] as $key => $value) : ?>
          <div class="row <?php if ($key != 0) : echo 'mt-40';
                            endif; ?>">
            <div class="col-sm-6 pt-12">
              <div class="time">
                <?php if ($value['from']['hide_day']) : ?>
                  <?= strtoupper($value['from']['start_time_park']); ?> -
                <?php else : ?>
                  (<?= substr($value['from']['start_day'], 0, 3); ?>) <?= strtoupper($value['from']['start_time_park']); ?> -
                <?php endif; ?>

                <?php if ($value['to']['hide_day']) : ?>
                  <?= strtoupper($value['to']['end_time_park']); ?>
                <?php else : ?>
                  (<?= substr($value['to']['start_day'], 0, 3); ?>) <?= strtoupper($value['to']['end_time_park']); ?>
                <?php endif; ?>
              </div>
              <div class="date-status"><?= $value['note']; ?></div>
            </div>
            <div class="col-sm-6 pt-12">
              <?php foreach ($value['park_bill'] as $kis => $val) : ?>
                <div class="prise">$ <?= $val['amount']; ?> <?= $val['note']; ?></div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="row direction pt0-pd65">
      <div class="col-sm-4">
        <div class="direction-part">
          <div class="icon mr-15"><img src="<?= $fields['direction_icon']; ?>" alt=""></div>
          <h5 class="pt-12"><?= $fields['heading_title_direction']; ?></h5>
        </div>
      </div>
      <div class="col-sm-8 pt-12">
        <div class="date-status"><?= $fields['main_direction']; ?></div>
        <?php foreach ($fields['direction'] as $key => $val) : ?>
          <div class="note <?php if ($key == 0) : echo 'mt-55';
                              endif; ?>">
            <div class="start">*</div>
            <p class="note-list"><?= $val['direction_text']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<!-- END DETAIL -->
<!-- CONTACT FORM -->
<div class="contact-form">
  <div class="image" style="background: url(<?= $fields['background_image_contact']; ?>)" alt=""></div>
  <div class="container mt-80">
    <div class="row info-tabs contact-us">
      <div class="col">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <?php foreach ($fields['form_shortcode'] as $form => $fill) : ?>
            <li class="nav-item d-flex">
              <a class="nav-link <?php if($form == 0): echo 'active'; endif;?>" id="<?= strtolower(str_replace(' ', '-', $fill['heading_title'])); ?>-tab" data-toggle="tab" href="#<?= strtolower(str_replace(' ', '-', $fill['heading_title'])); ?>" role="tab" aria-controls="<?= strtolower(str_replace(' ', '-', $fill['heading_title'])); ?>" aria-selected="true">
                <div class="img-warp h-32">
                  <img class="img-responsive" src="<?= $fill['icon']; ?>">
                </div>
                <span><?= $fill['heading_title']; ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="tab-content" id="myTabContent">
          <?php foreach ($fields['form_shortcode'] as $key => $value) : ?>
            <div class="tab-pane fade show <?php if($key == 0): echo 'active'; endif;?>" id="<?= strtolower(str_replace(' ', '-', $value['heading_title'])); ?>" role="tabpanel" aria-labelledby="<?= strtolower(str_replace(' ', '-', $value['heading_title'])); ?>-tab">
              <div class="mt-80">
                <div class="tagline"><?= $value['heading_title']; ?></div>
                <div class="mt-5">
                  <?= do_shortcode(__($value['shortcode'])); ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END CONTACT FORM -->
<div class="space"></div>
<?php get_footer(); ?>