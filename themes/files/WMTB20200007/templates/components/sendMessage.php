<?php
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header', 'vars', 1);
$data = get_post();
$type_title = $data->post_name;

$message_bg = ifEmptyText($theme_vars['sendMessageBg']['value']);
$message_title = ifEmptyText($theme_vars['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars['sendMessagePlaContent']['value']);


$contacts_desc = ifEmptyText(get_query_var('contactsDesc'));
$contacts_desc = 'We have received your message, we will contact you very soon. We have received your message, we will contact you very soon.';
?>

<section class="inquiry-form-wrap ct-inquiry-form mt50" id="myform">
    <div class="send-bg">
        <img src="<?php echo $message_bg ?>" alt="">
    </div>
    <div class="send-content">
        <h4 class="inquiry-form-title" style="text-transform:uppercase"><?php echo $message_title ?></h4>
        <?php if (!empty($contacts_desc)) { ?>
            <p class="text-center contact-margin"><?php echo $contacts_desc ?></p>
        <?php } ?>
        <form id="contact-form" role="form">
            <section class="inquiry-form">
                <ul>
                    <li class="form-item">
                        <input id="name" type="text" name="name" class="form-input form-input-name" placeholder="<?php echo $placeholder_name ?>">
                        <span>Username cannot be empty</span>
                    </li>
                    <li class="form-item">
                        <input id="email" type="email" name="email" class="form-input form-input-email" placeholder="<?php echo $placeholder_email ?>">
                        <span>Email cannot be empty</span>
                    </li>
                    <li class="form-item">
                        <input id="phone" type="tel" name="phone" class="form-input form-input-phone" placeholder="<?php echo $placeholder_phone ?>">
                        <span>Phone cannot be empty</span>
                    </li>
                    <li class="form-item form-item-message">
                        <textarea id="message" name="message" class="form-text form-input-massage" placeholder="<?php echo $placeholder_content ?>"></textarea>
                        <span>Message cannot be empty</span>
                    </li>
                </ul>

                <div class="form-btn-wrapx">
                    <input type="hidden" name="" id="reference" value="<?php echo get_lang_page_url() ?>">
                    <input type="hidden" name="product_title" id="product_title" value="<?php echo $type_title; ?>">
                    <div id="customer_submit_button" class="wpcf7-form-control wpcf7-submit form-btn-submitx" style="cursor: pointer;user-select: none;"><?php echo $message_btn; ?></div>
                </div>
            </section>
        </form>
    </div>
</section>