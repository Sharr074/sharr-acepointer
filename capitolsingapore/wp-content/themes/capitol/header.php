<?php $setting = get_field('settings', 'option'); $now = site_url().$_SERVER['REQUEST_URI']; //var_dump($setting['header_menu']);?>
<!DOCTYPE html>
<html>
  <head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KCGVV4T');</script>
<!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="language" content="en">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <?php wp_head();?>
  </head>
  <script>
    (function (d, t) {
    	var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
    	bh.type = 'text/javascript';
    	bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=f9ebmlnxlmrbxmhfws3ihq';
    	s.parentNode.insertBefore(bh, s);
    })(document, 'script');
  </script>
  <body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KCGVV4T"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <header id="header">
      <div class="bg-nav"></div>
      <nav class="navbar navbar-expand-xl">
        <a href="<?php bloginfo('url');?>">
          <img class="logo" src="<?= $setting['logo'];?>" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <a class="menu icon-menu" href="#"><span></span></a>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <?php foreach ($setting['header_menu'] as $key => $value): ?>
              <?php if ($value['has_submenu']): ?>
                <li class="nav-item dropdown">
                  <a class="dropdown-toggle" href="<?= $value['link']['url'];?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $value['link']['title'];?></a>
                  <div class="dropdown-menu">
                    <div class="triangel"></div>
                    <?php foreach ($value['submenu'] as $kis => $val): ?>
											<?php if ($val['link']['target'] !== '') :?>
												<a class="dropdown-item" href="<?= $val['link']['url'];?>" target="_blank"><?= $val['link']['title'];?></a>
											<?php else : ?>
												<a class="dropdown-item" href="<?= $val['link']['url'];?>" ><?= $val['link']['title'];?></a>
											<?php endif;?>
                      
                    <?php endforeach ?>
                  </div>
                </li>
              <?php else : ?>
                <?php if ($now === $value['link']['url']): ?>
                  <li class="nav-item active">
                    <?php if ($value['link']['target'] !== ''): ?>
                      <a href="<?= $value['link']['url'];?>" target="_blank"><?= $value['link']['title'];?></a>
                    <?php else : ?>
                      <a href="<?= $value['link']['url'];?>"><?= $value['link']['title'];?></a>
                    <?php endif ?>
                  </li>
                <?php else : ?>
                  <li class="nav-item">
                    <?php if ($value['link']['target'] !== ''): ?>
                      <a href="<?= $value['link']['url'];?>" target="_blank"><?= $value['link']['title'];?></a>
                    <?php else : ?>
                      <a href="<?= $value['link']['url'];?>"><?= $value['link']['title'];?></a>
                    <?php endif ?>
                  </li>
                <?php endif ?>
                
              <?php endif ?>
            <?php endforeach ?>

            <li class="nav-item m-on">
              <form class="form-inline" action="<?= site_url();?>" method="get">
                <input class="form-control" type="text" name="s" placeholder="Search" aria-label="Search">
                <img src="<?= get_template_directory_uri();?>/assets/img/search.png" alt="">
              </form>
            </li>
          </ul>

        <div class="nav-item serc m-off">
          <form class="form-inline" action="<?= site_url();?>" method="get">
            <input class="form-control" type="text" name="s" placeholder="Search" aria-label="Search">
            <img id="searchButton" src="<?= get_template_directory_uri();?>/assets/img/search.png" alt="">
          </form>
        </div>
        </div>
      </nav>
    </header>