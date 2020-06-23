<?php


// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts', 'vars');
$theme_widgets_footer = json_config_array('footer', 'widgets', 1);

//Text 数据处理
$contacts_desc = ifEmptyText($theme_vars['desc']['value']);
set_query_var('contactsDesc', $contacts_desc);

$phone = ifEmptyArray($theme_widgets_footer['tel']['vars']['items']['value']);
$mobile = ifEmptyArray($theme_widgets_footer['mobile']['vars']['items']['value']);
$email = ifEmptyArray($theme_widgets_footer['email']['vars']['items']['value']);
$address = ifEmptyArray($theme_widgets_footer['address']['vars']['items']['value']);

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
        @media only screen and (max-width: 950px) {
            .left-form {
                width: 100%;
            }

            .page-contacts .blog-article .ct-inquiry-form {
                width: 100%;
            }

            .page-contacts .main_content {
                padding-bottom: 0;
            }
        }
    </style>

</head>

<body>
    <div class="container page-contacts">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->
        <!-- path -->
        <?php get_breadcrumbs(); ?>
        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <!-- main begin -->
                <article class="blog-article">
                    <div class="left-form">
                        <?php get_template_part('templates/components/sendMessage') ?>
                    </div>

                    <div class="right">
                        <?php if (!empty($contacts_desc)) { ?>
                            <p><?php echo $contacts_desc ?></p>
                        <?php } ?>
                        <ul class="contacts-ul">
                            <?php if (!empty($email)) { ?>
                                <li class="email">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/1-1.png" alt="">
                                    <?php foreach ($email as $item) { ?>
                                        <span><?php echo $item['value'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                            <?php if (!empty($phone)) {  ?>
                                <li class="phone">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/1-3.png" alt="">
                                    <?php foreach ($phone as $item) { ?>
                                        <span><?php echo $item['value'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                            <?php if (!empty($mobile)) {  ?>
                                <li class="mobile">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/1-2.png" alt="">
                                    <?php foreach ($mobile as $item) { ?>
                                        <span><?php echo $item['value'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                            <?php if (!empty($address)) {  ?>
                                <li class="address">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/1-4.png" alt="">
                                    <?php foreach ($address as $item) { ?>
                                        <span><?php echo $item['value'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                </article>
                <!--// main end -->
                <?php get_template_part('templates/components/tags-random-category') ?>
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