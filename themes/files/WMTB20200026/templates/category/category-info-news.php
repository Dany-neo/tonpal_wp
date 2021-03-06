<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例

$more_btn = 'Read More';

$category = get_category($cat);

// SEO
$seo_title = ifEmptyText(get_term_meta($cat, 'seo_title', true));
$seo_description = ifEmptyText(get_term_meta($cat, 'seo_description', true));
$seo_keywords = ifEmptyText(get_term_meta($cat, 'seo_keywords', true));

$paged = get_query_var('paged');
$max = intval($wp_query->max_num_pages);

// 当前页面url
$get_full_path = get_full_path();
$page_url = $get_full_path . get_category_link($category->term_id);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />

    <?php if ($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts(); ?>" />
    <?php } ?>
    <?php if ($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>
    <?php get_template_part('templates/components/head'); ?>
    <style>
        .main {
            width: 100%;
        }
        .tab-panel-content a{color:#333;}
        .tab-panel-content a:hover {
            color: #b7045f;
        }
        .main .tab-panel-content.post-tags{padding-top:0; padding-bottom: 10px;}
        .main .tab-panel-content.post-tags a{margin-right: 15px;}
    </style>
</head>

<body>
<!-- header start -->
<?php get_header() ?>
<!--// header end  -->
<!-- path -->
<?php get_breadcrumbs();?>
<!-- main_content start -->
<section class="layout main_content">
    <!-- main begin -->
    <section class="main">

        <div class="blog_list">
            <?php if ( have_posts() ) { ?>
                <ul>
                    <?php while ( have_posts() ) : the_post();   ?>
                        <li class="blog-item">
                            <figure class="item-wrap">
                                <figcaption class="item-info">
                                    <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <time datetime="<?php echo esc_html( get_the_date() ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                    <div class="item-detail limit-3-line"><?php the_excerpt(); ?></div>
                                    <a href="<?php the_permalink(); ?>" class="item-more" style="margin-top: 10px;"><?php echo $more_btn; ?></a>
                                </figcaption>
                            </figure>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <?php wpbeginner_numeric_posts_nav(); ?>
            <?php } ?>
        </div>
        <?php get_info_tags('',$category->term_id); ?>
    </section>
</section>
<!--// main_content end -->
<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>
<!--  footer end -->
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>