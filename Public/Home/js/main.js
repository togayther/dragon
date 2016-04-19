
/* ==========================================================
 * 2015-11 @mcmurphy
 * ==========================================================*/

/* 
 * 配置相关
 * ==========================================================*/
var Configer = (function(){
    'use strict';

    var api = {
        loginApi : "../account/login",
        signinApi : "../account/signin"
    };

    return {
        api : api,
        signinPoint : signinPoint
    };
})();

/* 
 * 系统扩展
 * ==========================================================*/
(function($){
     String.prototype.trim = function() {
        return this.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
     };

     Date.prototype.format = function(fmt) { 
      var o = {   
        "M+" : this.getMonth()+1,        
        "d+" : this.getDate(),                
        "h+" : this.getHours(),               
        "m+" : this.getMinutes(),            
        "s+" : this.getSeconds(),               
        "q+" : Math.floor((this.getMonth()+3)/3), 
        "S"  : this.getMilliseconds()            
      };   
      if(/(y+)/.test(fmt))   
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));   
      for(var k in o)   
        if(new RegExp("("+ k +")").test(fmt))   
      fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));   
      return fmt;   
    };

    String.format = function () {
        var args = arguments;
        return args[0].replace(/\{(\d+)\}/g, function (m, i) { return args[i * 1 + 1]; });
    };

    $.extend({
        tipsBox: function (options) {
            options = $.extend({
                obj: null,
                str: "+1",
                startSize: "12px",
                endSize: "30px",
                interval: 600,
                color: "red",
                callback: function () { }
            }, options);
            $("body").append("<span class='num'>" + options.str + "</span>");
            var box = $(".num");
            var left = options.obj.offset().left + options.obj.width() / 2;
            var top = options.obj.offset().top - options.obj.height();
            box.css({
                "position": "absolute",
                "left": left + "px",
                "top": top + "px",
                "z-index": 9999,
                "font-size": options.startSize,
                "line-height": options.endSize,
                "color": options.color
            });
            box.animate({
                "font-size": options.endSize,
                "opacity": "0",
                "top": top - parseInt(options.endSize) + "px"
            }, options.interval, function () {
                box.remove();
                options.callback();
            });
        }
    });

})(jQuery);

/* 
 * 工具相关
 * ==========================================================*/
var Common = (function(){

    'use strict';

    //通用加载处理
    (function(){
        $.ajaxSetup({　　　　
            timeout: 3000,
            dataType: "json",
            cache: false,
            complete: function(xhr, status) {　　
                Common.spinner.remove();
            },
            beforeSend: function(xhr) {　　　　
                Common.spinner.make();
            } 　
        });
    })();

    (function(){
        window.onerror = function(mess,url,line){
            console.log("script error！message:"+mess+",line:"+line);
        };
    })();

    // 输入验证
    var validator = (function(){

        var phoneValidator = function(phone){
            if(!phone){ return false; }
            var regexp = /^(13[0-9]|147|15[0-9]|17[0-9]|18[0-9])\d{8}$/;
            return regexp.test(phone);
        };

        var ticketValidator = function(ticket){
            if (!ticket) { return false; }
            var regexp = /^[0-9]{4}$/;
            return regexp.test(ticket);
        };

        return {
            phoneValidator : phoneValidator,
            ticketValidator : ticketValidator
        };
    })();

    // 获取URL请求参数
    var getUrlParam = function(name) {
        var reg = new RegExp("(^|&|#|/?)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.href.substr(1).match(reg);
        if (r !== null) {
            var result = unescape(r[2]);
            if (result.indexOf('#') > 0) {
                result = result.slice(0, result.indexOf('#'));
            }
            return result;
        }
        return null;
    };

    //模板数据渲染
    //depend on doT.js
    var templateRender = function(tmpl, data){
        var renderContent = "";
        if(tmpl && data && doT){
            var tempContent = doT.template(tmpl);
            
            renderContent = tempContent(data);
        }
        return renderContent;
    };

    //添加动画
    //depend on animate.css
    var animateRender = function(target, animate){
        if(target && animate){
            target = $(target);
            target.addClass("animated "+ animate).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){
                target.removeClass("animated shake");
            });
        }
    };

    var __toastLast = null;
    //depend on jquery.toastr.js
    var makeToast = function(msg, type, timeout, position){
        if(msg){
            toastr.clear(__toastLast);
            type = type || "info";
            if (timeout) {
               if(timeout<0){
                    timeout = 5000000;
               }
            }else{
                timeout = 3000;
            }
            position = position || "toast-bottom-full-width";
            toastr.options = {
                positionClass : position,
                timeOut : timeout
            };
            __toastLast = toastr[type](msg);
        }
    };

    //显示加载
    //depend on spin.js
    var spinner = (function(){
        
        if(typeof Spinner =='undefined') return;

        var configer = {
          lines: 12, 
          length: 8, 
          width: 1, 
          radius: 10, 
          scale: 1.0, 
          corners: 1.0, 
          color: '#111', 
          opacity: 1/4, 
          rotate: 0, 
          direction: 1, 
          speed: 2, 
          trail: 100, 
          fps: 20, 
          zIndex: 2e9, 
          className: 'loading', 
          top: '50%', 
          left: '50%', 
          shadow: false, 
          hwaccel: false, 
          position: 'absolute'
        };

        var loading_element,
            loading_instance;

        var make = function(){
            if(!loading_element){
                loading_element = document.createElement("div");
                loading_element.id="loading";
                loading_element.style.display = "none";
                document.body.appendChild(loading_element);
                loading_instance = new Spinner(configer);
            }
            loading_element.style.display = "block";
            loading_instance.spin(loading_element);
        };

        var remove = function(){
            loading_element.style.display = "none";
            loading_instance.stop(loading_element);
        };
        return {
            make : make,
            remove : remove
        };
    })();


    //数据处理
    var dataEnginer = function(url, data, type) {
        if (!url) {  console.log("data url can not be empty!");  return; }
        var deferred = $.ajax({
            type: type || 'POST',
            url: url,
            data: data
        }).fail(function(){
            makeToast("网络连接失败，请重试。","error", -1);
        });

        return deferred;
    }; 

    return {
        getUrlParam : getUrlParam,
        templateRender : templateRender,
        animateRender : animateRender,
        validator : validator,
        makeToast : makeToast,
        dataEnginer : dataEnginer,
        spinner : spinner
    };
})();

