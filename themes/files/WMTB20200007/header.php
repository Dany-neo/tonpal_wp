<?php
global $wp; // Class_Reference/WP 类实例
$languages = get_languages();
$languagesArray = [];
foreach ($languages as $item) {
    $name = $item['e_name'];
    $link = '/' . $item['abbr'];
    array_push($languagesArray, array('name' => $name, 'link' => $link, 'abbr' => $item['abbr']));
}
set_query_var('languagesArray', $languagesArray);

// header.json -> vars 数据获取
$theme_vars = json_config_array('header', 'vars', 1);

$header_logo = ifEmptyText($theme_vars['logo']['value']);
?>


<header class="web_head index_web_head">
    <div class="head_top">
        <div class="layout">
            <figure class="logo">
                <a href="<?php echo get_lang_home_url() ?>">
                    <img src="<?php echo $header_logo ?>" alt="">
                </a>
            </figure>
        </div>
    </div>

    <div class="head_layer">
        <div class="layout">
            <!-- 顶部导航 -->
            <nav class="nav_wrap">
                <?php if (has_nav_menu('primary')) : ?>
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
                <?php endif; ?>
            </nav>

            <div class="head_right">
                <b id="btn-search" class="btn--search"></b>
                <?php if ($languagesArray != []) { ?>
                    <div class="change-language ensemble">
                        <div class="change-language-title medium-title">
                            <div class="language-flag language-flag-en"><a title="English" href="javascript:;"> <b class="country-flag"></b> <span>English</span> </a> </div>
                        </div>

                        <div class="change-language-cont sub-content"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</header>

<div class="web-search"> <b id="btn-search-close" class="btn--search-close"></b>
    <div style=" width:100%">
        <div class="head-search">
            <form class="" action="/">
                <input class="search-ipt" name="s" placeholder="Search..." />
                <input class="search-btn" type="button" />
                <span class="search-attr">Hit enter to search or ESC to close</span>
            </form>
        </div>
    </div>
</div>

<?php if ($languages !== [] && $languagesArray !== []) { ?>
    <ul class="prisna-wp-translate-seo" id="prisna-translator-seo">
        <?php foreach ($languagesArray as $item) { ?>
            <li class="language-flag language-flag-en">
                <a title="<?php echo $item['abbr'] ?>" href="<?php echo $item['link'] ?>">
                    <b class="country-flag"></b>
                    <span><?php echo $item['abbr'] ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>