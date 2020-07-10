<?php
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header', 'vars', 1);
$data = get_post();
$type_title = $data->post_name;

$message_title = ifEmptyText($theme_vars['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars['sendMessagePlaContent']['value']);

$contacts_desc = ifEmptyText(get_query_var('contactsDesc'));
?>

<div class="send-message">
    <div class="send-message-header">
        <div class="send-message-header-title"><?php echo  $message_title ?></div>
    </div>
    <div class="blog-grid  col-2 gutter-lg">
        <div class="send-message-content send-form">
            <div class="send-message-content-div send-form-item">
                <input type="text" class="form-control" name="name" id="name" placeholder="*<?php echo ucfirst($placeholder_name) ?>">
                <span>Username cannot be empty</span>
            </div>
            <div class="send-message-content-div send-form-item">
                <input type="email input-email" id="email" class="form-control" name="email" placeholder="*<?php echo ucfirst($placeholder_email) ?>">
                <span>Email cannot be empty</span>
            </div>
            <div class="send-message-content-div send-form-item">
                <input type="tel" class="form-control" id="phone" name='phone' placeholder="*<?php echo ucfirst($placeholder_phone) ?>">
                <span>Phone cannot be empty</span>
            </div>
            <div class="row send-form-item">
                <div class="send-message-content-div" style="min-height: 100px;width: 100%;">
                    <textarea class="form-control send-message-textarea" rows="4" id="message" placeholder="*<?php echo ucfirst($placeholder_content) ?>" id="message"></textarea>
                    <span>Message cannot be empty</span>
                </div>
            </div>
        </div>

        <input type="hidden" name="" id="reference" value="<?php echo get_lang_page_url() ?>">
        <input type="hidden" name="product_title" id="product_title" value="<?php echo $type_title; ?>">
        <div class="form-group text-left bt-certificate">
            <button class="btn btn-lg btn-dark bt-width send-message-btn" id="customer_submit_button"><?php echo $message_btn ?></button>
        </div>
    </div>
</div>

<style>
    .send-form .send-form-item span {
        display: none;
        height: 0;
        color: #f36161;
        padding-left: 5px;
        transform: scale(.8);
        transition: all .3s;
    }

    .send-form .send-form-item span.warning {
        display: block;
        height: auto;
        transform: scale(1);
    }

    .send-form .send-form-item textarea {
        resize: none
    }
</style>