/*
 * 系统相关
 * ==========================================================*/
var App = (function(){

    'use strict';

    /*
     * 登录处理
     ========================================================*/
    var loginHandle = function(){
        var btnLogin = $("#btn-login");
        if (btnLogin && btnLogin.length) {
            var txtPhone = $("#phone");
            var validator = function(){
                var phoneVal = txtPhone.val();
                if (phoneVal.trim() === "") {
                    Common.makeToast("手机号码不能为空");
                    return false;
                }

                if(!Common.validator.phoneValidator(phoneVal)){
                    Common.makeToast("手机号码格式不正确");
                    return false;
                }

                return phoneVal;
            };

            btnLogin.on("click", function(){
                var validateResult = validator();
                if (validateResult) {
                    var loginData = {
                        phone : validateResult
                    };
                    Common.dataEnginer(Configer.api.loginApi, loginData).then(function(result){
                        if (result.status === 200) {
                            Common.makeToast("恭喜你绑定成功");
                            setTimeout(function(){
                                window.location = result.msg;    
                            }, 1000);
                        }else{
                            Common.makeToast(result.msg);
                        }
                    });
                };
            });
        };
    };

    /*
     * 签到处理
     ========================================================*/
    var signinHandle = function(){
        var btnSignin = $("#btnSignin");
        if (btnSignin && btnSignin.length) {
            var todayPoint = $("#lblTodayPoint");

            var handleTodayPoint(signinPoint){
                var currentPointText = todayPoint.text(),
                    currentPoint = parseInt(currentPointText),
                    newPoint = (currentPoint + signinPoint),
                    newPointText;
                if (newPoint >= 0) {
                    newPointText = "+" + newPoint;     
                }
                todayPoint.text(newPointText);
            };
            btnSignin.on("click", function(){
                var tipTarget = $(this);
                Common.dataEnginer(Configer.api.signinApi).then(function(result){
                    if (result.status === 200) {
                        var signinPoint = (result.msg?parseInt(result.msg):10);
                        var signinText = "+" + signinPoint;
                        $.tipsBox({
                            obj: tipTarget,
                            str: signinText,
                            callback: function () {
                                handleTodayPoint(signinPoint);
                            }
                        });
                    }else{
                       Common.makeToast(result.msg);
                    }
                });
            });
        }   
    };

    return {
    	init : function(){
            loginHandle();
            signinHandle();
    	}
    };
})();


/* 
 * 系统初始化
 * ==========================================================*/
$(function(){
    App.init();
});