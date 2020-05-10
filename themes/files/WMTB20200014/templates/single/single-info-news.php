<?php
global $wp; // Class_Reference/WP 类实例

$category = get_the_category()[0];

$post = get_post();

// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

// 当前页面url
$page_url = get_lang_page_url();


$tags_array = [];
$exclude = array($post->ID); // 需要排除的id
$res_post = [];
foreach ($the_tags as $item ) { // 取出所有的tag的term_id
    array_push($tags_array,$item->term_id);
}
for ($i = 0; $i < count($tags_array); $i += 1 ) { // 循环所有的tag的term_id
    $related_posts = get_tags_relevant_product($tags_array[$i], $exclude,'info-news',5); // 根据tag的term_id获取相关产品
    $post_count = count(ifEmptyArray($related_posts)); // 统计获取到的产品数量
    if ($post_count > 0 && $post_count < 5) { // 当统计数在(1,5)时进入下一环节
        $num = 5 - $post_count; // 计算出需要补足的数量
        foreach( $related_posts as $item ) { // 将已获取的产品的id放入排除数组中
            array_push($exclude,$item->ID);
        }
        $recent_posts = get_category_new_product('info-news', $exclude, $num,'OBJECT'); // 获取需要补充的产品
        $res_post = array_merge($related_posts, $recent_posts); // 合并
        break;
    } elseif ($post_count == 5) { // 当计数为5时，已满足条件
        $res_post = $related_posts;
        break;
    }
}
if (empty($res_post)) { // 防止tags搜索不到数据时，补足五条
    $res_post = get_category_new_product('info-news', $exclude, 5, 'OBJECT');
}

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url;?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .main {
            width: 100%;
        }
    </style>
</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_header()?>
    <!--// header end  -->
    <!-- path -->
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <section class="web_main page_main">
        <div class="layout news">
            <!-- main begin -->
            <section class="main">
                <div class="news-title border-bottom-2 mb-10">
                    <h1><?php echo $post->post_title ?></h1>
                </div>
                <div class="news-time mb-10"><?php echo $post->post_date; ?></div>
                <div class="iframe-box">
                    <iframe src="/rec-product" style="width:100%;" frameborder="no" scrolling="no"></iframe>
                </div>
                <?php get_template_part( 'templates/components/sendMessage' )?>
                <article>
                    <section class="mt15">
                        <?php echo $post->post_content ?>
                    </section>
                </article>
                <!--// 当前tags -->
                <?php get_info_tags('single',$post->ID); ?>
                <div class="chapter underline">
                    <?php
                    // prev
                    get_prev_or_next_post('prev','prev','Prev : ','This is the last news.');
                    // next
                    get_prev_or_next_post('next','next','Next : ','This is the latest news.');
                    ?>
                </div>
                <?php if ( !empty($res_post) ) { ?>
                    <div class="goods-title-bar">
                        <h2 class="title">RELATED PRODUCTS</h2>
                    </div>
                    <div class="blog_list">
                        <ul>
                            <?php foreach ($res_post as $item) { ?>
                                <li class="post-item border-bottom-2">
                                    <figure class="item-wrap">
                                        <figcaption class="item-info">
                                            <h3 class="item-title"><a href="<?php get_permalink($item->ID); ?>" class="title-link"><?php echo $item->post_title; ?>/a><a class="button" href="<?php get_permalink($item->ID); ?>">Send Inquiry Now</a></h3>
                                            <time datetime="<?php echo $item->post_date; ?>"><?php echo $item->post_date; ?></time>
                                            <div class="item-detail"><?php echo $item->post_excerpt; ?></div>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php get_info_tags('',$category->term_id); ?>

            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// main_content end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' )?>
</div>
</body>
<?php get_footer() ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
<script>
    $('.iframe-box iframe').eq(0).on('load',() => {
        $('.iframe-box iframe').eq(0).height($('.iframe-box iframe')[0].contentDocument.body.offsetHeight)
    })
</script>
</html>
