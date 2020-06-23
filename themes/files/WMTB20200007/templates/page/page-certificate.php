<?php
// certificate.json -> vars 数据获取
$theme_vars = json_config_array('certificate', 'vars');

// Array 数据处理
$picturewell_item = ifEmptyArray($theme_vars['items']['value']);
// Text 数据处理
$picturewell_title = ifEmptyText($theme_vars['title']['value'], 'certificate');

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <?php get_template_part('templates/components/head'); ?>
    <style>
        /* 图片遮罩 */
        #image_shadow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #101010;
            opacity: 0.9;
            cursor: pointer;
            z-index: 1000;
            display: none;
        }

        #image_shadow .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            border-width: 10px;
            width: 1024px;
            height: 683px;
            background-color: #fff;
            padding: 10px;
            border-radius: 3px;
            opacity: 1;
        }

        #image_shadow .content a {
            position: absolute;
            top: -15px;
            right: -15px;
            z-index: 1002;
            width: 30px;
            height: 30px;
            background: transparent url("<?php echo get_template_directory_uri() ?>/assets/images/fancybox.png") -40px 0px;
        }

        #image_shadow .content img {
            height: 100%;
            width: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->

        <!-- path -->
        <?php get_breadcrumbs(); ?>
        
        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $picturewell_title ?></h1>
                </header>

                <div class="items_list page-certificate">
                    <ul class="gm-sep">
                        <?php foreach ($picturewell_item as $item) { ?>
                            <li class="product_item">
                                <figure class="item-wrap">
                                    <span class="item-img item_img">
                                        <a href="<?php echo ifEmptyText($item['image']) ?>" rel="<?php echo ifEmptyText($item['title']) ?>" title="<?php echo ifEmptyText($item['title']) ?>"></a>
                                        <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title']) ?>" />
                                        <span class="ck certificate-fancy"><i style="background-image:url(<?php echo get_template_directory_uri() . '/assets/images/ceerificate-open.png' ?>)"></i> </span>
                                    </span>

                                    <figcaption class="item-info">
                                        <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                    </figcaption>
                                </figure>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <?php get_template_part('templates/components/tags-random-category') ?>

                <?php get_template_part('templates/components/sendMessage') ?>

            </div>
        </div>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>
<div id="image_shadow">
    <div class="content"><a href="javascript:;"></a><img src="" alt=""></div>
</div>
<?php get_footer(); ?>

<script>
    // 弹出
    $('body').on('click', '.product_item .item_img .certificate-fancy', function() {
        let src = $(this).prev().attr('src')
        $('#image_shadow').show()
        $('#image_shadow img').attr('src', src)
    })
    // 关闭
    $('#image_shadow a').on('click', function() {
        $('#image_shadow').hide()
    })
</script>

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>