<?php get_header(); ?>
<?php
$theatre = get_field('theatre_archive', 'option');
$cats = get_terms([
    'taxonomy'  => 'now_showing_category',
    'hide_empty'  => false
]);
$post_gallery = post_gallery_get();
$gallery = get_all_post_gallery();
?>
<style>

</style>

<div class="hero-theatre d-none">
    <div class="hero-swiper" id="hero-theatre-swiper">
        <div class="swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                <?php foreach ($theatre['hero_slider'] as $key => $value) : ?>
                    <?php
                        if ($key == 0) {
                            $class = 'swiper-slide-active';
                        } elseif ($key == 1) {
                            $class = 'swiper-slide-next';
                        } else {
                            $class = '';
                        }
                        ?>
                    <?php if ($value['use_theatre_post'] != true) : ?>
                        <div class="swiper-slide " style="width: 822px;">
                            <div class="item" style="background: url(<?= $value['main_image']; ?>)" alt=""></div>
                            <div class="text">
                                <div class="date"><?= $value['datetime']; ?></div>
                                <div class="title"><?= $value['title']; ?></div>
                                <div class="sec-desc">
                                    <div class="desc"><?= $value['body_text']; ?></div>
                                    <?php
                                            if ($value['link']['target'] !== '') {
                                                $target = 'target="_blank"';
                                            } else {
                                                $target = '';
                                            }
                                            ?>
                                    <a class="buy-ticket" href="<?= $value['link']['url']; ?>" <?= $target; ?>>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt="">
                                        <img class="hover" src="<?= get_template_directory_uri(); ?>/assets/img/arrow-down.png" alt="">
                                        <?= $value['link']['title']; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php $field = get_fields($value['theatre_post']->ID); ?>
                        <div class="swiper-slide " style="width: 822px;">
                            <div class="item" style="background: url(<?= $field['main_image']; ?>)" alt=""></div>
                            <div class="text">
                                <div class="date"><?= date('j F Y', strtotime($field['from'])); ?></div>
                                <div class="title"><?= $value['theatre_post']->post_title; ?></div>
                                <div class="sec-desc">
                                    <div class="desc"><?= $field['body_text']; ?></div>
                                    <?php
                                            if ($value['link']['target'] !== '') {
                                                $target = 'target="_blank"';
                                            } else {
                                                $target = '';
                                            }
                                            ?>
                                    <a class="buy-ticket" href="<?= $value['link']['url']; ?>" <?= $target; ?>>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt="">
                                        <img class="hover" src="<?= get_template_directory_uri(); ?>/assets/img/arrow-down.png" alt="">
                                        <?= $value['link']['title']; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
            <div class="swiper-button-next hero-swiper-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"><img src="<?= get_template_directory_uri(); ?>/assets/img/next.png" alt=""></div>
            <div class="swiper-button-prev hero-swiper-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"><img src="<?= get_template_directory_uri(); ?>/assets/img/prev.png" alt=""></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
    </div>
    <div class="upcoming">
        <div class="title-up"><?= $theatre['upcoming_show']['heading_title']; ?></div>
        <div class="content">
            <?php if ($theatre['upcoming_show']['upcoming_type'] === 'manual') : ?>
                <?php foreach ($theatre['upcoming_show']['show_post'] as $key => $value) : ?>
                    <?php $field = get_fields($value['post_show']->ID); ?>
                    <a href="javascript:;" class="button-read-more" data-toggle="modal" data-target="#promoModal" data-key="item_<?= $key; ?>" class="item">
                        <div class="img"><img src="<?= $field['main_image']; ?>" alt=""></div>
                        <div class="text">
                            <div class="date"><?= date('j F Y', strtotime($field['from'])); ?></div>
                            <div class="title"><?= $value['post_show']->post_title; ?></div>
                        </div>
                    </a>
                <?php endforeach ?>
            <?php else : ?>
                <?php $coming_1 = upcoming_show_auto($theatre['upcoming_show']['days_in_future']); ?>
                <?php foreach ($coming_1 as $key => $value) : ?>
                    <a class="item" href="javascript:;" class="button-read-more" data-toggle="modal" data-target="#promoModal" data-key="item_<?= $key; ?>">
                        <div class="img"><img src="<?= $value['main_image']; ?>" alt=""></div>
                        <div class="text">
                            <div class="date"><?= date('j F Y', strtotime($value['from'])); ?></div>
                            <div class="title"><?= $value['title']; ?></div>
                        </div>
                    </a>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="cap-360" id="venue-section">
    <div class="image bgimg" id="360-image" style="background-image: url(<?= $theatre['background_image']['url']; ?>); background-size: cover; height: 600px;"></div>
    <!-- <div class="image" id="360-image"></div> -->
    <div class="content">
        <div class="container">
            <div class="title"><?= $theatre['about_theater']['heading_title']; ?></div>
            <div class="row desc">
                <div class="col-sm-8">
                    <div class="text" id="text-more">
                        <?= $theatre['about_theater']['body_text']; ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php if($theatre['about_theater']['contact']['code_area'] != ''){ ?>
                    <div class="info">
                        <div class="icon"><img class="date" src="<?= get_template_directory_uri(); ?>/assets/img/list-phone-2.png" alt=""></div>
                        <div class="text"><?= $theatre['about_theater']['contact']['code_area']; ?> <?= preg_replace("/^.{4}/", "$0 ", $theatre['about_theater']['contact']['phone_number']); ?> </div>
                    </div>
                    <?php } ?>
                    <div class="info">
                        <div class="icon"><img class="date" src="<?= get_template_directory_uri(); ?>/assets/img/email.png" alt=""></div>
                        <div class="text"><?= $theatre['about_theater']['contact']['email_address']; ?></div>
                    </div>
                    <div class="info">
                        <div class="icon"><img class="telp" src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt=""></div>
                        <div class="text"><?= $theatre['about_theater']['contact']['address']; ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <a class="btn" id="btn-360-more">
                    <p>read more</p><img src="<?= get_template_directory_uri(); ?>/assets/img/arrow-down.png" alt="">
                </a>
            </div>
        </div>
    </div>
