$(function () {
    H_login = {};
    H_login.openLogin = function(){
        $('.nav_ss a').click(function(){
            $('.login').show();
            $('.login-bg').show();
        });
    };
    H_login.closeLogin = function(){
        $('.close-login').click(function(){
            $('.login').hide();
            $('.login-bg').hide();
        });
    };
    H_login.run = function () {
        this.closeLogin();
        this.openLogin();
        //this.loginForm();
    };
    H_login.run();
});

//写游记页面 文字显示全部/收起功能
(function($){
    $.fn.moreText = function(options){
        var defaults = {
            maxLength:50,
            mainCell:".branddesc",
            openBtn:'全文',
            closeBtn:'收起'
        }
        return this.each(function() {
            var _this = $(this);

            var opts = $.extend({},defaults,options);
            var maxLength = opts.maxLength;
            var TextBox = $(opts.mainCell,_this);
            var openBtn = opts.openBtn;
            var closeBtn = opts.closeBtn;

            var countText = TextBox.html();
            var newHtml = '';
            if(countText.length > maxLength){
                newHtml = countText.substring(0,maxLength)+'...<span class="more">'+openBtn+'</span>';
            }else{
                newHtml = countText;
            }
            TextBox.html(newHtml);
            TextBox.on("click",".more",function(){
                if($(this).text()==openBtn){
                    TextBox.html(countText+' <span class="more">'+closeBtn+'</span>');
                }else{
                    TextBox.html(newHtml);
                }
            })
        })
    }
})(jQuery);
//写游记评论页面 文字显示全部/收起功能



