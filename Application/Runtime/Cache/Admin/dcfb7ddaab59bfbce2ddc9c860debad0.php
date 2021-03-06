<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    
        <title>
            原野软件工作室
        </title>

        <!--
        <link rel="stylesheet" type="text/css" href="/wechat/Public/css/mcmurphy.css">  
        -->
        <link href="/wechat/Public/Admin/css/bootstrap.css" rel="stylesheet"/>
        <link href="/wechat/Public/Admin/css/animate.css" rel="stylesheet"/>
        <link href="/wechat/Public/Admin/css/font-awesome.css" rel="stylesheet"/>
        <link href="/wechat/Public/Admin/css/main.css" rel="stylesheet"/>
        
        
        <script>
            document.onreadystatechange = onloadCompleted;
            function onloadCompleted()
            {
                if(document.readyState == "complete")
                {
                    var preloader = document.getElementById("preloader");
                    if (preloader) {
                        var timer = setTimeout(function() {
                            preloader.style.display = "none";
                            clearTimeout(timer);
                        }, 500);
                    };
                }
            }
        </script>
    </head>
    <body>
        <div id="preloader">
            <span></span>
        </div>

        <div id="duang-container"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                    <div id="login-panel">
                        <form action="">
                            <div class="form-group text-center">
                                <i class="fa fa-leaf fa-5x" id="logo"></i>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control text-center" id="txt-username" placeholder="用户名">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control text-center" id="txt-password" placeholder="密码">
                            </div>
                            <div class="form-group">
                                <a href="javascript:void(0);" class="btn btn-block btn-primary" id="btn-login">
                                登录
                                </a>
                            </div>
                            <div class="text-center">
                                <small class="text-danger" id="lbl-error"></small>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="/wechat/Public/Admin/js/jquery.min.js"></script>  
        <script src="/wechat/Public/Admin/js/bootstrap.js"></script>
        <script src="/wechat/Public/Admin/js/spin.js"></script>  
        <script src="/wechat/Public/Admin/js/particles.min.js"></script>
        <script>
            try{
                if (window.particlesJS) {
                    particlesJS("duang-container", {
                        "particles": {
                            "number": {
                                "value": 60,
                                "density": {
                                    "enable": true,
                                    "value_area": 500
                                }
                            },
                            "color": {
                                "value": "#ffffff"
                            },
                            "shape": {
                                "type": "circle",
                                "stroke": {
                                    "width": 0,
                                    "color": "#000000"
                                },
                                "polygon": {
                                    "nb_sides": 5
                                },
                                "image": {
                                    "width": 100,
                                    "height": 100
                                }
                            },
                            "opacity": {
                                "value": 0.4,
                                "random": false,
                                "anim": {
                                    "enable": false,
                                    "speed": 1,
                                    "opacity_min": 0.1,
                                    "sync": false
                                }
                            },
                            "size": {
                                "value": 2,
                                "random": true,
                                "anim": {
                                    "enable": false,
                                    "speed": 40,
                                    "size_min": 0.1,
                                    "sync": false
                                }
                            },
                            "line_linked": {
                                "enable": true,
                                "distance": 60,
                                "color": "#ffffff",
                                "opacity": 0.4,
                                "width": 1
                            },
                            "move": {
                                "enable": true,
                                "speed": 2,
                                "direction": "none",
                                "random": false,
                                "straight": false,
                                "out_mode": "out",
                                "bounce": false,
                                "attract": {
                                    "enable": false,
                                    "rotateX": 600,
                                    "rotateY": 1200
                                }
                            }
                        },
                        "interactivity": {
                            "detect_on": "canvas",
                            "events": {
                                "onhover": {
                                    "enable": true,
                                    "mode": "grab"
                                },
                                "onclick": {
                                    "enable": false,
                                    "mode": "push"
                                },
                                "resize": true
                            },
                            "modes": {
                                "grab": {
                                    "distance": 140,
                                    "line_linked": {
                                        "opacity": 1
                                    }
                                },
                                "bubble": {
                                    "distance": 400,
                                    "size": 40,
                                    "duration": 2,
                                    "opacity": 8,
                                    "speed": 3
                                },
                                "repulse": {
                                    "distance": 200,
                                    "duration": 0.4
                                },
                                "push": {
                                    "particles_nb": 4
                                },
                                "remove": {
                                    "particles_nb": 2
                                }
                            }
                        },
                        "retina_detect": true
                    });
                }
            }
         catch(e){}
        </script>
        <script src="/wechat/Public/Admin/js/main.js?v=2.0"></script> 
    </body>
</html>