</div>


<?php if ($theatre['video_embed']['show_video']) : ?>
    <div class="container">
        <div class="yt-video text-center">
            <iframe src="https://www.youtube.com/embed/<?= $theatre['video_embed']['youtube_id']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
<?php endif; ?>


<div class="promotion  contact-us" id="promotion-section">
    <div class="container">
        <div class="title-section">
            <h1><?= $theatre['upcoming_event']['heading_title']; ?></h1>
            <div class="lines">
                <hr>
            </div>
        </div>
    </div>
    <div class="content" id="promotion-swiper">
        <div class="swiper-container swiper-container-horizontal swiper-container-free-mode">
            <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                <?php if ($theatre['upcoming_event']['event_type'] === 'manual') : ?>
                    <?php foreach ($theatre['upcoming_event']['event_post'] as $key => $value) : ?>
                        <?php
                                if ($key == 0) {
                                    $class = 'swiper-slide-active';
                                } elseif ($key == 1) {
                                    $class = 'swiper-slide-next';
                                } else {
                                    $class = '';
                                }
                                ?>
                        <?php $field = get_fields($value['post_event']->ID); ?>
                        <div class="swiper-slide <?= $class; ?>" style="width: 393.571px; margin-right: 25px;">
                            <div class="item">
                                <div class="top">
                                    <div class="dis-date">
                                        <div class="date">
                                            <div class="day"><?= date('d', strtotime($field['from'])); ?></div>
                                            <div class="month"><?= date('M', strtotime($field['from'])); ?></div>
                                        </div>
                                        <?php if ($field['price']['is_discount']) : ?>
                                            <div class="discon"><?= $field['price']['discount_tag']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="title"><?= $value['post_event']->post_title; ?></div>
                                    <div class="desc"><?= $field['body_text']; ?></div>
                                    <div class="read-more">
                                        <div class="button-read-more" data-toggle="modal" data-target="#promoModal" data-key="item_<?= $key; ?>">read more<img class="b-brow" src="<?= get_template_directory_uri(); ?>/assets/img/hero-more.png" alt=""><img class="b-white" src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt=""></div>
                                    </div>
                                </div>
                                <div class="bottom" style="background: url(<?= $field['main_image']; ?>)" alt=""></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php $coming_2 = upcoming_show_auto($theatre['upcoming_event']['interval_day']); ?>
                    <?php foreach ($coming_2 as $key => $value) : ?>
                        <?php
                                if ($key == 0) {
                                    $class = 'swiper-slide-active';
                                } elseif ($key == 1) {
                                    $class = 'swiper-slide-next';
                                } else {
                                    $class = '';
                                }
                                ?>
                        <div class="swiper-slide <?= $class; ?>" style="width: 393.571px; margin-right: 25px;">
                            <div class="item">
                                <div class="top">
                                    <div class="dis-date">
                                        <div class="date">
                                            <div class="day"><?= date('d', strtotime($value['from'])); ?></div>
                                            <div class="month"><?= date('M', strtotime($value['from'])); ?></div>
                                        </div>
                                        <?php if ($value['price']['is_discount']) : ?>
                                            <div class="discon"><?= $value['price']['discount_tag']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="title"><?= $value['title']; ?></div>
                                    <div class="desc"><?= $value['body_text']; ?></div>
                                    <div class="read-more">
                                        <div class="button-read-more" data-toggle="modal" data-target="#promoModal" data-key="item_<?= $key; ?>">read more<img class="b-brow" src="<?= get_template_directory_uri(); ?>/assets/img/hero-more.png" alt=""><img class="b-white" src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt=""></div>
                                    </div>
                                </div>
                                <div class="bottom" style="background: url(<?= $value['main_image']; ?>)" alt=""></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- <div class="swiper-button-next promotion-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"><img src="<?= get_template_directory_uri(); ?>/assets/img/next.png" alt=""></div>
            <div class="swiper-button-prev promotion-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"><img src="<?= get_template_directory_uri(); ?>/assets/img/prev.png" alt=""></div> -->
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
        <div class="swiper-button-next promotion-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"><img src="<?= get_template_directory_uri(); ?>/assets/img/next.png" alt=""></div>
        <div class="swiper-button-prev promotion-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"><img src="<?= get_template_directory_uri(); ?>/assets/img/prev.png" alt=""></div>
    </div>
