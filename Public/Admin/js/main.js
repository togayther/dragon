
/* 
 * 系统配置
 * ==========================================================*/
var Configer = (function() {
    
    'use strict';

    var dataTableConfig = {
        initComplete: function() {
            $("#dataTable_filter").find("input").attr("placeholder", "请输入关键字...");
        },
        "pagingType": "full_numbers",
        "sLoadingRecords": "正在加载数据...",
        "sZeroRecords": "暂无数据",
        "stateSave": true,
        "searching": true,
        "aoColumnDefs": null,
        "language": {
            "processing": "玩命加载中...",
            "lengthMenu": "每页显示 _MENU_ 条数据",
            "zeroRecords": "没有匹配结果",
            "info": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
            "infoEmpty": "显示第 0 至 0 项结果，共 0 项",
            "infoFiltered": "(由 _MAX_ 项结果过滤)",
            "infoPostFix": "",
            "search": "查询：",
            "url": "",
            "paginate": {
                "first": "首页",
                "previous": "上一页",
                "next": "下一页",
                "last": "末页"
            }
        }
    };

    var api = {
        loginApi: "../auth/login",
        imgDeleteApi : "../image/delete"
    };
    return {
        api : api,
        dataTableConfig: dataTableConfig
    }
})();

/* 
 * 系统扩展
 * ==========================================================*/
(function(){
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

})();

/* 
 * 常用工具
 * ==========================================================*/
var Common = (function() {
    
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
            alert("script error！message:"+mess+",line:"+line);
        };
    })();

    //获取Url参数
    var getUrlParam = function(name) {
        var reg = new RegExp("(^|&|#|/?)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.href.substr(1).match(reg);
        if (r != null) {
            var result = unescape(r[2]);
            if (result.indexOf('#') > 0) {
                result = result.slice(0, result.indexOf('#'));
            };
            return result;
        }
        return null;
    };

    //动画渲染
    var animateRender = function(target, animate){
        if(target && animate){
            target = $(target);
            target.addClass("animated "+ animate).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){
                target.removeClass("animated shake");
            });
        }
    };

    //加载提示
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

    //弹出通知提示
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
            position = position || "toast-top-full-width";
            toastr.options = {
                positionClass : position,
                timeOut : timeout
            };
            __toastLast = toastr[type](msg);
        }
    };

    //通用数据处理
    var dataEnginer = function(url, data, type) {
        if (!url) {  console.log("data url can not be empty!");  return; }
        var deferred = $.ajax({
            type: type || 'POST',
            url: url,
            data: data
        }).fail(function(){
            makeToast("","error", -1);
        });

        return deferred;
    };

    return {
        getUrlParam : getUrlParam,
        animateRender : animateRender,
        makeToast : makeToast,
        dataEnginer : dataEnginer,
        spinner : spinner,
    };

})();

/* 
 * 系统处理
 * ==========================================================*/
