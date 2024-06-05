<?php 
    get_header();
    $query = (isset($_GET['s'])) ? urlencode($_GET['s']) : 0;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $loop = new WP_Query([
        'post_type'     => [
            'happening', 'directory'
        ],
        'posts_per_page'    => -1,
        'paged' => $paged,
        's' => $query
    ]);
    $total = $loop->found_posts;
?>
<div class="spaces"></div>
<div class="container search-container">
    <div class="row">
        <div class="col-12 filter">
            <div class="search-result">
                <div class="filter-content">
                    <div class="search">
                        <div class="input-group">
                            <form action="/" method="get">
                                <div class="input-group-prepend">
                                    <img src="<?= get_template_directory_uri();?>/assets/img/search-2.png" alt="Search">
                                </div>
                                <input class="form-control" type="text" name="s" placeholder="Enter your search terms...">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12">
            <span class="font-weight-regular">Search results for </span>
            <span class="color-main font-weight-bold">"<?php echo (isset($_GET['s'])) ? $_GET['s'] : 0 ?>"</span>
        </div>
    </div>
            
    <div class="row">
        <div class="col-12">
            <?php if ($loop->have_posts()) :?>
                <?php while ($loop->have_posts()) : $loop->the_post();?>
                    <?php $post_type = get_post_type(get_the_ID());?>
                    <?php $fields = get_fields();?>
                    <div class="searchresult">
                        <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                        <p>
                            <?php if ($post_type === 'directory'): ?>
                                <?= __( get_the_excerpt(get_the_ID()) ); ?>
                            <?php elseif ($post_type === 'happening') :?>
                                <?= __( get_the_excerpt(get_the_ID()) ); ?>
                            <?php elseif ($post_type === 'theatre') : ?>
                                <?= $fields['body_text'];?>
                            <?php endif;?>
                        </p>
                    </div>
                <?php endwhile;?>
            <?php else :?>
                <h1>The keyword that you've entered was not found</h1>
            <?php endif;?>           
        </div>
    </div>
</div>

<?php get_footer();?>