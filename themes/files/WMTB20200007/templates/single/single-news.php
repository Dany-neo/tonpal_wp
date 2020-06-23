<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();

// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID, 'seo_title', true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID, 'seo_description', true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID, 'seo_keywords', true));

// 当前页面url
$page_url = get_lang_page_url();

$theme_vars = json_config_array('header', 'vars', 1);
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

    <?php get_template_part('templates/components/head') ?>
    <style>
        .main-tit-bar {
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }

        .main-tit-bar .title::after {
            display: none;
        }

        .main-tit-bar .title {
            border-bottom: 1px solid #c5c5c5;
        }

        .main-tit-bar time {
            display: block;
            margin-top: 18px;
            font-size: 14px;
            color: #444;
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
                    <h1 class="title"><?php echo $post->post_title ?></h1>
                    <time><?php echo $post->post_date; ?></time>
                </header>

                <article class="entry blog-article">
                    <section class="mt15">
                        <?php echo $post->post_content ?>
                    </section>
                </article>

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
                <?php } ?>

                <!-- RELATED PRODUCTS -->
                <?php get_template_part('templates/components/related-products') ?>

                <!-- inquiry form -->
                <?php get_template_part('templates/components/sendMessage'); ?>

                <?php get_template_part('templates/components/tags-random-category') ?>
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
    // 新闻详情 多了一级面包屑
    $($('.path_bar ul li')[2]).hide()
</script>

</html>