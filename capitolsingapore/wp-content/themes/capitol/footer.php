<?php $setting = get_field('settings', 'option'); ?>

<!-- <div class="ch-footer-search pt-4 pb-4">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-xl-2"></div>
      <div class="col-12 col-xl-8">
        <div class="w-100">
          <div class="d-xl-flex d-lg-flex d-md-flex a-center d-block justify-content-md-center jot">
            <div class="joinour  mr-0  mr-xl-5  mr-lg-5  mr-md-5">JOIN OUR MAILING LIST</div>
            <?= do_shortcode(__($setting['newsletter']['form_code'])); ?>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-2"></div>
    </div>
  </div>
</div> -->
<footer>
  <div class="container-footer">
    <div class="row mb-xl-5 mb-lg-5">
      <!-- <div class="col-lg-5 col-md-12 col-sm-12">
				<div class="title-dekstop"><?= $setting['footer_menu']['heading_title']; ?></div>
        <div class="title" data-toggle="collapse" data-target="#menuFooter" aria-expanded="true" aria-controls="collapseOne">
					<div class="text"><?= $setting['footer_menu']['heading_title']; ?></div>
					<span class="arrow">></span>
				</div>
        <div class="row md-m30 sm-m30" id="menuFooter">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <?php foreach ($setting['footer_menu']['row_1'] as $key => $value) : ?>
              <?php
                if ($value['link'] === '') {
                  $link = '#';
                } else {
                  $link = $value['link'];
                }
                ?>
              <div class="item">
                <a href="<?= $link; ?>"><?= $value['page_title']; ?></a>
              </div>
            <?php endforeach ?>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <?php foreach ($setting['footer_menu']['row_2'] as $key => $value) : ?>
              <?php
                if ($value['link'] === '') {
                  $link = '#';
                } else {
                  $link = $value['link'];
                }
                ?>
              <div class="item">
                <a href="<?= $link; ?>"  target="t_blank"><?= $value['page_title']; ?></a>
              </div>
            <?php endforeach ?>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <?php foreach ($setting['footer_menu']['row_3'] as $key => $value) : ?>
              <?php
                if ($value['link'] === '') {
                  $link = '#';
                } else {
                  $link = $value['link'];
                }
                ?>
              <div class="item">
                <a href="<?= $link; ?>"><?= $value['page_title']; ?></a>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div> -->
      <div class="col-xl-3 col-lg-3 col-md-12 col-12">
        <div class="title-dekstop">Address</div>
        <div class="title dsktp" data-toggle="collapse" data-target="#menuFooter" aria-expanded="true" aria-controls="collapseOne">
          <div class="text">Address</div>
          <span class="arrow">></span>
        </div>
        <div id="menuFooter">
          <div class="addres">
            <div class="mb-2"><?= $setting['address_footer']; ?> </div>
            <div><?= $setting['contact_phone']; ?></div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-12 col-sm-12 col-12">
        <div class="title-dekstop"><?= $setting['social_media']['heading_title']; ?></div>
        <div class="title dsktp" data-toggle="collapse" data-target="#sosmedFooter" aria-expanded="false" aria-controls="collapseExample">
          <div class="text"><?= $setting['social_media']['heading_title']; ?></div>
          <span class="arrow">></span>
        </div>
        <div class="content  sm-m30" id="sosmedFooter">
          <?php if ($setting['social_media']['facebook'] !== '') : ?>
            <div class="item">
              <a href="<?= $setting['social_media']['facebook']; ?>" target="_blank">
                <img class="f-fb" src="<?= get_template_directory_uri(); ?>/assets/img/fb.png" alt="">Facebook
              </a>
            </div>
          <?php endif ?>
          <?php if ($setting['social_media']['instagram'] !== '') : ?>
            <div class="item">
              <a href="<?= $setting['social_media']['instagram']; ?>" target="_blank">
                <img class="f-ig" src="<?= get_template_directory_uri(); ?>/assets/img/ig.png" alt="">Instagram
              </a>
            </div>
          <?php endif ?>
        </div>
      </div>
      <div class="col-lg-2 col-md-12 col-sm-12 col-12">
        <div class="title-dekstop"><?= $setting['footer_portofolio']['heading_title']; ?></div>
        <div class="title dsktp" data-toggle="collapse" data-target="#fortofolioFooter" aria-expanded="false" aria-controls="collapseExample">
          <div class="text"><?= $setting['footer_portofolio']['heading_title']; ?></div>
          <span class="arrow">></span>
        </div>
        <div class="content  sm-m30" id="fortofolioFooter">
          <?php foreach ($setting['footer_portofolio']['menu'] as $key => $value) : ?>
            <?php
              if ($value['link'] === '') {
                $link = '#';
              } else {
                $link = $value['link'];
              }
              ?>
            <div class="item">
              <a href="<?= $link; ?>" target="t_blank"><?= $value['title']; ?></a>
            </div>
          <?php endforeach ?>
        </div>

      </div>
      <div class=" col-12 col-xl-1 col-lg-1 col-md-4"></div>
      <div class=" col-12 col-xl-4 col-lg-4 col-md-12 col-sm-12 sm-m30">
        <!-- <div class="title">newsletter</div>
        <form class="form-inline" action="">
          <input class="form-control" type="email" placeholder="Enter your Email Address" aria-label="Subscribe">
          <button class="btn btn-subscribe" type="submit">Subscribe</button>
        </form> -->
        <!-- <div class="mb-5">
          <div class="title sm-m30 dsktp">
            <div class="text mb-0"><?= $setting['newsletter']['heading_title']; ?></div>
          </div>
          <?= do_shortcode(__($setting['newsletter']['form_code'])); ?>
        </div> -->

        <div class="f-manage mt-5 mt-xl-0 mt-lg-0 mt-md-5">
          <!-- <div class="trajan">Owned and Managed By</div> -->
          <a href="http://www.perennialrealestate.com.sg/" target="_blank">
            <img class="managed" src="<?= $setting['footer_logo']; ?>" alt="">
          </a>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col footer-2">
        <div class="copyright"><?= $setting['copyright_footer']; ?></div>
        <div class="term d-flex a-center">
          <?php foreach ($setting['footer_menu']['row_3'] as $key => $value) : ?>
            <?php
              if ($value['link'] === '') {
                $link = '#';
              } else {
                $link = $value['link'];
              }
              ?>

            <div class="item">
              <a href="<?= $link; ?>"><?= $value['page_title']; ?></a>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</footer>
</body>
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=f9ebmlnxlmrbxmhfws3ihq" async="true"></script>
<?php wp_footer(); ?>

<script type="text/javascript">
	if ( $('.wpcf7-date')[0].type != 'date' ) $('.wpcf7-date').datepicker();
</script>
</html>