</div>

<div class="promo-modal modal fade and carousel slide" id="promoModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><img src="<?= get_template_directory_uri(); ?>/assets/img/close.png" alt=""></button>
            <div class="carousel-inner">
                <?php if ($theatre['upcoming_event']['event_type'] === 'manual') : ?>
                    <?php foreach ($theatre['upcoming_event']['event_post'] as $key => $value) : ?>
                        <?php $field = get_fields($value['post_event']->ID); ?>
                        <div class="carousel-item item_<?= $key; ?>">
                            <div class="row">
                                <div class="col-sm-6 left"><img src="<?= $field['main_image']; ?>" alt=""></div>
                                <div class="col-sm-6 right">
                                    <div class="title"><?= $value['post_event']->post_title; ?></div>
                                    <div class="date mt-15">
                                        <div class="icon mr-15"><img src="<?= get_template_directory_uri(); ?>/assets/img/calendar.png" alt=""></div>
                                        <?php if (empty($value['to'])) : ?>
                                            <div class="text"><?= date('j M Y', strtotime($field['from'])); ?></div>
                                        <?php else : ?>
                                            <div class="text"><?= date('j M', strtotime($field['from'])); ?> - <?= date('j M Y', strtotime($field['to'])); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prise mt-15">
                                        <div class="icon mr-15"><img src="<?= get_template_directory_uri(); ?>/assets/img/price.png" alt=""></div>
                                        <div class="text mr-15"><?= $field['price']['currencies']; ?> <?= $field['price']['amount']; ?></div>
                                        <?php if ($field['price']['is_discount']) : ?>
                                            <div class="discon"><?= $field['price']['discount_tag']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="desc mt-20"><?= $field['body_text']; ?></div>
                                    <?php
                                            if ($field['link_&_text']['target'] !== '') {
                                                $target = 'target="_blank"';
                                            } else {
                                                $target = '';
                                            }
                                            ?>
                                    <a class="button-readmore mt-20" target="t_blank" href="<?= $field['link_&_text']['url']; ?>" <?= $target; ?>>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt=""><?= $field['link_&_text']['title']; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php $coming_2 = upcoming_show_auto($theatre['upcoming_event']['interval_day']); ?>
                    <?php foreach ($coming_2 as $key => $value) : ?>
                        <div class="carousel-item item_<?= $key; ?>">
                            <div class="row">
                                <div class="col-sm-6 left"><img src="<?= $value['main_image']; ?>" alt=""></div>
                                <div class="col-sm-6 right">
                                    <div class="title"><?= $value['title']; ?></div>
                                    <div class="date mt-15">
                                        <div class="icon mr-15"><img src="<?= get_template_directory_uri(); ?>/assets/img/calendar.png" alt=""></div>
                                        <?php if (empty($value['to'])) : ?>
                                            <div class="text"><?= date('j M Y', strtotime($value['from'])); ?></div>
                                        <?php else : ?>
                                            <div class="text"><?= date('j M', strtotime($value['from'])); ?> - <?= date('j M Y', strtotime($value['to'])); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prise mt-15">
                                        <div class="icon mr-15"><img src="<?= get_template_directory_uri(); ?>/assets/img/price.png" alt=""></div>
                                        <div class="text mr-15"><?= $value['price']['currencies']; ?> <?= $value['price']['amount']; ?></div>
                                        <?php if ($value['price']['is_discount']) : ?>
                                            <div class="discon"><?= $value['price']['discount_tag']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="desc mt-20"><?= $value['body_text']; ?></div>
                                    <?php
                                            if ($value['link']['target'] !== '') {
                                                $target = 'target="_blank"';
                                            } else {
                                                $target = '';
                                            }
                                            ?>
                                    <a class="button-readmore mt-20" href="<?= $value['link']['url']; ?>" <?= $target; ?>>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt=""><?= $value['link']['title']; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <a class="control-prev carousel-control" href="#promoModal" role="button" data-slide="prev">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/prev-white.png" alt="">
            </a>
            <a class="control-next carousel-control" href="#promoModal" role="button" data-slide="next">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/next-white.png" alt="">
            </a>
        </div>
    </div>
