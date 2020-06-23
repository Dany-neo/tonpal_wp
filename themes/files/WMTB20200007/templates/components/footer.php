<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array('footer', 'vars', 1);
$theme_widgets = json_config_array('footer', 'widgets', 1);

$footer_logo = ifEmptyText($theme_vars['footerLogo']['value']);
$footer_desc = ifEmptyText($theme_vars['footerDesc']['value']);

$footer_link_title = ifEmptyText($theme_vars['postsTitle']['value']);

$contact_title = ifEmptyText($theme_vars['contactTitle']['value']);
$address = ifEmptyArray($theme_widgets['address']['vars']['items']['value'][0]);
$tel = ifEmptyArray($theme_widgets['tel']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets['email']['vars']['items']['value'][0]);


$facebook_link = ifEmptyText($theme_vars['facebookLink']['value']);
$twitter_link = ifEmptyText($theme_vars['twitterLink']['value']);
$instagram_link = ifEmptyText($theme_vars['instagramLink']['value']);
$pinterest_link = ifEmptyText($theme_vars['pinterestLink']['value']);
$youtube_link = ifEmptyText($theme_vars['youtubeLink']['value']);

// $googleExtantion = get_option('google_extantion');
?>


<!-- web_footer start -->
<footer class="web_footer">
    <div class="foot_service">
        <div class="layout">
            <div class="foot_items">
                <nav class="foot_item wow fadeInLeftA" data-wow-delay=".1s" data-wow-duration=".8s">
                    <div class="footer_logo">
                        <img src="<?php echo $footer_logo ?>" alt="公司logo">
                    </div>
                    <p class="footer_desc"><?php echo $footer_desc ?></p>
                </nav>


                <nav class="foot_item wow fadeInLeftA" data-wow-delay=".2s" data-wow-duration=".8s">
                    <div class="foot_item_hd">
                        <h2 class="title"><?php echo $footer_link_title ?></h2>
                    </div>
                    <div class="foot_item_bd">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_class' => 'head_nav',
                                'container' => 'ul',
                                'container_class' => 'nav-current',
                            )
                        )
                        ?>
                    </div>
                </nav>

                <nav class="foot_item wow fadeInLeftA" data-wow-delay=".3s" data-wow-duration=".8s">
                    <div class="foot_item_hd">
                        <h2 class="title"><?php echo $contact_title ?></h2>
                    </div>
                    <div class="foot_item_bd">
                        <address class="foot_contact_list">
                            <ul>

                                <?php if ($tel['value'] !== null) { ?>
                                    <li class="contact_item">
                                        <i class="contact_ico contact_ico_phone"></i>
                                        <div class="contact_txt">
                                            <span class="contact_val"><a class="tel_link" href="tel:"><?php echo $tel['value'] ?></a></span>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if ($email['value'] !== null) { ?>
                                    <li class="contact_item">
                                        <i class="contact_ico contact_ico_email"></i>
                                        <div class="contact_txt">
                                            <span class="contact_val"><a href="mailto:"><?php echo $email['value'] ?></a></span>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if ($email['value'] !== null) { ?>
                                    <li class="contact_item">
                                        <i class="contact_ico contact_ico_local"></i>
                                        <div class="contact_txt">
                                            <span class="contact_val"><?php echo $address['value'] ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </address>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</footer>

<div class="foter_footer">
    <div class="layout">
        <div class="fl">
            <div class="foot_bar wow fadeInUpA" data-wow-delay=".2s" data-wow-duration=".8s">
                <div class="layout">
                    <div class="copyright"><?php echo $organization_name ?> Copyright &copy; <?php echo date('Y') ?> | <a href="/privacy_policy.html">Privacy Policy</a> | <a href="/sitemap.xml">Sitemap</a>
                        <?php if (get_category_by_slug('info-news')) print_r('|  <a href="/info-news">INFO NEWS</a>'); ?>
                        <?php if (get_category_by_slug('info-product')) print_r('|  <a href="/info-product">INFO PRODUCT</a>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="fr">
            <ul>
                <?php if ($facebook_link != '') { ?>
                    <li><a href="<?php echo $facebook_link ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/images/indexIcon/icon1.png" alt=""></a></li>
                <?php } ?>
                <?php if ($pinterest_link != '') { ?>
                    <li><a href="<?php echo $pinterest_link ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/images/indexIcon/icon2.png" alt=""></a></li>
                <?php } ?>
                <?php if ($twitter_link != '') { ?>
                    <li><a href="<?php echo $twitter_link ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/images/indexIcon/icon3.png" alt=""></a></li>
                <?php } ?>
                <?php if ($instagram_link != '') { ?>
                    <li><a href="<?php echo $instagram_link ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/images/indexIcon/icon4.png" alt=""></a></li>
                <?php } ?>
                <?php if ($youtube_link != '') { ?>
                    <li><a href="<?php echo $youtube_link ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/images/indexIcon/icon5.png" alt=""></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<!--// web_footer end -->