<script type="text/javascript" src="//q.zvk9.com/Model27/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model27/assets/js/common.js"></script>

<script type="text/javascript" defer>
    /*小语种切换*/
    function changeLanguage(language_abbr) {
        var location_url = window.location.host;
        var location_path = window.location.pathname;
        var url_type = location_url.split('.')[0];
        var url_name = location_url.split('.')[1];
        var url_end = location_url.split('.')[2];
        if (language_abbr == "en" && url_type.length < 3) {
            window.location.href = '//www.' + url_name + "." + url_end;
        } else {
            var path_arr = location_path.split('/');
            if (path_arr[1] == language_abbr) {
                return;
            }
            var abbr = '';
            if (path_arr[1].length == 2) {
                if (language_abbr == 'en') {
                    path_arr.splice(1, 1)
                } else {
                    path_arr[1] = language_abbr;
                    abbr = "/" + language_abbr + "/"
                }
            } else {
                if (language_abbr == 'en') {
                    return;
                } else {
                    path_arr.splice(1, 0, language_abbr);
                    abbr = "/" + language_abbr + "/"
                }
            }
            location_path = path_arr.join('/');
            window.location.href = '//' + location_url + abbr
        }
    }

    // 解决导航移入bug
    $('.head_nav>li a').each(function() {
        var text = $(this).text()
        $(this).html(`<em style="vertical-align: middle;display: inline-block;position: relative;z-index: 1;">${text}</em>`)
    });

    // 导航栏 显示箭头
    $('.head_nav>li').each(function() {
        if ($(this).has('ul').length != 0) {
            $(this).addClass('has-child menu_left')
        }
    })

    // 展开 搜索框
    $('body').on('click', '.head-search img', function() {
        if ($('.head-search').hasClass('open')) {
            window.open("http://" + window.location.host + '/?s=' + $(".search-text").val())
        } else {
            $('.head-search').addClass('open')
        }
    })

    // 分页样式
    var pageBtns = $('.page_bar a')
    var eachTarget = [1, pageBtns.length - 2]
    eachTarget.forEach(function(i) {
        var text = $(pageBtns[i]).text().trim()
        if (text == 'PREVIOUS' || text == 'NEXT') {
            $(pageBtns[i]).css('width', '90px')
        }
    })

    // 产品页 顶部轮播
    $($('.product-view .image-items .image-item')[0]).addClass('current');
    $('.product-view .image-items .image-item').on('click', function() {
        $('.product-view .image-items .image-item').removeClass('current');
        $(this).addClass('current');
        $('.product-view .product-image img').attr('src', $(this).find('img').attr('src').trim())
    })

    // js版假的分页
    $('.json_page>ul>li').on('click', function() {
        var tar = $(this).attr('tar').trim()
        if (tar == 'home') {
            var first = $('.json_page [tar="1"]');
            if (first.hasClass('current') != true) page_action($('.json_page .current'), first)
        } else if (tar == 'last') {
            var last = $('.json_page li:nth-last-child(3)')
            if (last.hasClass('current') != true) page_action($('.json_page .current'), last)
        } else if (tar == 'previous') {
            page_action($('.json_page .current'), $('.json_page .current').prev())
        } else if (tar == 'next') {
            page_action($('.json_page .current'), $('.json_page .current + li'))
        } else {
            if ($(this).hasClass('current') != true) page_action($('.json_page .current'), $(this))
        }
    })

    function page_action(removeEle, addEle) {
        addEle.addClass('current')
        removeEle.removeClass('current');

        var tar = $('.json_page .current').attr('tar');
        if (tar == '1') {
            $('.json_page .j_previous').addClass('hide')
        } else {
            $('.json_page .j_previous').removeClass('hide')
        }

        $('#json_page_list > ul').removeClass('current');
        $(`#json_page_list > ul:nth-child(${tar})`).addClass('current')

        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    //移动端微调
    $('.head_nav .has-child>a').append('<b></b>')

    // 产品详情页移动端 (仅三张图片) 
    var imgEle = $('.single-product-main .product-view .certificate-fancy img')
    imgEle.attr('num', 0)

    function swiperSingleProductImage(dir) {
        var n = imgEle.attr('num')
        if ((dir == 'L' && n == 0) || (dir == 'R' && n == 2)) return;
        if (dir == 'L') {
            n = Number(n) - 1
        } else {
            n = Number(n) + 1
        }
        var src = $(`.product-view .image-additional li:nth-child(${n+1}) img`).attr('src')
        imgEle.attr('num', n).attr('src', src)
    }

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
    $('body').on('blur', '.send-form .send-form-item input,.send-form .send-form-item textarea', function() {
        validFun(this);
    })
    // ===提交按钮
    $('body').on('click', '#customer_submit_button', function() {
        // disabled类名 避免多次提交
        if ($(this).hasClass('disabled')) return

        // 点击提交 手动校验
        $('.send-form .send-form-item').each(function(i, item) {
            var ele = $(item).find('input')
            if (ele.length == 0) ele = $(item).find('textarea')
            validFun(ele);
        })
        if ($('.send-form .send-form-item .warning').length !== 0) return

        $(this).addClass('disabled')

        // 发送ajax
        var aop_param = {};
        aop_param.post_name = $("#product_title").val();
        aop_param.name = $("#name").val();
        aop_param.email = $("#email").val();
        aop_param.phone = $("#phone").val();
        aop_param.message = $("#message").val();
        aop_param.reference = $("#reference").val();


        $.ajax({
            url: "/wp-json/portal/v1/inquiry",
            type: 'post',
            data: aop_param,
            success: function(rsp) {
                if (rsp.code != 1) {
                    $("#customer_submit_button").removeClass("disabled");
                    alert('error');
                } else {
                    alert('Send successfully')
                    $("#customer_submit_button").removeClass("disabled");
                    location.reload();
                }
            },
            error: function(rsp, textStatus, errorThrown) {
                $("#customer_submit_button").removeClass("disabled");
                alert('error');
            }
        });
    })
</script>