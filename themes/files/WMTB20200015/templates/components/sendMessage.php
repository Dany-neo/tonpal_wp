<?php
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header','vars',1);
$data = get_post();
$type_title = $data->post_name;

$message_title = ifEmptyText($theme_vars['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars['sendMessagePlaContent']['value']);

?>

<section class="mt-15 inquiry-form-box" id="myform" >
    <h4 class="inquiry-form-title" ><?php echo $message_title ?></h4>
    <div class="inquiry-form-border mb-20">
        <i></i>
    </div>
    <form id="contact-form" role="form">
        <section class="inquiry-form">
            <ul>
                <div class="form-left">
                    <li class="form-item">
                        <input id="name" type="text" name="name" placeholder="<?php echo $placeholder_name ?>" class="form-input form-input-name">
                    </li>
                    <li class="form-item">
                        <input id="phone" type="tel" name="phone" placeholder="<?php echo $placeholder_phone ?>" class="form-input form-input-phone">
                    </li>
                    <li class="form-item">
                        <input id="email" type="email" name="email" placeholder="<?php echo $placeholder_email ?>" class="form-input form-input-email">
                    </li>
                </div>
                <div class="form-right">
                    <li class="form-item">
                        <textarea id="message" name="message" placeholder="<?php echo $placeholder_content ?>" class="form-text form-input-massage"></textarea>
                    </li>
                </div>
            </ul>
            <div class="form-btn-wrapx">

                <input type="hidden" name="product_title" value="<?php echo $type_title;?>">
                <div class="alert-success hidden" id="MessageSent">
                    We have received your message, we will contact you very soon.
                </div>
                <div class="alert-danger hidden" id="MessageNotSent">
                    Oops! Something went wrong please refresh the page and try again.
                </div>
                <input type="submit" id="customer_submit_button" value="<?php echo $message_btn;?>"
                       class="wpcf7-form-control wpcf7-submit form-btn-submitx"/>
            </div>
        </section>
    </form>
</section>