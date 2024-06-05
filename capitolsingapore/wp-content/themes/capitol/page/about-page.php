<?php 
/*
* Template Name: About Page
*/
$fields = get_fields();
get_header();?>
<div class="about-page img-responsive" style="background: url(<?= $fields['about']['background_image'];?>)" alt="">
  <div class="row a-center">
    <div class="col-12 col-lg-7 col-md-6">
      <div class="title"><?= $fields['about']['heading_title'];?></div>
      <div class="biggill"><?= $fields['about']['main_title'];?></div>
    </div>
    <div class="col-12 col-lg-5 col-md-6"><img class="about-image" src="<?= $fields['about']['main_image'];?>" alt="">
      <p class="desc"><?= $fields['about']['body_text'];?></p>
    </div>
  </div>
  <div class="space"></div>
  <!-- <div class="img-white-bottom"><img src="<?= get_template_directory_uri();?>/assets/img/about/bottom.png" alt=""></div> -->
</div>
<?php get_footer();?>