</div>

<?php if ( $theatre[ 'now_showing' ] ) : ?>
    <div class="now-showing" id="nowshowing-section">
        <div class="container">
            <div class="title-section">
                <h1>Now Showing</h1>
                <div class="lines">
                    <hr>
                </div>
                <div class="filter">
                    <select class="form-control" id="filter-genre" name="filter-genre">
                        <option value="all">All</option>
                        <?php foreach ($cats as $key => $value) : ?>
                            <option value="<?= $value->term_id; ?>"><?= $value->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="content">
                <div class="date-drop" id="sandbox-container">
                    <div class="date-picker" data-date=""></div>
                    <input type="hidden" class="paging" value="2">
                    <input type="hidden" class="prevPaging" value="">
                </div>

                <div class="showing">
                    <div class="showsMain">
                        <?php foreach (now_showing() as $key => $value) : ?>
                            <div class="item triggers" data-toggle="modal" data-target="#showingModal" data-key="show_<?= $key; ?>">
                                <div class="image" style="background: url(<?= $value['main_image']; ?>)" alt=""></div>
                                <div class="det">
                                    <div class="title"><?= $value['title']; ?></div>
                                    <div class="date">
                                        <div class="icon">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/calendar.png" alt="">
                                        </div>
                                        <?php if (empty($value['to'])) : ?>
                                            <div class="text"><?= date('j M Y', strtotime($value['from'])); ?></div>
                                        <?php else : ?>
                                            <div class="text"><?= date('j M', strtotime($value['from'])); ?> - <?= date('j M Y', strtotime($value['to'])); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prise">
                                        <div class="icon"><img src="<?= get_template_directory_uri(); ?>/assets/img/price.png" alt=""></div>
                                        <div class="text"><?= $value['price']['currencies']; ?> <?= $value['price']['amount']; ?></div>
                                    </div>
                                </div>
                                <div class="arrow-btn">
                                    <img class="i-brow" src="<?= get_template_directory_uri(); ?>/assets/img/next.png" alt="">
                                    <img class="i-white" src="<?= get_template_directory_uri(); ?>/assets/img/next-white.png" alt="">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <nav class="page">
                        <ul class="pagination">
                            <li class="page-item prev-pages">
                                <a class="page-link">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/prev.png" alt="">
                                </a>
                            </li>
                            <li class="page-item next-pages">
                                <a class="page-link">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/next.png" alt="">
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="promo-modal modal fade and carousel slide" id="showingModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><img src="<?= get_template_directory_uri(); ?>/assets/img/close.png" alt=""></button>
            <div class="carousel-inner">
                <div class="showsModal">
                    <?php foreach (now_showing() as $key => $value) : ?>
                        <div class="carousel-item show_<?= $key; ?>">
                            <div class="row">
                                <div class="col-sm-6 left"><img src="<?= $value['main_image']; ?>" alt=""></div>
                                <div class="col-sm-6 right">
                                    <div class="title"><?= $value['title']; ?></div>
                                    <div class="date mt-15">
                                        <div class="icon mr-15"><img src="<?= get_template_directory_uri(); ?>/assets/img/calendar.png" alt=""></div>
                                        <?php if (empty($value['to'])) : ?>
                                            <div class="text"><?= date('j M Y', strtotime($value['from'])); ?></div>
                                        <?php else : ?>
                                            <div class="text"><?= date('j M', strtotime($value['from'])); ?> - <?= date('j M Y', strtotime($value['to'])); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prise mt-15">
                                        <div class="icon mr-15"><img src="<?= get_template_directory_uri(); ?>/assets/img/price.png" alt=""></div>
                                        <div class="text"><?= $value['price']['currencies']; ?> <?= $value['price']['amount']; ?></div>
                                        <?php if ($value['price']['is_discount']) : ?>
                                            <div class="discon"><?= $value['price']['discount_tag']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="desc mt-20">
                                        <?= $value['body_text']; ?>
                                    </div>
                                    <?php
                                        if ($value['link']['target'] !== '') {
                                            $target = 'target="_blank"';
                                        } else {
                                            $target = '';
                                        }
                                        ?>
                                    <a class="button-readmore mt-20" target="t_blank" href="<?= $value['link']['url']; ?>" <?= $target; ?>>
                                        <img src="<?= get_template_directory_uri(); ?>/assets/img/hero-more-white.png" alt=""><?= $value['link']['title']; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
            <a class="control-prev carousel-control" href="#showingModal" role="button" data-slide="prev">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/prev-white.png" alt="">
            </a>
            <a class="control-next carousel-control" href="#showingModal" role="button" data-slide="next">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/next-white.png" alt="">
            </a>
        </div>
    </div>
