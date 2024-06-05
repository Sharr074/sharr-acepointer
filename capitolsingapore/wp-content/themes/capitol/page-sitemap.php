<?php get_header();?>
<div class="container">
    <div class="general-page">
        <div class="hero-directory pt-0">
            <div class="container">
                <div class="tagline" style="padding-bottom: 40px;"><?php the_title();?></div>
            </div>
        </div>
        <div class="content sitemap">
            <?= get_post_field('post_content', get_the_ID());?>
        </div>
    </div>
</div>
<div class="space"></div>
<?php get_footer();?>