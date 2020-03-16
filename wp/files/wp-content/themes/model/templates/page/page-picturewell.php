<?php
// picturewell.json -> vars 数据获取
$theme_vars = json_config_array('picturewell','vars');

// Array 数据处理
$picturewell_item = ifEmptyArray($theme_vars['item']['value']);
$item_count = count($picturewell_item);
// Text 数据处理
$picturewell_title = ifEmptyText($theme_vars['title']['value'],'picturewell');
$picturewell_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$picturewell_desc = ifEmptyText($theme_vars['desc']['value'],'This is desc');
$picturewell_null_tip = ifEmptyText($theme_vars['nullTip']['value'],'No Picturewell');

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$picturewell_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_description; ?>" />
    <meta name="description" content="<?php echo $seo_keywords; ?>" />

    <?php get_template_part('templates/components/head'); ?>
</head>

<body>
<!-- header -->
<?php get_header() ?>
<!-- header -->


<main>
    <!-- page title -->
    <section class="page-title-section overlay" data-background="<?php echo $picturewell_bg; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php get_breadcrumbs();?>
                    <p class="text-lighten"><strong><?php echo $picturewell_desc; ?></strong></p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- blogs -->
    <section class="section">
        <div class="container">
            <?php if ( $item_count >= 1 ) { ?>
                <div class="row">
                    <?php foreach ($picturewell_item as $item ) {  ?>
                        <article class="col-lg-4 col-sm-6 mb-5">
                            <div class="">
                                <figure>
                                    <?php echo $item['iframe']; ?>
                                </figure>
                                <div class="">
                                    <p class=""><?php echo $item['iframe']; ?></p>
                                </div>
                            </div>
                        </article>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="no-product"><?php echo $picturewell_null_tip; ?></div>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- /blogs -->
</main>
<?php get_template_part( 'templates/components/footer' ); ?>

</body>

<?php get_footer(); ?>
</html>