</div>


<div class="photo-gallery" id="gallery-section">
    <div class="container">
        <div class="title-section">
            <h1>Photo Gallery</h1>
            <div class="lines">
                <hr>
            </div>
            <div class="filter">
                <select class="form-control" id="filter-gallery" name="filter-image">
                    <option value="all">View All</option>
                    <?php if ($post_gallery != false) : ?>
                        <?php foreach ($post_gallery as $key => $value) : ?>
                            <option value="<?= $value->ID; ?>"><?= $value->post_title; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="center" id="gallery-photo">
            <div class="swiper-container">
                <div class="swiper-wrapper" id="contentGallery">
                    <?php foreach ($gallery as $key => $value) : ?>
                        <?php foreach ($value as $kis => $val) : ?>
                            <div class="swiper-slide allPhoto" data-toggle="modal" data-target="#galleryModal" data-slide-to="<?= $key; ?>" data-key="gallery_<?= $key; ?>">
                                <div class="img" style="background:url('<?= $val['img']; ?>') no-repeat"></div>
                                <!-- <img src="<?= $val['img']; ?>" alt=""> -->
                            </div>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="swiper-button-next gallery-button-next"><img src="<?= get_template_directory_uri(); ?>/assets/img/arrow-r.png" alt=""></div>
            <div class="swiper-button-prev gallery-button-prev"><img src="<?= get_template_directory_uri(); ?>/assets/img/arrow-l.png" alt=""></div>
        </div>
    </div>
