<?php

$carousel_vars = get_query_var('home_carousel');

if ($carousel_vars['display'] == 1) {
?>
    <section class="slider_banner">
        <div class="swiper-wrapper">
            <?php foreach ($carousel_vars['vars']['items']['value'] as $item) { ?>
                <div class="swiper-slide"><a href=""> <img src="<?php echo $item['image'] ?>" alt="" /></a></div>
            <?php } ?>
        </div>
        <div class="index-swiper-buttons">
            <div class="swiper-button-prev swiper-button-white"><span class="slide-page-box"></span></div>
            <div class="swiper-button-next swiper-button-white"><span class="slide-page-box"></span></div>
        </div>
        <div class="slider_swiper_control">
            <div class="swiper-pagination swiper-pagination-white"></div>
        </div>
    </section>

<?php } ?>