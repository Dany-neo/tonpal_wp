<?php
// 获取首页json
$home_vars = json_config_array('home', 'vars');
$theme_widgets = json_config_array('home', 'widgets');
set_query_var('home_carousel', $theme_widgets['carousel']);
// SEO
$seo_title = ifEmptyText($home_vars['seoTitle']['value']);
$seo_keywords = ifEmptyText($home_vars['seoDescription']['value']);
$seo_description = ifEmptyText($home_vars['seoKeywords']['value']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <?php get_template_part('templates/components/head') ?>
    <style>
        @media only screen and (max-width: 950px) {
            .index_choice .index_hd {
                margin-bottom: 20px;
            }

            .index_choice ul {
                padding-bottom: 30px;
            }

            .index_choice li {
                margin: 10px 0;
            }

            .index_company_intr .company_intr_desc p {
                overflow: hidden;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- web_head start -->
        <?php get_header() ?>
        <!--// web_head end -->


        <!-- web_main start -->
        <section class="web_main index_main home_index">

            <!-- banner -->
            <?php get_template_part('templates/components/carousel') ?>


            <!-- index_welcome -->
            <?php $welcome = $theme_widgets['welcome'];
            if ($welcome['display'] == 1) {
                $welcome_vars = $welcome['vars'];
                $welcome_title = ifEmptyText($welcome_vars['title']['value']);
                $welcome_desc = ifEmptyText($welcome_vars['desc']['value']); ?>

                <section class="index_welcome">
                    <div class="index_bd">
                        <div class="layout">
                            <h2 class="welcome_title wow fadeInUpA" data-wow-delay=".1s" data-wow-duration=".8s"><?php echo $welcome_title ?></h2>
                            <p class="welcome_desc wow fadeInUpA formate-text-3" data-wow-delay=".2s" data-wow-duration=".8s"><?php echo $welcome_desc ?></p>
                        </div>
                    </div>
                </section>
            <?php } ?>


            <!-- index_ad -->
            <?php $indexAd = $theme_widgets['indexAd'];
            if ($indexAd['display'] == 1) {
                $indexAdVars = $indexAd['vars'];
                $adTitle = ifEmptyText($indexAdVars['title']['value']);
                $adDesc = ifEmptyText($indexAdVars['desc']['value']);
                $adItems = ifEmptyArray($indexAdVars['items']['value']) ?>

                <section class="index_choice">
                    <div class="index_hd wow fadeInDownA" data-wow-delay=".1s" data-wow-duration=".8s">
                        <div class="layout">
                            <h2 class="hd_title"><?php echo $adTitle ?></h2>
                            <p class="hd_desc"><?php echo $adDesc ?></p>
                        </div>
                    </div>
                    <div class="index_bd">
                        <div class="layout">
                            <ul class="ad_items flex_row">
                                <?php foreach ($adItems as $item) { ?>
                                    <li>
                                        <figure class="item_inner">
                                            <span class="item_img"><img src="<?php echo $item['image'] ?>" alt=""></span>
                                            <figcaption class="item_info">
                                                <h3 class="item_title"><?php echo $item['title']  ?></h3>
                                                <p class="item_desc"><?php echo $item['desc'] ?></p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </section>
            <?php } ?>


            <!-- index_product -->
            <?php $products = $theme_widgets['products'];
            if ($products['display'] == 1) {
                $products_vars = $products['vars'];
                $products_bg = ifEmptyText($products_vars['bg']['value']);
                $products_tag = ifEmptyText($products_vars['tag']['value']);
                $products_title = ifEmptyText($products_vars['title']['value']);
                $products_desc = ifEmptyText($products_vars['desc']['value']);
                $products_item = ifEmptyArray($products_vars['items']['value']); ?>

                <section class="index_product" style="background-image: url(<?php echo $products_bg ?>)">
                    <h4 class="hd_tag"><span class="tag_txt"><?php echo $products_tag ?></span></h4>
                    <div class="index_hd wow fadeInDownA" data-wow-delay=".1s" data-wow-duration=".8s">
                        <div class="layout">
                            <h2 class="hd_title"><?php echo $products_title ?></h2>
                            <p class="hd_desc"><?php echo $products_desc ?></p>
                        </div>
                    </div>
                    <div class="index_bd">
                        <div class="layout">
                            <div class="product_slider">
                                <ul class="swiper-wrapper product_items">
                                    <?php foreach ($products_item as $item) { ?>
                                        <li class="swiper-slide product_item wow fadeInLeftA" data-wow-delay=".1s" data-wow-duration=".8s">
                                            <figure>
                                                <span class="item_img">
                                                    <img src="<?php echo $item['image'] ?>" alt="<?php echo $item['title'] ?>" />
                                                    <a href="<?php echo $item['link'] ?>"></a>
                                                </span>
                                                <figcaption>
                                                    <h3 class="item_title"><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></h3>
                                                </figcaption>
                                            </figure>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="index_swiper_control">
                                    <div class="swiper-buttons">
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>


            <!-- index_business -->
            <?php $business = $theme_widgets['business'];
            if ($business['display'] == 1) { ?>

                <section class="index_business" style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/images/index_business_bg.jpg)">
                    <div class="index_bd wow fadeInUpA" data-wow-delay=".1s" data-wow-duration=".8s">
                        <div class="layout">
                            <h2 class="business_title"><?php echo $business['vars']['desc']['value'] ?></h2>
                        </div>
                    </div>
                </section>
            <?php } ?>


            <!-- index_company_intr -->
            <?php $about = $theme_widgets['about'];
            if ($about['display'] == 1) {
                $about_vars = $about['vars'];
                $about_title = ifEmptyText($about_vars['title']['value']);
                $about_desc = ifEmptyText($about_vars['desc']['value']);
                $about_btn = ifEmptyText($about_vars['btn']['value']);
                $about_link = ifEmptyText($about_vars['link']['value']);
                $about_images = ifEmptyArray($about_vars['images']['value']); ?>

                <section class="index_company_intr">
                    <div class="index_bd">
                        <div class="layout flex_row">
                            <div class="company_intr_cont wow fadeInLeftA" data-wow-delay=".1s" data-wow-duration=".8s">
                                <div class="index_hd">
                                    <h2 class="hd_title"><?php echo $about_title ?></h2>
                                </div>
                                <div class="company_intr_desc">
                                    <p><?php echo $about_desc ?></p>
                                    <div class="learn_more">
                                        <a href="<?php echo $about_link ?>" class="sys_btn"><?php echo $about_btn ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="company_intr_img wow fadeInRightA" data-wow-delay=".1s" data-wow-duration=".8s">
                                <div class="company_img_box">
                                    <div class="company_intr_slider">
                                        <ul class="swiper-wrapper">
                                            <?php foreach ($about_images as $item) { ?>
                                                <li class="swiper-slide"><img src="<?php echo $item['image'] ?>" alt="<?php echo $item['alt'] ?>"></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="index_swiper_control">
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>


            <!-- index_brands -->
            <?php $brands = $theme_widgets['brand'];
            if ($brands['display'] == 1) {
                $brands_item = ifEmptyArray($brands['vars']['items']['value']) ?>

                <section class="index_brands">
                    <div class="index_bd wow fadeInUpA" data-wow-delay=".1s" data-wow-duration=".8s">
                        <div class="layout">
                            <div class="brand_slider">
                                <ul class="brand_items swiper-wrapper">
                                    <?php foreach ($brands_item as $item) { ?>
                                        <li class="brand_item swiper-slide">
                                            <a href="<?php echo $item['link'] ?>"><img src="<?php echo $item['image'] ?>" alt="<?php echo $item['alt'] ?>"></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="index_swiper_control">
                                    <div class="swiper-buttons">
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>

        </section>
        <!--// web_main end -->


        <!-- web_footer start -->
        <?php get_footer() ?>
        <!--// web_footer end -->

    </div>
    <!--// container end -->

</body>
<?php get_template_part('templates/components/footer') ?>

</html>