</div>


<div class="gallery-modal modal fade and carousel slide" id="galleryModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/close-white.png" alt="">
            </button>
            <div class="carousel-inner" id="modalListGallery">
                <?php foreach ($gallery as $key => $value) : ?>
                    <?php foreach ($value as $kis => $val) : ?>
                        <?php if ($key == 0 && $kis == 0) : ?>
                            <div class="carousel-item active">
                                <img src="<?= $val['img']; ?>" alt="">
                                    <?php if ($val['caption'] !== '') : ?>
                                        <div class="caption">
                                                <p><?= $val['caption']; ?></p>
                                        </div>
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <div class="carousel-item">
                                <img src="<?= $val['img']; ?>" alt="">

                                <?php if ($val['caption'] !== '') : ?>
                                <div class="caption">
                                        <p><?= $val['caption']; ?></p>
                                </div>

                                <?php endif; ?>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endforeach ?>
            </div>
            <a class="control-prev carousel-control" href="#galleryModal" role="button" data-slide="prev">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/prev-white.png" alt="">
            </a>
            <a class="control-next carousel-control" href="#galleryModal" role="button" data-slide="next">
                <img src="<?= get_template_directory_uri(); ?>/assets/img/next-white.png" alt="">
            </a>
        </div>
    </div>
</div>


<div class="contact-us" id="contact-section">
    <div class="container">
        <div class="title"><?= $theatre['contact_theatre']['heading_title']; ?></div>
        <div class="form">

            <?= do_shortcode(__($theatre['contact_theatre']['form_code'])); ?>

        </div>
    </div>
</div>
<div class="totop" style="display: none">
    <a href="javascript:;"><img src="<?= get_template_directory_uri(); ?>/assets/img/arrow-top.png" alt=""></a>
</div>
<div class="space"></div>

