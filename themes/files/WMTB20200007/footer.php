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
    // 校验规则
    var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/
    // input 或 textarea
    validFun = function(ele) {
        var text = $(ele).val()
        var target = $(ele).parent().find('span')
        // 内容非空
        if (text == '') {
            target.addClass('warning')
            return
        }
        // 邮箱单独校验
        if ($(ele).attr('id') == 'email') {
            if (!reg.test(text)) target.html('Please enter the correct email').addClass('warning')
            else target.html('').removeClass('warning')
            return
        }
        target.removeClass('warning')
    }
    // 失焦自动校验
    $('body').on('blur', '.inquiry-form .form-item input,.inquiry-form .form-item textarea', function() {
        validFun(this);
    })
    // ===提交按钮
    $('body').on('click', '#customer_submit_button', function() {
        // 点击提交 手动校验
        $('.inquiry-form .form-item').each(function(i, item) {
            var ele = $(item).find('input')
            if (ele.length == 0) ele = $(item).find('textarea')
            validFun(ele);
        })
        if ($('.inquiry-form .form-item .warning').length !== 0) return

        // 发送ajax
        var aop_param = {};
        aop_param.product_title = $("#product_title").val();
        aop_param.name = $("#name").val();
        aop_param.email = $("#email").val();
        aop_param.phone = $("#phone").val();
        aop_param.message = $("#message").val();

        $.ajax({
            url: "/wp-json/portal/v1/inquiry",
            type: 'post',
            data: aop_param,
            success: function(rsp) {
                if (rsp.code != 1) {
                    $("#customer_submit_button").removeAttr("disabled");
                    alert('error');
                    return
                }
                $("#customer_submit_button").removeAttr("disabled");
            },
            error: function(rsp, textStatus, errorThrown) {
                $("#customer_submit_button").removeAttr("disabled");
                alert('error');
            }
        });
    })
</script>