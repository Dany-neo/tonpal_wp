<script src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/common.js"></script>
<script>
    // 解决导航移入bug
    $('.head_nav a').each(function() {
        var text = $(this).text()
        $(this).html(`<em>${text}</em>`)

        if ($(this).parent().find('ul').length != 0) {
            $(this).append('<b></b>')
        }
    });


    // ====================页面切换，保留hover====================
    // 染色标志
    var zsjFlag = true
    // 1.点击染色
    $('.head_nav li').on('click', function() {
        window.localStorage.setItem('pageId', $(this).attr('id'))
    })
    $(function() {
        // 找一级 父链接
        var zsj = function(ele) {
            if (ele.parent().hasClass('head_nav')) {
                return ele
            }
            return zsj(ele.parent())
        }
        var pageId = window.localStorage.getItem('pageId')
        if (pageId == null) return

        var target = zsj($(`#${pageId}`))

        var pageUrl = '/' + (window.location.href).replace('http://', '').replace('https://', '').split('/')[1] || '/'
        if (pageUrl != target.find('a').attr('href')) return
        target.css('backgroundColor', '#ffaa00')
        zsjFlag = false
    });
    // 2. 根据面包屑染色
    $(function() {
        if (zsjFlag) {
            var url = $('.path_bar ul li:nth-child(2)').find('a').attr('href')
            $(`.head_layer .head_nav a[href="${url}"]`).parent().css('backgroundColor', '#ffaa00')
        }
    });


    // ======================表单校验======================
    // ===失去焦点
    $('body').on('blur', '.inquiry-form .form-item input,.inquiry-form .form-item textarea', function() {
        if ($(this).val() == '') {
            $(this).parent().find('span').addClass('warning')
        } else {
            $(this).parent().find('span').removeClass('warning')
        }
    })
    // ===提交按钮
    $('body').on('click', '#customer_submit_button', function() {
        var flag = true
        $('.inquiry-form .form-item').each(function(i, ele) {
            var text = ''
            if ($(ele).find('input').length != 0) text = $(ele).find('input').val()
            else text = $(ele).find('textarea').val()

            if (text == '') {
                $(ele).find('span').addClass('warning')
                flag = false
            }
        })

        if (!flag) return

        // 发送ajax
        var aop_param = {};
        aop_param.product_title = $("#product_title").val();
        aop_param.contact_name = $("#name").val();
        aop_param.contact_email = $("#email").val();
        aop_param.contact_subject = $("#phone").val();
        aop_param.contact_comment = $("#message").val();
        aop_param.organization_id = $("#organization_id").val();

        if (location.href.indexOf('?') > -1) {
            aop_param.reference = location.href.split('?')[0];
        } else {
            aop_param.reference = location.href;
        }
        $.ajax({
            url: "//tonpal.aiyongbao.com/action/savemessage",
            dataType: 'jsonp',
            type: 'GET',
            data: aop_param,
            success: function(rsp) {
                alert('Sent successfully');
                $("#customer_submit_button").removeAttr("disabled");
                location.reload();
            },
            error: function(rsp, textStatus, errorThrown) {
                $("#customer_submit_button").removeAttr("disabled");
                alert('error');
            }
        });
    })
</script>