<script>
    var keys = '';
    var kis = '';

    $('.button-read-more , .upcoming .item').click(function(e) {
        keys = $(this).attr('data-key');
        $('.' + keys).addClass('active');
    });

    function init_gallery() {
        var $window = $(window);
        var windowsize = $window.width();
        if (windowsize > 576) {
            var gallery_swiper = new Swiper('#gallery-photo .swiper-container', {
                navigation: {
                    nextEl: '.gallery-button-next',
                    prevEl: '.gallery-button-prev',
                },
                centeredSlides: true,
                slidesPerView: 5,
                spaceBetween: 25,
                loop: true,
            });
        } else {
            var gallery_swiper = new Swiper('#gallery-photo .swiper-container', {
                navigation: {
                    nextEl: '.gallery-button-next',
                    prevEl: '.gallery-button-prev',
                },
                centeredSlides: true,
                slidesPerView: 3,
                spaceBetween: 25,
                loop: true,
            });
        }
    }

    function changeGalleryList(ids) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'html',
            data: {
                action: 'changeGalleryModal',
                id: ids
            },
            success: function(e) {
                $('#modalListGallery').html(e);
            }
        })
    }

    function changeGallery(ids) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'html',
            data: {
                action: 'changeGallery',
                id: ids
            },
            success: function(e) {
                $('#contentGallery').html(e);
                init_gallery();
            }
        })
    }

    function replaced_nowShowing($coll) {
        console.log($coll);

        if ($coll.next_post != null) {
            $('.paging').val($coll.next_post);
            $('.next-pages').removeClass('disabled');
        } else {
            $('.paging').val('');
            $('.next-pages').addClass('disabled');
        }

        if ($coll.prev_post != null) {
            $('.prevPaging').val($coll.prev_post);
            $('.prev-pages').removeClass('disabled');
        } else {
            $('.prevPaging').val('');
            $('.prev-pages').addClass('disabled');
        }

        if ($coll.post != null) {
            $('.showsMain').html('');
            $('.showsModal').html('');

            $.each($coll.post, function(index, value) {

                console.log(value.data.from_date);

                if (value.data.link.target !== '') {
                    $btn = '<a class="button-readmore mt-20" href="' + value.data.link.url + '" target="_blank"><img src="/wp-content/themes/capitol/assets/img/hero-more-white.png" alt="">' + value.data.link.title + '</a>';
                } else {
                    $btn = '<a class="button-readmore mt-20" href="' + value.data.link.url + '"><img src="/wp-content/themes/capitol/assets/img/hero-more-white.png" alt="">' + value.data.link.title + '</a>';
                }

                if (index == 0) {
                    $class = '';
                } else {
                    $class = '';
                }

                if (value.data.to_date === 500) {
                    $main = '<div class="item triggers" data-toggle="modal" data-target="#showingModal" data-key="show_' + index + '"><div class="image" style="background: url(' + value.data.main_image + ')" alt=""></div><div class="det"><div class="title">' + value.title + '</div><div class="date"><div class="icon"><img src="/wp-content/themes/capitol/assets/img/calendar.png" alt=""></div><div class="text">' + value.data.from_date + '</div></div><div class="prise"><div class="icon"><img src="/wp-content/themes/capitol/assets/img/price.png" alt=""></div><div class="text">' + value.data.price.currencies + ' ' + value.data.price.amount + '</div></div></div><div class="arrow-btn"><img class="i-brow" src="/wp-content/themes/capitol/assets/img/next.png" alt=""><img class="i-white" src="/wp-content/themes/capitol/assets/img/next-white.png" alt=""></div></div>';

                    $modal = '<div class="carousel-item show_' + index + ' ' + $class + '"><div class="row"><div class="col-sm-6 left"><img src="' + value.data.main_image + '" alt=""></div><div class="col-sm-6 right"><div class="title">' + value.title + '</div><div class="date mt-15"><div class="icon mr-15"><img src="/wp-content/themes/capitol/assets/img/calendar.png" alt=""></div><div class="text">' + value.data.from_date + '</div></div><div class="prise mt-15"><div class="icon mr-15"><img src="/wp-content/themes/capitol/assets/img/price.png" alt=""></div><div class="text">' + value.data.price.currencies + ' ' + value.data.price.amount + '</div></div><div class="desc mt-20">' + value.data.body_text + '</div>' + $btn + '</div></div></div>';
                } else {
                    $main = '<div class="item triggers" data-toggle="modal" data-target="#showingModal" data-key="show_' + index + '"><div class="image" style="background: url(' + value.data.main_image + ')" alt=""></div><div class="det"><div class="title">' + value.title + '</div><div class="date"><div class="icon"><img src="/wp-content/themes/capitol/assets/img/calendar.png" alt=""></div><div class="text">' + value.data.from_date + ' - ' + value.data.to_date + '</div></div><div class="prise"><div class="icon"><img src="/wp-content/themes/capitol/assets/img/price.png" alt=""></div><div class="text">' + value.data.price.currencies + ' ' + value.data.price.amount + '</div></div></div><div class="arrow-btn"><img class="i-brow" src="/wp-content/themes/capitol/assets/img/next.png" alt=""><img class="i-white" src="/wp-content/themes/capitol/assets/img/next-white.png" alt=""></div></div>';

                    $modal = '<div class="carousel-item show_' + index + ' ' + $class + '"><div class="row"><div class="col-sm-6 left"><img src="' + value.data.main_image + '" alt=""></div><div class="col-sm-6 right"><div class="title">' + value.title + '</div><div class="date mt-15"><div class="icon mr-15"><img src="/wp-content/themes/capitol/assets/img/calendar.png" alt=""></div><div class="text">' + value.data.from_date + ' - ' + value.data.to_date + '</div></div><div class="prise mt-15"><div class="icon mr-15"><img src="/wp-content/themes/capitol/assets/img/price.png" alt=""></div><div class="text">' + value.data.price.currencies + ' ' + value.data.price.amount + '</div></div><div class="desc mt-20">' + value.data.body_text + '</div>' + $btn + '</div></div></div>';
                }


                $('.showsModal').prepend($modal);
                $('.showsMain').prepend($main);
            });
        }
    }

    function change_nowShowing($date, $genre, $paging) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'JSON',
            data: {
                action: 'filterNowShowing',
                date: $date,
                genre: $genre,
                page: $paging
            },
            success: function(e) {
                $('.carousel-item').removeClass('active');
                replaced_nowShowing(e);
            }
        })
    }

    $('.next-pages').click(function() {
        var dates = $('#sandbox-container .date-picker').datepicker('getFormattedDate');
        var genre = $('#filter-genre').val();
        var paging = $('.paging').val();
        change_nowShowing(dates, genre, paging);
    });

    $('.prev-pages').click(function() {
        var dates = $('#sandbox-container .date-picker').datepicker('getFormattedDate');
        var genre = $('#filter-genre').val();
        var paging = $('.prevPaging').val();
        change_nowShowing(dates, genre, paging);
    });

    $('#sandbox-container .date-picker').on('changeDate', function() {
        var dates = $(this).datepicker('getFormattedDate');
        var genre = $('#filter-genre').val();
        var paging = 1;
        change_nowShowing(dates, genre, paging);
    });

    $('#filter-genre').on('change', function() {
        var genre = $(this).val();
        var dates = $('#sandbox-container .date-picker').datepicker('getFormattedDate');
        var paging = 1;
        change_nowShowing(dates, genre, paging);
    });


    $('#filter-gallery').on('change', function() {
        var ids = $(this).val();
        changeGallery(ids);
        changeGalleryList(ids);
    });

    $('.showsMain').on('click', '.triggers', function() {
        kis = $(this).attr('data-key');
        $('.' + kis).addClass('active');
    });

    $('.triggers').click(function() {

    });

    $('#promoModal').on('hidden.bs.modal', function() {
        $('.' + keys).removeClass('active');
        $('.carousel-item').removeClass('active');
    });

    $('#showingModal').on('hidden.bs.modal', function() {
        // $('.' + kis).removeClass('active');
        $('.carousel-item').removeClass('active');
    });



    // pannellum.viewer('360-image', {
    //     "type": "equirectangular",
    //     "autoLoad": true,
    //     "panorama": "<?= esc_attr($theatre['about_theater']['360_image']); ?>",
    //     "autoRotate": -0.5
    // });
    
</script>
<?php get_footer(); ?>