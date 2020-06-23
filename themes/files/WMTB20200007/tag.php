<?php

/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
global $wp_query, $wp, $post;
$paged = get_query_var('paged');
$max = intval($wp_query->max_num_pages);
$tagName = single_tag_title('', false);
$tagName = str_replace("wmtbprefix", "", $tagName);
// 当前页面url
$page_url = get_lang_page_url();

?>
<!--nextpage-->



<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $tagName; ?><?php if ($paged > 1) printf('–%s', $paged); ?></title>

    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php if ($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts(); ?>" />
    <?php } ?>
    <?php if ($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>

    <?php get_template_part('templates/components/head'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <style>
        .index_tags .blog-item .item-detail {
            height: auto;
            padding-top: 10px;
        }

        @media only screen and (max-width: 950px) {
            .index_tags .items_list {
                padding-top: 5px;
            }

            .item-wrap {
                display: flex;
            }

            .item-wrap>a {
                flex: 0 0 50%;
            }

            .item-wrap figure {
                flex: 0 0 50%;
            }

            .blog-item .item-img {
                background-color: transparent;
            }

            .index_tags .blog-item .item-info {
                padding-left: 0;
            }

            .tags {
                display: none !important;
            }

            .mobile-tags {
                display: block !important;
            }

            .index_tags .blog-item {
                padding-bottom: 10px;
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
        <div class="main_content index_tags">
            <div class="layout">
                <header class="main-tit-bar tags-title">
                    <h1 class="title border"><?php echo $tagName; ?></h1>
                </header>

                <div class="items_list">
                    <?php if (have_posts()) { ?>
                        <ul>
                            <?php while (have_posts()) {
                                the_post();
                                $category = get_the_category();
                                $cid = $category[0]->cat_ID;
                                $pid = get_category_root_id($cid);
                                $the_slug = get_category($pid)->slug;
                                if ($the_slug == 'product') {
                                    $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true);
                                    $tags = get_the_tags($post->ID);

                            ?>
                                    <li class="blog-item">
                                        <figure class="item-wrap">
                                            <a href="<?php the_permalink()  ?>" class="item-img"><img src="<?php echo $thumbnail ?>_thumb_220x220.jpg" alt="<?php the_title(); ?>" />
                                                <!-- <span class='right_top_icon'><?php /*echo ucfirst($the_slug) . ' Info'*/ ?></span> -->
                                            </a>
                                            <figcaption class="item-info post-tags">
                                                <h3 class="item-title">
                                                    <a href="<?php the_permalink()  ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="item-detail"><?php the_excerpt(); ?></div>
                                                <div class="tags">
                                                    <?php foreach ($tags as $item) { ?>
                                                        <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name ?></a>
                                                    <?php } ?>
                                                </div>
                                            </figcaption>
                                        </figure>
                                        <div class="mobile-tags tags" style="display: none;">
                                            <?php foreach ($tags as $item) { ?>
                                                <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name ?></a>
                                            <?php } ?>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    <?php } ?>
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