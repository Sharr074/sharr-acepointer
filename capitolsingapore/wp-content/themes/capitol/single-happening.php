<?php get_header(); ?>
<?php $fields = get_fields(); ?>
<div class="hero-happening-single">
  <div class="container">
    <div class="tagline">Happening</div>
  </div>
</div>
<div class="happening-single-content">
  <div class="container">
    <div class="section-1">
      <div class="image"><img src="<?= $fields['main_image']; ?>" alt=""></div>
      <div class="detail">
        <div class="title"><?php the_title(); ?></div>
        <div class="desc"><?= get_post_field('post_content', get_the_ID()); ?></div>
        <div class="event-detail">Event Details</div>
        <div class="det">
          <div class="icon"><img class="place" src="<?= get_template_directory_uri(); ?>/assets/img/list-place-2.png" alt=""></div>
          <div class="text"><?= $fields['event_details']['location']; ?></div>
        </div>
        <?php if ($fields['event_details']['date_&_time']['start_date']) : ?>
          <div class="det">
            <div class="icon"><img class="date" src="<?= get_template_directory_uri(); ?>/assets/img/calendar.png" alt=""></div>
            <div class="text">
              <?php if (date('Y', strtotime($fields['event_details']['date_&_time']['start_date'])) == date('Y', strtotime($fields['event_details']['date_&_time']['end_date']))) : ?>
                <?php echo date('j M', strtotime($fields['event_details']['date_&_time']['start_date'])) . ' - ' . date('j M Y', strtotime($fields['event_details']['date_&_time']['end_date'])); ?>
              <?php else : ?>
                <?php echo date('j M Y', strtotime($fields['event_details']['date_&_time']['start_date'])) . ' - ' . date('j M Y', strtotime($fields['event_details']['date_&_time']['end_date'])); ?>
              <?php endif; ?>
              <?php if ($fields['event_details']['date_&_time']['day']) : ?>
                <?php echo '&nbsp;&nbsp;&nbsp|&nbsp;&nbsp;&nbsp;'; ?>
                <?php foreach ((array) $fields['event_details']['date_&_time']['day'] as $key => $value) : ?>
                  <?php if ($key == 0) : ?>
                    <?php echo ucwords(substr($value['from'], 0, 3)) . ' - ' . ucwords(substr($value['to'], 0, 3)) . ' : ' . $value['time']; ?>
                  <?php else : ?>
                    <?php echo ', ' . ucwords(substr($value['from'], 0, 3)) . ' - ' . ucwords(substr($value['to'], 0, 3)) . ' : ' . $value['time']; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($fields['price_list'] != null) : ?>
          <div class="det">
            <div class="icon"><img class="price" src="<?= get_template_directory_uri(); ?>/assets/img/price.png" alt=""></div>
            <div class="text">
              <?php $last = count($fields['price_list']) - 1; ?>
              <?php foreach ($fields['price_list'] as $key => $value) : ?>
                <?php if ($key == $last) : ?>
                  <?= $value['currencies']; ?> <?= $value['amount']; ?>
                <?php else : ?>
                  <?= $value['currencies']; ?> <?= $value['amount']; ?> &nbsp;&nbsp; | &nbsp;&nbsp;
                <?php endif ?>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif ?>
      </div>
    </div>
    <?php if (isset($fields['main_content']) && $fields['main_content'] !== '') : ?>
      <div class="section-2">
        <?= __($fields['main_content']); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="space"></div>
<?php get_footer(); ?>