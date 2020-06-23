<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video', 'vars');

// Array 数据处理
$video_item = ifEmptyArray($theme_vars['item']['value']);

// Text 数据处理
$video_title = ifEmptyText($theme_vars['title']['value'], 'video');
$video_desc = ifEmptyText($theme_vars['desc']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'], "$video_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);

$page_data = $video_item;
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
        .items_list {
            padding-top: 50px;
        }

        .product-item.video-list {
            margin: auto;
        }

        .product-item.video-list .item-title {
            font-size: 16px;
            color: #2d2d2d;
            height: 50px;
            line-height: 50px;
            text-indent: 9px;
        }

        .product-item.video-list .item-img {
            width: 580px;
            height: 330px
        }

        @media only screen and (max-width: 950px) {
            .items_list {
                padding-top: 30px;
            }

            .product-item.video-list {
                width: 100%;
            }

            .product-item.video-list .item-img {
                width: 100%;
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
        <div class="main_content">
            <div class="layout">
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $video_title; ?></h1>
                </header>

                <div class="items_list" id="json_page_list">
                    <ul class="gm-sep current">
                        <?php $target = count($page_data);
                        for ($i = 0; $i < $target; $i++) {
                            $item = $page_data[$i]; ?>
                            <li class="product-item video-list">
                                <figure class="item-wrap">
                                    <div class="item-img">
                                        <?php echo $item['iframe'] ?>
                                    </div>
                                    <figcaption class="item-info">
                                        <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                    </figcaption>
                                </figure>
                            </li>
                        <?php if ($i > 0 && $i < $target - 1 && ($i + 1) % (jsonData_page_size()) == 0) {
                                echo '</ul><ul class="gm-sep">';
                            }
                        } ?>
                    </ul>
                </div>
                <?php get_jsonData_page(count($page_data)); ?>

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
<script>

</script>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

<script>
    // js版假的分页
    $('.json_page>ul>li').on('click', function() {
        var tar = $(this).attr('tar').trim()
        if (tar == 'home') {
            var first = $('.json_page [tar="1"]');
            if (first.hasClass('current') != true) page_action($('.json_page .current'), first)
        } else if (tar == 'last') {
            var last = $('.json_page li:nth-last-child(3)')
            if (last.hasClass('current') != true) page_action($('.json_page .current'), last)
        } else if (tar == 'previous') {
            page_action($('.json_page .current'), $('.json_page .current').prev())
        } else if (tar == 'next') {
            page_action($('.json_page .current'), $('.json_page .current + li'))
        } else {
            if ($(this).hasClass('current') != true) page_action($('.json_page .current'), $(this))
        }
    })

    function page_action(removeEle, addEle) {
        addEle.addClass('current')
        removeEle.removeClass('current');

        var tar = $('.json_page .current').attr('tar');
        if (tar == '1') {
            $('.json_page .j_previous').addClass('hide')
        } else {
            $('.json_page .j_previous').removeClass('hide')
        }

        $('#json_page_list > ul').removeClass('current');
        $(`#json_page_list > ul:nth-child(${tar})`).addClass('current')

        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

</html>