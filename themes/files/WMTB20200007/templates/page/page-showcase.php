<?php
// showcase.json -> vars 数据获取
$theme_vars = json_config_array('showcase', 'vars');

// Array 数据处理
$showcase_item = ifEmptyArray($theme_vars['items']['value']);
// Text 数据处理
$showcase_title = ifEmptyText($theme_vars['title']['value'], 'showcase');
$showcase_desc = ifEmptyText($theme_vars['desc']['value'], 'This is desc');

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'], "$showcase_title");
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
        @media only screen and (max-width: 950px) {
            .page-showcase-ul {
                padding-top: 30px;
            }

            .page-showcase-ul>ul {
                column-count: auto;
                padding: 0 10px;
            }

            .page-showcase-ul .product-item {
                margin-bottom: 20px;
            }

            .tab-panel-wrap {
                padding-bottom: 0;
            }
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
        <div class="main_content page-showcase">
            <div class="layout">
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $showcase_title ?></h1>
                </header>

                <div class="items_list page-showcase-ul">
                    <ul class="gm-sep">
                        <?php foreach ($showcase_item as $item) { ?>
                            <li class="product-item">
                                <figure class="item-wrap">
                                    <a href="javascript:;" rel='<?php echo ifEmptyText($item['title']) ?>' title="<?php echo ifEmptyText($item['title']) ?>" class="item-img certificate-fancy">
                                        <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title']) ?>" />
                                    </a>
                                    <figcaption class="item-info">
                                        <h3 class="item_title"><?php echo ifEmptyText($item['title']) ?></h3>
                                        <p><?php echo ifEmptyText($item['desc']) ?></p>
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

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>


<script>
    $('body').append(`
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
    <div id="image_shadow">
        <div class="content"><a href="javascript:;"></a><img src="" alt=""></div>
    </div>
    `);
    // 弹出 
    $('body').on('click', '.item-wrap img', function() {
        let src = $(this).attr('src')

        // 显示遮罩层
        $('#image_shadow').show()
        $('#image_shadow img').attr('src', src)
    })
    // 关闭
    $('body').on('click', '#image_shadow a', function() {
        $('#image_shadow').hide()
    })
</script>