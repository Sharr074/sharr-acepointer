<?php 
	get_header();
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
<div class="hero-directory">
  <div class="container">
    <div class="tagline"><?= $term->name;?></div>
  </div>
</div>

<div class="content-directory" id="content-box">
    <div class="container">
    	<?php if (have_posts()): ?>
			<?php while(have_posts()) : the_post();?>
				<?php $fields = get_fields(get_the_ID());?>
				<a class="item" href="<?php the_permalink();?>">
			      <div class="image">
			        <div class="img" style="background: url(<?= $fields['main_image'];?>)" alt=""></div>
			      </div>
			      <div class="content">
			        <div class="name"><?php the_title();?></div>
			        <div class="place">
			          <div class="left"><img src="<?= get_template_directory_uri();?>/assets/img/point.png" alt=""><?= $fields['location_mark'];?></div>
			          <div class="right">
			          	<?php if ($fields['reserve_button']['chopee']['enable_button']): ?>
			          		<img src="<?= get_template_directory_uri();?>/assets/img/directory/chope.png" alt="">	
			          	<?php endif ?>
			          	<?php if ($fields['reserve_button']['hungry']['enable_button']): ?>
			          		<img src="<?= get_template_directory_uri();?>/assets/img/directory/hungry.png" alt="">
			          	<?php endif ?>
			          </div>
			        </div>
			      </div>
			  	</a>
	  		<?php endwhile;?>
	  	<?php else : ?>
	  		<h3 style="text-align: center; width: 100%;font-style: oblique;">There's no post yet at this moment</h3>
	  	<?php endif ?>
    </div>
</div>
<div class="space"></div>
<?php get_footer();?>