var System = (function() {
    
    'use strict';

    //插件初始化处理
    var pluginInitHandle = function(){

        var toolTip = $(".tooltip-title");
        if (toolTip && toolTip.length) {
            toolTip.tooltip();
        };
        
        if ($.scrollUp) {
            $.scrollUp({
                animation: 'fade',
                scrollImg: {
                    active: true,
                    type: 'background'
                }
            });
        };

        var lazyImg = $("img.lazy");
        if (lazyImg && lazyImg.length) {
            lazyImg.lazyload({});     
        };

        var switchInput = $(".switch-input");
        if (switchInput && switchInput.length) {
            switchInput.bootstrapSwitch();
        };

        var richEditor = $(".richEditor");
        if (richEditor && richEditor.length) {
            richEditor.wangEditor({
                'menuConfig': [
                    ['viewSourceCode'],
                    ['bold', 'underline', 'italic', 'foreColor', 'backgroundColor', 'strikethrough'],
                    ['blockquote', 'fontFamily', 'fontSize', 'setHead', 'list', 'justify'],
                    ['insertTable'],
                    ['insertImage'],
                    ['undo', 'redo', 'fullScreen']
                ]
            });
        };

        var validateForm = $("form[data-validation]");
        if (validateForm && validateForm.length) {
            validateForm.validation({reqmark:false});
        };
    };
	
    //滚动条控制
    var scrollbarHandle = function(){
        $('.animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $("body").css({
                overflow:"auto"
            });
        });
    };

    //表格初始化
    var dataTablesHandle = function() {
        var dataTable = $("#dataTable");
        if (dataTable && dataTable.length) {
            var ths = dataTable.find("th");
            if(ths && ths.length){
                var columConfigs = [];
                for(var i = 0, len = ths.length; i<len; i++){
                    var thItem = $(ths[i]);

                    var thSortEnabled = thItem.attr("data-sort-enabled"),
                        thSearchEnabled = thItem.attr("data-search-enabled");
                    
                    var bSortable = thSortEnabled=="false" ? false : true,
                        bSearchable = thSearchEnabled =="false"?false:true;

                    var columConfig = {
                        bSortable : bSortable,
                        bSearchable : bSearchable,
                        aTargets : [i]
                    };

                    columConfigs.push(columConfig);

                }
                Configer.dataTableConfig.aoColumnDefs = columConfigs;
            }

            var table = dataTable.dataTable(Configer.dataTableConfig);
        };
    };

    //数字范围选择控件
    var rangeSelectorHandle = function(){
        var rangeSelector = $(".rangeSelector");
        if (rangeSelector && rangeSelector.length) {

            rangeSelector.each(function(){
                var selectorItem = $(this),
                    itemId = selectorItem.attr("id"),
                    itemFromTarget = $("#"+itemId+"-from"),
                    itemToTarget = $("#"+itemId+"-to");
                selectorItem.ionRangeSlider({
                    onChange: function (data) {
                        if (itemFromTarget && itemFromTarget.length) {
                            itemFromTarget.val(data.from);
                        }
                        if (itemToTarget && itemToTarget.length) {
                            itemToTarget.val(data.to);
                        }
                    }
                }); 
            });
        };
    };

    //时间范围选择控件
    var dateRangeSelectorHandle = function(){
        var rangeSelector = $(".dateRangeSelector");
        if (rangeSelector && rangeSelector.length) {
            var formatUnixToDate = function(unixtime){
                return moment.unix(unixtime).format("YYYY-MM-DD 00:00:00");
            },  fromatDateToUnix = function(datestr){
                return moment(datestr).format("X");
            };

            for(var i = 0, len = rangeSelector.length; i<len; i++){
                var selector = $(rangeSelector[i]),
                    selectorId = selector.attr("id"),
                    fromTarget = $("#"+selectorId+"-from"),
                    toTarget = $("#"+selectorId+"-to"),
                    selectorFrom = selector.attr("data-fromVal"),
                    selectorTo = selector.attr("data-toVal"),
                    active = selector.attr("data-active"),
                    nowVal = moment().format("X");

                var disable = false,
                    from_fixed = false,
                    to_fixed = false,
                    type,
                    from,
                    to,
                    min,
                    max;
                if (selectorFrom && selectorTo) {
                    var from = fromatDateToUnix(selectorFrom),
                        to = fromatDateToUnix(selectorTo);
                    //起始时间 > 当前时间（未开始）
                    if (from > nowVal) {
                        min = nowVal;
                        max = to;
                        type = "double";
                        disable = false;
                        from_fixed = to_fixed = true;
                    }
                    //结束时间 < 当前时间（已结束）
                    else if(to < nowVal){
                        min = from;
                        max = nowVal;
                        from = from;
                        to = nowVal;
                        type = "double";
                        disable =  true;
                    }
                    //进行中
                    else if(from < nowVal && to > nowVal){
                        min = from;
                        max = to;
                        from = nowVal;
                        type = "double";
                        disable = false;
                        from_fixed = to_fixed = true;
                    }
                }else{
                    min = nowVal;
                    max = moment().add(2, 'month').format("X");
                    from = nowVal;
                    to = moment().add(1, 'month').format("X");

                    disable = from_fixed = to_fixed =  false;
                    type = "double";
                }

                if (active) {
                    disable = from_fixed = to_fixed = false;
                 };

                if (fromTarget && fromTarget.length) {
                     fromTarget.val(formatUnixToDate(from));
                }
                if (toTarget && toTarget.length) {
                     toTarget.val(formatUnixToDate(to));
                }

                var configer = {
                    type : type,
                    min: min, 
                    max: max,
                    from: from,
                    to : to,
                    grid: true,
                    disable : disable,
                    from_fixed : from_fixed,
                    to_fixed : to_fixed,
                    force_edges: true,
                    prettify: function (num) {
                        return moment(num, "X").format("LL");
                    },
                    onChange: function (data) {
                        var fromDate = formatUnixToDate(data.from),
                            toDate = formatUnixToDate(data.to);
                        if (fromTarget && fromTarget.length) {
                            fromTarget.val(fromDate);
                        }
                        if (toTarget && toTarget.length) {
                            toTarget.val(toDate);
                        }
                    }
                    
                };
                selector.ionRangeSlider(configer);
            }
        }
        
    };

    //图片删除处理
    var imgDeleteHandle = function(){
        var btnImgRemove = $("a.btnImageRemove");
        if (btnImgRemove && btnImgRemove.length) {
            var removeHandler = function(imgName){
                var deleteApi = Configer.api.imgDeleteApi + "?name="+ imgName;
                return Common.dataEnginer(deleteApi);
            };

            btnImgRemove.on("click", function(){
                var $this = $(this),
                    thumbItem = $this.parent(".thumbnailItem"),
                    imgName = $this.attr("data-name");
                
                if(imgName){
                    removeHandler(imgName).then(function(){
                        thumbItem.remove();      
                    }, function(){
                        alert("删除失败");
                    });
                }
            });
        };
    };

    //顶部搜索处理
    var searchHandle = function(){
        var btnSearch = $("#btn-search");
        if (btnSearch && btnSearch.length) {
            var txtKeyword = $("#txt-search"),
                searchTarget = $(".list-group-item.title");
            btnSearch.on("click", function(){
                var searchKey = txtKeyword.val();
                if (searchKey.trim() == "") {
                    searchTarget.closest(".list-group").removeClass("hide");
                }else{
                   for (var i = 0, len = searchTarget.length; i< len; i++) {
                        var targetItem = $(searchTarget[i]),
                            targetContainer = targetItem.closest(".list-group"),
                            targetText = targetItem.text().trim();
                        if (targetText.indexOf(searchKey) > 0) {
                            targetContainer.removeClass("hide");
                        }else{
                            targetContainer.addClass("hide");
                        }
                   }; 
                }
            });
        };
    };

    //登录处理
    var loginHandle = function(){
        var loginForm = $("#login-panel");
        if (loginForm) {
            var btnLogin = $("#btn-login"),
                txtUserName = $("#txt-username"),
                txtUserPwd = $("#txt-password");

            btnLogin.on("click",function(){

                var userName = $.trim(txtUserName.val()),
                    userPwd = $.trim(txtUserPwd.val()),
                    faildHandle = function(){
                        Common.animateRender(loginForm, "shake");
                    };

                if (userName && userPwd) {
                    var api = Configer.api.loginApi,
                        authData = {
                            username : userName,
                            password : userPwd
                        };
                    Common.dataEnginer(api, authData, "POST").then(function(result){
                        if (result.status==200) {
                            window.location = result.msg;
                        }else{
                            faildHandle();
                        }
                    }, function(result){
                        faildHandle();
                    });
                }else{
                    faildHandle();
                };
                return false;
            });
        };
    };

    //表单提交处理
    var formSubmitHandle = function(){
        var btnSubmit = $(".btn-submit");
        if (btnSubmit && btnSubmit.length) {
            btnSubmit.on("click", function(){
                var submitForm = btnSubmit.closest("form[data-validation]");
                if (submitForm && submitForm.length) {
                    if (submitForm.valid(this,"error!") == false){
                        return false;
                    }
                };
            });
        };
    };

    //复选框切换处理
    var checkboxChangeHandle = function(){
        var checkBox = $("input[type='checkbox']");
        if (checkBox && checkBox.length) {
            checkBox.on("change", function(){
                var $this = $(this),
                    $thisVal = $("input[name='"+$this.attr("id")+"']");
                if ($thisVal) {
                    var val = $this.is(":checked")?"1":"0";
                    $thisVal.val(val);
                };
            });
        };
    };  

    //下拉选择控件切换处理
    var selectChangeHandle = function(){
        var selectChange = $("select[data-change-target]");
        if (selectChange && selectChange.length) {
            selectChange.on("change", function(){
                var select = $(this),
                    selectTarget = select.attr("data-change-target"),
                    selectVal = select.attr("data-change-value");
                if (selectTarget && selectVal) {
                    var target = $(selectTarget),
                        selectOption = select.find("option:selected"),
                        targetVal = selectOption.data(selectVal);
                    target.val(targetVal);
                };
            });

            selectChange.trigger("change");
        };
    };

    return {
        init: function() {
            pluginInitHandle();
            rangeSelectorHandle();
            scrollbarHandle();
            dataTablesHandle();
            dateRangeSelectorHandle();
            loginHandle();
            searchHandle();
            formSubmitHandle();
            imgDeleteHandle();
            selectChangeHandle();
            checkboxChangeHandle();
        }
    }
})();


$(function() {
    System.init();
});