<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'), 'Tag');

/*
if (is_category()) {
    $term_id = get_category($cat)->term_id;
} elseif (is_single()) {
    $term_id = ROOT_CATEGORY_CID;
}
$tags = get_random_tags($term_id, 5); // 随机获取当前分类的tags
if (ifEmptyArray($tags) !== []) { ?>
    <div class="tab-content-wrap product-detail">
        <div class="tab-panel-wrap tags-random-list">
            <div class="tab-panel-content ">
                <?php foreach ($tags as $item) { ?>
                    <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
*/


// 假数据填充
$tags = json_config_array('text', 'vars')['image']['value'];
if (ifEmptyArray($tags) !== []) { ?>
    <div class="tab-content-wrap product-detail">
        <div class="tab-panel-wrap tags-random-list">
            <div class="tab-panel-content">
                <?php foreach ($tags as $item) { ?>
                    <a href=""><?php echo $item['name'] ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
<?php }
?>