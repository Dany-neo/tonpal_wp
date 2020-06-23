<?php
// about.json -> vars 数据获取
$theme_vars = json_config_array('about', 'vars');

//Text 数据处理
$about_title = ifEmptyText($theme_vars['title']['value'], 'About');
$about_rich_text = ifEmptyText($theme_vars['richText']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <?php get_template_part('templates/components/head'); ?>
    <style>
        .ct-inquiry-form {
            margin: 20px 0 !important;
        }

        @media only screen and (max-width: 950px) {
            .tab-panel-wrap {
                padding-bottom: 0;
            }

            .ct-inquiry-form {
                margin-top: 0;
            }
        }
    </style>

</head>

<body>
    <div class="container page-about">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->

        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $about_title; ?></h1>
                </header>



                <article class="entry blog-article">
                    <section class="mt15">
                        <p><?php echo $about_rich_text; ?></p>
                    </section>

                    <?php get_template_part('templates/components/tags-random-category') ?>

                    <?php get_template_part('templates/components/sendMessage') ?>
                </article>
            </div>
        </div>
        <!--// main_content end -->


        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
        <!--  footer end -->
    </div>
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>