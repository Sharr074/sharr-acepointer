<?php get_header();?>
<div class="container">
    <div class="general-page">
        <h1><?php the_title();?></h1>
        <div class="content">
            <?= get_post_field('post_content', get_the_ID());?>
        </div>
    </div>
</div>
<?php get_footer();?>