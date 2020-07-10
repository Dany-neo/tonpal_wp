<?php
$category = get_category($cat);
$the_category_name = $category->name; //当前分类名称

if (have_posts()) {
    $product_item = [];
    $news_item = [];

    while (have_posts()) {
        the_post();
        $category = get_the_category();
        $cid = $category[0]->cat_ID;
        $pid = get_category_root_id($cid);
        $the_slug = get_category($pid)->slug;
        if ($the_slug == 'product') {
            $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true);
            $post->thumbnail = $thumbnail;
            array_push($product_item, $post);
        }
    }
}
?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <title><?php echo $the_category_name; ?></title>
    <?php get_template_part('templates/components/head'); ?>
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
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aisde end -->

                <!-- main begin -->
                <section class="main">
                    <header class="main-tit-bar">
                        <h1 class="title" style="text-transform:uppercase"><?php echo 'Search Results'; ?></h1>
                    </header>
                    <!-- product list -->
                    <?php if ($product_item != []) { ?>
                        <div class="items_list 1">
                            <ul>
                                <?php foreach ($product_item as $item) { ?>
                                    <li class="product_item">
                                        <figure>
                                            <span class="item_img">
                                                <a href="<?php the_permalink() ?>"> </a>
                                                <img src="<?php echo $item->thumbnail; ?>" alt="<?php echo $item->post_title; ?>">
                                            </span>
                                            <figcaption>
                                                <h3 class="item_title">
                                                    <a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a>
                                                </h3>
                                            </figcaption>
                                        </figure>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <div class="items_list 2">
                            <ul>
                                <li class="product_item">
                                    No Products!
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                    <?php get_template_part('templates/components/send-message'); ?>
                </section>
                <!--// main end -->
                <div class="clear"></div>
            </div>
        </div>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>

</html>