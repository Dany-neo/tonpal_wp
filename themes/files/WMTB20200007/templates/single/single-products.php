<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();
// product-detail.json -> vars 数据获取
$theme_vars = json_config_array('header', 'vars', 1);
// Text 数据处理
$productDetail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$productDetail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);
$photos = ifEmptyArray(get_post_meta(get_post()->ID, 'photos'));
$photosArray = [];
foreach ($photos as $key => $item) {
    array_push($photosArray, json_decode($photos[$key], true));
}

$pdf = ifEmptyText(get_post_meta(get_post()->ID, 'pdf', true));
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID, 'seo_title', true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID, 'seo_description', true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID, 'seo_keywords', true));

// 当前页面url
$page_url = get_lang_page_url();
$sub_title = ifEmptyText(get_post_meta(get_post()->ID, 'sub_title', true));

$tags_title = ifEmptyText($theme_vars['tags']['value']);

?>

<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- OG -->
    <meta property="og:title" content="<?php echo $post->post_title; ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php echo $page_url; ?>" />
    <meta property="og:description" content="<?php echo $seo_description; ?>" />
    <meta property="og:image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />
    <meta property="og:site_name" content="<?php get_host_name(); ?>" />
    <!-- itemprop -->
    <meta itemprop="name" content="<?php echo $post->post_title; ?>" />
    <meta itemprop="description" content="<?php the_excerpt(); ?>" />
    <meta property="image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />
    <!-- Twitter -->
    <meta name="twitter:site" content="@affiliate_<?php get_host_name();; ?>" />
    <meta name="twitter:creator" content="@affiliate_<?php get_host_name(); ?>" />
    <meta name="twitter:title" content="<?php echo $post->post_title; ?>" />
    <meta name="twitter:description" content="<?php echo $seo_description; ?>" />
    <meta name="twitter:image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php get_template_part('templates/components/head') ?>

    <style>
        .tab-panel a {
            margin-right: 12px;
        }

        table {
            width: 100% !important;
        }

        p {
            word-break: break-all;
        }

        .change-container.container {
            width: 100%;
            padding: 0;
        }

        .product-image {
            width: 381px;
            height: 381px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* 产品详情 轮播图 */
        @media only screen and (max-width: 950px) {
            .product-image {
                display: none;
            }

            .image-additional {
                display: none;
            }

            .mobile-image-additional {
                position: relative;
                display: block !important;
                overflow: hidden;
                width: 100%;
                padding-bottom: 100%;
            }

            .mobile-image-additional ul {
                position: absolute;
                top: 0;
                left: 0;
                min-width: 300%;
                height: 100%;
                transition: all 0.5s;
            }

            .mobile-image-additional ul li {
                float: left;
                width: 33%;
                min-width: 33%;
                height: 100%;
            }

            .mobile-image-additional ul img {
                width: 100%;
                height: auto;
                object-fit: contain;
            }

            .mobile-image-additional .left-btn,
            .mobile-image-additional .right-btn {
                position: absolute;
                z-index: 100;
                top: 50%;
                width: 28px;
                height: 40px;
                margin-top: -20px;
                text-align: center;
                line-height: 40px;
                font-size: 20px;
                color: #fff;
                border-radius: 3px;
                background-color: #525252;
                opacity: 0.8;
            }

            .mobile-image-additional .left-btn {
                left: 10px;
            }

            .mobile-image-additional .right-btn {
                right: 10px;
            }
        }

        @media only screen and (max-width: 950px) {
            .product-summary {
                margin-left: 0 !important;
            }

            .single-products .product-btn-wrap {
                position: static;
            }

            .product-detail {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container change-container single-products">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->

        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <div class="product-intro">
                    <div class="product-view">
                        <div class="product-image">
                            <a class="certificate-fancy" target="_blank" href="<?php echo ifEmptyText($photosArray[0]['url']) ?>">
                                <img src="<?php echo ifEmptyText($photosArray[0]['url']) ?>" alt="<?php echo ifEmptyText($photosArray[0]['alt']) ?>" style="width:100%" />
                            </a>
                        </div>
                        <div class="image-additional">
                            <ul class="image-items">
                                <?php foreach ($photosArray as $key => $item) { ?>
                                    <li class="image-item">
                                        <a onclick="toView('<?php echo ifEmptyText($item['url']) ?>')" href="javascript:;">
                                            <img src="<?php echo ifEmptyText($item['url']) ?>" alt="<?php echo ifEmptyText($item['alt']) ?>" />
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="mobile-image-additional" style="display: none;">
                            <a href="javascript:;" onclick="move('L')" class="left-btn disabled">
                                <</a> <a href="javascript:;" onclick="move('R')" class="right-btn">>
                            </a>
                            <ul>
                                <?php foreach ($photosArray as $key => $item) { ?>
                                    <li>
                                        <a href="javascript:;">
                                            <img src="<?php echo ifEmptyText($item['url']) ?>" alt="<?php echo ifEmptyText($item['alt']) ?>" />
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <br>
                    </div>

                    <div class="product-summary">
                        <!-- product info -->
                        <?php if ($sub_title == '') { ?>
                            <h1 class="h1-title">
                                <?php echo $post->post_title; ?>
                            </h1>
                        <?php } else { ?>
                            <div class="h1-title">
                                <?php echo $post->post_title; ?>
                            </div>
                        <?php } ?>
                        <div class="share-this">
                            <!--share-->
                            <script async src="//platform-api.sharethis.com/js/sharethis.js#property=58cb62ef8263e70012464e1a&product=inline-share-buttons"></script>
                            <div class="sharethis-inline-share-buttons"></div>
                            <!--// share-->
                        </div>

                        <?php if ($sub_title != '') { ?>
                            <h1 class="sub-title">
                                <?php echo $sub_title; ?>
                            </h1>
                        <?php } ?>
                        <div class="product-meta">
                            <p><?php echo $post->post_excerpt ?></p>
                            <br>
                        </div>

                        <div class="gm-sep product-btn-wrap">
                            <a href="#myform" class="email"><?php echo $productDetail_inquiry_btn ?></a>
                            <?php if ($pdf != '') { ?>
                                <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $productDetail_download_btn ?></a>
                            <?php } ?>
                        </div>

                    </div>
                </div>

                <div class="tab-content-wrap product-detail">
                    <?php
                    $detailArray = [];
                    $contentArray = json_decode($post->post_content, true);
                    foreach ($contentArray as $key => $item) {
                        if ($item['content'] !== '') {
                            $detailArray[$key]['tabName'] = $item['tabName'];
                            $detailArray[$key]['content'] = $item['content'];
                        }
                    }
                    ?>
                    <div class="gm-sep tab-title-bar detail-tabs">
                        <?php foreach ($detailArray as $key => $item) { ?>
                            <h2 class="tab-title  title <?php if ($key == 0) echo 'current'; ?> "><span><?php echo $item['tabName']; ?></span></h2>
                        <?php } ?>
                    </div>

                    <div class="tab-panel-wrap mb0">
                        <div class="tab-panel disabled">
                            <div class="tab-panel-content entry">
                                <div class="fl-rich-text">
                                    <?php if (count($detailArray) != 1) { ?>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <?php foreach ($detailArray as $key => $item) { ?>
                                                <?php if ($key == 0) { ?>
                                                    <li role="presentation" class="active">
                                                        <a href="#detail_tab<?php echo $key ?>" aria-controls="product-tab" role="tab" data-toggle="tab"><?php echo $item['tabName']; ?></a>
                                                    </li>
                                                <?php } else { ?>
                                                    <li role="presentation">
                                                        <a href="#detail_tab<?php echo $key ?>" aria-controls="product-tab" role="tab" data-toggle="tab"><?php echo $item['tabName']; ?></a>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php foreach ($detailArray as $key => $item) { ?>
                                                <?php if ($key == 0) { ?>
                                                    <div role="tabpanel" class="tab-pane active" id="detail_tab<?php echo $key ?>">
                                                        <?php echo $item['content']; ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div role="tabpanel" class="tab-pane" id="detail_tab<?php echo $key ?>"><?php echo $item['content']; ?></div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active">
                                                <?php echo $detailArray[0]['content']; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 上一篇/下一篇 -->
                <div>
                    <?php get_prev_or_next_post('prev_post', 'prev', 'Previous: ', 'no prev product'); ?>
                    <?php get_prev_or_next_post('next_post', 'next', 'Next: ', 'no next product'); ?>
                </div>

                <?php if (!empty($tags_title)) { ?>
                    <div class="single-tags">
                        <h1><?php echo $tags_title ?></h1>
                        <?php get_template_part('templates/components/tags-random-category') ?>
                    </div>
                <?php } else { ?>
                    <?php get_template_part('templates/components/tags-random-category') ?>
                <?php } ?>

                <!-- inquiry form -->
                <?php get_template_part('templates/components/sendMessage'); ?>

                <!-- RELATED PRODUCTS -->
                <?php get_template_part('templates/components/related-products') ?>


            </div>
        </div>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer') ?>
    </div>
</body>
<?php get_footer() ?>

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

<script>
    function toView(img) {
        $('.product-image img').attr('src', img);
    }


    imageLi = $('.mobile-image-additional ul li:first-child').width();
    imageLen = $('.mobile-image-additional ul li').length;
    var imageView = $('.mobile-image-additional ul');

    var flag = true

    function move(dir) {
        if (!flag) return
        if (dir == 'L' && $('.mobile-image-additional .left-btn').hasClass('disabled')) return
        if (dir == 'R' && $('.mobile-image-additional .right-btn').hasClass('disabled')) return
        flag = false

        // 移动
        var current = parseInt($('.mobile-image-additional ul').css('left'))
        if (dir == 'L') {
            current += imageLi;
            $('.mobile-image-additional .right-btn').removeClass('disabled')
        } else {
            current -= imageLi;
            $('.mobile-image-additional .left-btn').removeClass('disabled')
        }
        imageView.css('left', current + 'px')
        // 是否上锁
        if (current == 0) {
            $('.mobile-image-additional .left-btn').addClass('disabled')
        }
        if (current == -imageLi * (imageLen - 1)) {
            $('.mobile-image-additional .right-btn').addClass('disabled')
        }

        setTimeout(function() {
            flag = true
        }, 1000)
    }
</script>


</html>