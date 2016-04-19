
;(function($) {

  'use strict';

  (function(pluginName) {
    var defaults = {
        title : "系统通知",
        effect : "",
        overlay_close : true,
        triggerId : null,
        content : "",
        afterCreated : null,
        afterClosed : null,
        buttons : [{
          text : "确定"
        }]
    };

    $[pluginName] = function(options) {
      
      options = $.extend(defaults, options);

      var dialog = this;
      dialog.init = function(){
          dialog.overlay = $('<div class="md-overlay">');
          if (options.overlay_close){
              dialog.overlay.bind('click',dialog.close);
          };
          
          dialog.wrapper = $('<div class="md-modal '+options.effect+'">');

          if (options.triggerId) {
              dialog.wrapper.attr("id",options.triggerId);
          };

          dialog.content = $('<div class="md-content"/>');

          dialog.title = $('<h3>'+options.title+'</h3>');

          dialog.content.append(dialog.title);
          dialog.innerContent = $('<div>');
          dialog.innerContent.append(options.content);
          dialog.content.append(dialog.innerContent);

          dialog.footer = $('<div class="md-content-footer clearfix">');

          if (options.buttons && options.buttons.length) {
              var buttonCount = options.buttons.length;
              for (var i = 0; i < buttonCount; i++) {
                 (function(i){
                   var buttonItem = options.buttons[i];
                   buttonItem.id = buttonItem.id || "";
                     var button = $('<a class="borderbox" href="javascript:void(0);">'+buttonItem.text+'</a>');
                     if (i == 1) {
                       button.addClass("border-none");
                       //第二个按钮，显示黑黢黢的龌龊的黑色
                       button.addClass("md-close-disabled");
                     };
                     if (buttonCount == 1) {
                         button.addClass("btn-block border-none");
                     };

                     var callback = null;
                     if (buttonItem.callback && typeof buttonItem.callback === "function") {
                         callback = function(){
                          var result = buttonItem.callback();
                          if(result != "aha"){
                            dialog.close();  
                          }
                         };
                     }else{
                         callback = dialog.close;
                     }
                     button.on("click",callback);
                     dialog.footer.append(button);
                 })(i);
              };
          };

          dialog.content.append(dialog.footer).appendTo(dialog.wrapper);
          dialog.overlay.appendTo('body');
          dialog.wrapper.appendTo('body');

          if (options.afterCreated && typeof options.afterCreated === "function") {
              options.afterCreated.call(this);
              
              options.afterCreated = null;
          };

          setTimeout(function(){
             dialog.overlay.fadeIn(200);
             //dialog.wrapper.fadeIn(200);
             dialog.wrapper.addClass("md-show");
          },10);

          return dialog;
      };

      dialog.close = function(){
        
          dialog.wrapper.find("a").off("click");
          dialog.wrapper.fadeOut(200, function(){
            $(this).remove();
          });
          dialog.overlay.fadeOut(200, function(){
            $(this).remove();
          });

          if (options.afterClosed && typeof options.afterClosed === "function") {
              options.afterClosed.call(this);
              
              options.afterClosed = null;
          };

          return false;
      };

      return dialog.init();
    };

    $[pluginName].defaults = defaults; 
    
    /*
     * 直接触发。
     ========================================================= */
    (function(){
        var mdTrigger = $(".md-trigger");
        if (mdTrigger && mdTrigger.length) {
            mdTrigger.on("click",function(){
              var trigger = $(this),
                triggerDialog = $("#"+trigger.attr("data-modal")),
                triggerOverlay = triggerDialog.siblings(".md-overlay"),
                triggerClose = triggerDialog.find(".md-close");

              var removeDialog = function(){
                  triggerDialog.removeClass("md-show");
                  triggerOverlay.removeClass("overlay-show");
              };

              triggerDialog.addClass("md-show");
              triggerOverlay.fadeIn(200)
                .off("click").on("click",removeDialog); 

              if (triggerClose) {
                 triggerClose.off("click").on("click",removeDialog);
              };
            });
        };
    })();

  })('piepdialog');
  
})(jQuery);