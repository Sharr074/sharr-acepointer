<?php
get_header();
$field = get_fields();
?>
<div class="directory-single">
  <div class="directory-content">
    <div class="images" style="background-image: url(<?= $field['main_image']; ?>)"></div>
    <div class="content">
      <div class="back">
        <a href="<?= get_post_type_archive_link('directory'); ?>">
          <div class="text">
            < Back to Directory</div> </a> </div> <div class="title"><?php the_title(); ?>
          </div>
          <div class="desc"><?= get_post_field('post_content', get_the_ID());?></div>
          <div class="detail">
            <div class="image"><img src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt=""></div>
            <span class="others"><a><?= $field['location_mark']; ?></a></span>
          </div>

          <?php if ($field['open_time']['show_section']) : ?>
            <div class="detail">
              <div class="image"><img src="<?= get_template_directory_uri(); ?>/assets/img/time.png" alt=""></div>
              <span class="others"><a><?= ucwords($field['open_time']['start_date']); ?> - <?= ucwords($field['open_time']['end_date']); ?> : <?= $field['open_time']['start_time']; ?> - <?= $field['open_time']['end_time']; ?></a></span>
            </div>
          <?php endif; ?>
		  <div class="detail">
               <div class="image"><img src="<?= get_template_directory_uri(); ?>/assets/img/time.png" alt=""></div><span class="others"><?= $field['open_time']['custom_show_time']; ?></span>
		  </div>

          <?php if ($field['contact']['code_area'] != null && $field['contact']['phone_number'] != null) : ?>
            <div class="detail">
              <div class="image"><img src="<?= get_template_directory_uri(); ?>/assets/img/list-phone-2.png" alt=""></div>
              <span class="others"><a><?= $field['contact']['code_area']; ?> <?= preg_replace("/^.{4}/", "$0 ", $field['contact']['phone_number']); ?></a></span>
            </div>
          <?php endif; ?>
		  

          <div class="detail web">
            <?php if ($field['website_url'] != null && $field['social_media']['facebook'] != null & $field['social_meida']['instagram'] != null) : ?>
              <!-- <div class="image">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/web.png" alt="">
              </div> -->
            <?php endif; ?>
            <div class="link md-block">
              <?php if ($field['website_url'] != null) : ?>
                <a class="web-link" href="<?= $field['website_url']; ?>" target="t_blank">
                  <div class="image">
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/web.png" alt="">
                  </div>
                  <?= str_replace(['http://', 'https://'], '', $field['website_url']); ?> 
                </a>
              <?php endif; ?>

              <?php if ($field['social_media']['facebook'] !== '' && $field['website_url'] !== '' || $field['social_media']['instagram'] !== '' && $field['website_url'] !== '') : ?>
                <span class="d-none d-xl-block d-lg-block d-md-none">&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <?php endif ?>
              <?php if ($field['social_media']['facebook'] !== '') : ?>
                <a href="<?= $field['social_media']['facebook']; ?>" target="t_blank">
                  <div class="image ssmed">
                    <img class="img-sosmed" src="<?= get_template_directory_uri(); ?>/assets/img/facebook-small.png" alt="">
                  </div>
                  <span>Facebook</span>
                </a>
              <?php endif ?>
              <?php if ($field['social_media']['instagram'] !== '') : ?>
                <a href="<?= $field['social_media']['instagram']; ?>" target="t_blank">
                  <div class="image ssmed">
                    <img class="img-sosmed" src="<?= get_template_directory_uri(); ?>/assets/img/instagram-small.png" alt="">
                  </div>
                  <span>Instagram</span>
                </a>
              <?php endif ?>
            </div>
          </div>

          <?php if ( $post->ID == 1636 ) : ?> 
          <div class="three-point" style="margin-bottom: 10px; font-weight: bold; color: #7c7977;">Awards & Accolades</div>
          <div class="three-point" style="margin-bottom: 10px;">
              <div class="advisor mb-4" >
                <div class="img-warp" style="width: 60px;"><img class="img-responsive" src="<?= get_template_directory_uri(); ?>/assets/img/directory/Wine-Dine_SG.jpeg"></div>
              </div>
          </div>
          <?php endif; ?>

          <?php if ($field['reserve_button']['chopee'] != null || $field['reserve_button']['hungry'] != null || $field['reserve_button']['quandoo'] != null) : ?>
          <div class="reserve" style="margin-top: 20px; font-weight: bold; color: #7c7977;">Reservations</div>
          <div class="reserve" style="margin-top: 10px;">
            <!-- CHOPE BUTTON -->
            <?php if ($field['reserve_button']['chopee'] != null) : ?>
              <a data-toggle="modal" data-target="#orderpop-c" href="javascript:;" class="chope">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/logo-chope.png" alt="">Reserve
              </a>
            <?php endif; ?>
            <!-- HUNGRY BUTTON -->
            <?php if ($field['reserve_button']['hungry'] != null) : ?>
              <a data-toggle="modal" data-target="#orderpop-h" href="javascript:;" class="hungry">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/logo-hungry.png" alt="">Reserve
              </a>
            <?php endif; ?>
            <!-- QUANDOO BUTTON -->
            <?php if ($field['reserve_button']['quandoo'] != null) : ?>
              <a data-toggle="modal" data-target="#orderpop-q" href="javascript:;" class="quando">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/logo-quandoo.png" alt="">
                <img class="hoverlogo" src="<?= get_template_directory_uri(); ?>/assets/img/logo-quandoo-white.png" alt="">Reserve
              </a>
            <?php endif; ?>
          </div>
          <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- MODAL CHOPEE -->
  <?php if ($field['reserve_button']['chopee'] != null) : ?>
    <div class="modal fade orderpop" id="orderpop-c" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <iframe src="<?= $field['reserve_button']['chopee']; ?>"> </iframe>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($field['reserve_button']['hungry'] != null) : ?>
    <div class="modal fade orderpop" id="orderpop-h" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <iframe src="<?= $field['reserve_button']['hungry']; ?>"> </iframe>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($field['reserve_button']['quandoo'] != null) : ?>
    <div class="modal fade orderpop" id="orderpop-q" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <iframe src="<?= $field['reserve_button']['quandoo']; ?>"> </iframe>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="space"></div>
  <?php get_footer(); ?>