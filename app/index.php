<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="zh-CN" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <title>够格</title>
    <meta name="keywords" content="够格">
    <meta name="description" content="够格">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/settings.css">

    <link rel="stylesheet" href="css/styles.css?v=0.08">

    <script type="text/javascript" src="js/modernizr.custom.32033.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="css/custom.css?v=0.08">
</head>

<body>
<section class="section1" style="padding-bottom:0px;" id="pos_inherit">
    <!--当设备为pc机时显示的内容-->
    <div class="logo0622">
    	<img onerror="javascript:this.src='default-icon.png';" src="logo.png">
    </div>
     <p style="text-align:center" class="cy_app_name">够格</p>
    
        <div class="fixed-download">

            </div>
    <div class="qr tada">
        <div id="qrcodeImg" class="qrwarp" title="">
            <img alt="Scan me!" style="display: block;" src="qrcode.png">
        </div>
    </div>
    <div class="tips tada">
        <p class="p1">扫描二维码下载</p>
        <div class="divider">或</div>
        <p class="p2">使用手机浏览器打开下面网址:</p>
        <p class="web_link">http://sx.asiainstitute.cn/app/</p>
    </div>
    <!--当设备为移动端设备时显示的内容-->
    <div class="phone_show">
<!--         <p class="p1">德友会</p> -->
<?php 
    $sys=$_SERVER['HTTP_USER_AGENT'];
    if (stripos($sys,"iPhone")>0) {
        $ostype=1;
?>      
        <input type="hidden" id="ios_tips" value="1">
        <p class="p2">1.0.1(Build 1) 6.5 MiB</p>
        <p class="p3">更新于 2016-3-23</p>
        <div class="load_fixed">
            <a id="down2" href="itms-services://?action=download-manifest&url=https://app.175joy.com/sx.plist" onclick="ajaxTj()" class="btn btn-primary inverse btn-lg">
	            <i class="fa fa-apple"></i>下载安装
            </a>
<?php }else {
    $ostype=0;
    ?>
        <input type="hidden" id="ios_tips" value="0">
        <p class="p2">1.0.1229(Build 3) 7.7 MiB</p>
        <p class="p3">更新于 2015-12-31</p>
        <div class="load_fixed">
            <a id="down2" href="http://sx.asiainstitute.cn/app/Practice.apk"  class="btn btn-primary inverse btn-lg">
                <i class="fa fa-android"></i>下载安装
            </a>
<?php }?>
            <p class="p3" style="display:none" id="down_tip"></p>
            <div id="down_loading" class="fixing" style="display: none;">
            	<i class="fa fa-circle-o-notch fa-4x fa-spin"></i>
            </div>
            <p id="install_tips" style="display: none;" class="home_key">正在安装，请按 Home 键到桌面查看</p>
        </div>
    </div>
    </section>
<!--ios9提示结构-->
<div class="pos_all" style="display: none">
    <div class="ios9_tips">
        <div class="ios9_tips_content">
            <a class="close_ios9" href="javascript:;"><img src="images/ios9_guide/close.png"/></a>

            <p class="p1">在 iOS 9 中安装运行会有如下提示</p>

            <p class="p2">需要信任这个企业级开发者才能运行这个APP</p>
            <img class="img1" src="images/ios9_guide/u4.png"/>

            <p class="p3">打开手机的系统设置</p>
            <img class="img2" src="images/ios9_guide/u8.png"/>

            <p class="p3">进入"通用"</p>
            <img class="img3" src="images/ios9_guide/u12.png"/>

            <p class="p3">进入"描述文件"</p>
            <img class="img3" src="images/ios9_guide/u16.png"/>

            <p class="p3">选择之前显示的企业</p>
            <img class="img3" src="images/ios9_guide/u20.png"/>

            <p class="p3">点击中间的蓝色文字信任该企业</p>
            <img class="img3" src="images/ios9_guide/u24.png"/>

            <p class="p3">在弹出的提示框中点击"信任"</p>
            <img class="img3" src="images/ios9_guide/u28.png"/>

            <p class="go_desk">可以回到桌面打开应用体验啦</p>
        </div>
    </div>
</div>
<!--ios9提示结构结束-->
<section class="section2" style="padding-bottom:0px;">
    <div class="container cy_container0624">
        <div class="title">够格</div>
        <div class="section2_content">
           <p class="p2" style="width:100%; text-align:center;"><span> 当前版本:<em>
            1.0.1(Build 1)</em></span>
            <span> <em>
                                            企业版
                                        </em></span><span> 文件大小 :<em> 7.1 MiB</em></span> <span>更新于: 2016-2-05 </span></p>

<!--            
<style>
/*ios扫码下载，二维码显示样式 start*/
.scan_qr{text-align: center;width: 125px;height: 125px;border: 1px solid #ccc;border-radius: 10px;margin-top: -70px;margin-left: 120px;position: absolute;background:#fff;display:none;}
.scan_qr .qrwarp {background-color: #fff;border-radius: 8px;display: inline-block;height: 120px;width: 120px;}
.scan_qr .qrwarp img {height: 110px;padding: 10px 0 0 10px;width: 110px;}
s {position: absolute;top: 50px;left: -20px;display: block;height: 0;width: 0;font-size: 0;line-height: 0;border-color: transparent #999 transparent transparent;border-style: dashed solid dashed dashed;border-width: 10px;}
s>i {position: absolute;top: -10px;left: -9px;display: block;height: 0;width: 0;font-size: 0;line-height: 0;border-color: transparent #fff transparent transparent;border-style: dashed solid dashed dashed;border-width: 10px;}
.scan:hover .scan_qr{display:block;}
/*ios扫码下载，二维码显示样式 end*/
</style>

<div class="new_pre_bx">
    <div class="fg_line"></div>
    <ul>
        <li>
            <div class="fixed-download"><div style="min-height: 0px; min-width: 0px; line-height: 20px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-size: 14px; left: 676.5px; top: 281.5px; visibility: visible; opacity: 1; transform: translate3d(0px, 0px, 0px);" class="tp-caption sfb hidden-xs start" data-x="550" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1000" data-start="1700" data-easing="Power4.easeOut">
	            		                    <a class="btn btn-primary btn-lg scan" style="border-color:#336799;">
	                        <i class="fa fa-apple"></i> 扫码下载
	                        <div class="tada scan_qr">
						        <div id="qrcodeImg" class="qrwarp" title="">
						            <img alt="Scan me!" style="display: block;" src="qrcode.png">
						        </div>
						        <s>
									<i></i>
								</s>
						    </div>
	                    </a>

	                                </div>
            </div>
            <p class="now_verson"><span>当前版本号：1.0.1</span>
                <span><em>
                                                                        企业版
                                                                </em></span>
                <span></span>文件大小：41.807 MiB</p></p>
                    </li>


        <li style="border-right:none;">
            <div class="fixed-download">
                <div style="min-height: 0px; min-width: 0px; line-height: 20px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-size: 14px; left: 676.5px; top: 281.5px; visibility: visible; opacity: 1; transform: translate3d(0px, 0px, 0px);" class="tp-caption sfb hidden-xs start" data-x="550" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1000" data-start="1700" data-easing="Power4.easeOut">



                                		                	<a onClick="ajaxTj('3ee6af313d9e59fda5c9c665d7d72250')" href="Dyh.apk" class="btn btn-primary btn-lg" style="border-color:#336799;">
	                        <i class="fa fa-android"></i> 点击下载
	                    </a>
	                				

                </div>
            </div>
            <p class="now_verson"><span>当前版本号：1.0.1218</span>
            		                <span><em>
	                    	               	</em></span>
                           <span></span>文件大小：31.059 MiB</p></p>
                    </li>
    </ul>
</div>

-->

        </div>
    </div>
</section>
<!--
<div class="feedback">
	<div class="feedback_content">
    	<p class="toggle" id="toggle">
            <input type="text" class="form-control" placeholder="亲，给《德友会》提点建议吧" id="btnFk"/>
            <input type="text" class="form-control" placeholder="Email/QQ/微信/电话" id="btncontact" style="display:none" />
                                    <input type="hidden" class="form-control" value="1.0.1" id="app_version" style="display:none"/>
                        <input type="hidden" class="form-control" value="1.0.1" id="version_code" style="display:none"/>
                                </p>
        <div class="feedback_content_box" id="feedback_content_box">
        	<ul class="list maki">
                <li>
                <textarea cols="100" rows="5" name="content" placeholder="反馈内容"></textarea>
                    <p id="content_tips" style="display: none;" class="help-block help-block-error">亲，还是写点什么吧 :)</p>
                </li>
                <li><a href="javascript:void(0)" class="btn btn-primary" id="submit"><i class="fa fa-upload"></i> 发射</a></li>
            </ul>
        </div>
        <p class="feedback_tip" style='display:none'><i class="fa fa-github-alt fa-2x"></i> &nbsp;&nbsp;喵，反馈已收到 </p>
    </div>
</div>

<footer class="finial_footer" style=" width:100%; height:40px; line-height:40px;">
    <div class="rights" style="margin-top:0px;">
         <p><a href="/">德友会内测分发<strong>dz.175joy.com</strong></a> </p>
    </div>
</footer>
-->

<link href="css/app.css?v=0.10" rel="stylesheet" type="text/css" >
<div id="weixin" style="display: none">
    <div class="click_opacity"></div>
    <div class="to_btn">
    	<span class="span1"><img src="img/click_btn.png"></span>
        <span class="span2"><em>1</em> 点击右上角<img src="img/menu.png">打开菜单</span>
        <span class="span2"><em>2</em> 选择<img src="img/safari.png">用Safari打开下载</span>
    </div>
</div>
<div id="weixin_an" style="display: none">
    <div class="click_opacity"></div>
    <div class="to_btn">
    	<span class="span1"><img src="img/click_btn.png"></span>
        <span class="span2"><em>1</em> 点击右上角<img src="img/menu_android.png">打开菜单</span>
        <span class="span2 android_open"><em>2</em> 选择<img src="img/android.png"></span>
   	</div>
</div>
</body>
</html>


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/placeholdem.min.js"></script>
<script src="js/jquery.themepunch.plugins.min.js"></script>
<script src="js/jquery.themepunch.revolution.min.js"></script>
<script src="js/scripts.js"></script>
<script>

	$(function(){
		var browser = {
            versions: function() {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {
                    trident: u.indexOf('Trident') > -1,
                    presto: u.indexOf('Presto') > -1,
                    webKit: u.indexOf('AppleWebKit') > -1,
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/),
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1,
                    iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1,
                    iPad: u.indexOf('iPad') > -1,
                    webApp: u.indexOf('Safari') == -1
                };
            }()
        }
        if(is_weixin())
        {
            if(browser.versions.ios || browser.versions.iPhone || browser.versions.iPad){
                $('#weixin').show();
            }else{
                $('#weixin_an').show();
            }
        }
        var os_type = <?php echo $ostype;?>;
        if(browser.versions.ios || browser.versions.iPhone || browser.versions.iPad){
			if(os_type == 1){
				$('#down2').show();
			}else{
				$('#down2').hide();
				$('#down_tip').show().html('请使用安卓设备安装');
			}
		}else if(browser.versions.android){
			if(os_type == 0){
				$('#down2').show();
			}else{
				$('#down2').hide();
				$('#down_tip').show().html('请使用IOS设备安装');
			}
		}
	})
    function ajaxTj()
    {
        var browser = {
            versions: function() {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {
                    trident: u.indexOf('Trident') > -1,
                    presto: u.indexOf('Presto') > -1,
                    webKit: u.indexOf('AppleWebKit') > -1,
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/),
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1,
                    iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1,
                    iPad: u.indexOf('iPad') > -1,
                    webApp: u.indexOf('Safari') == -1
                };
            }()
        }

        var tip_val = $('#ios_tips').val();
        if(tip_val ==1){
            $('.pos_all').css('display','block');
            $('#pos_inherit').addClass('pos_inherit');

        }
        if(!is_weixin())
        {
                        if(browser.versions.ios || browser.versions.iPhone || browser.versions.iPad){
                $("#down2").hide();
                $("#down_loading").show().delay(5000).fadeOut(100);
                $("#install_tips").hide().delay(5000).fadeIn(200);
            }
                    }

        // $.ajax({
        //     type: "GET",
        //     url:'http://pre.im/app/tj',
        //     data: {package_key:'cb1cba192e9f4d21d21c5b40fc76d395'},
        //     success: function(msg){
        //        console.log(msg);
        //         if(msg == 1)
        //         {
        //             $('#down1').attr('href','#');
        //             $("#down1").attr("target", "");
        //             $('#down2').attr('href','');
        //             $("#down2").attr("target", "#");
        //         }
        //     }
        // });
    }
    function is_weixin(){
        var ua = navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i)=="micromessenger") {
            return true;
        } else {
            return false;
        }
    }

    $(function() {
    $('.close_ios9').click(function(){
        $('.pos_all').css('display','none');
        $('#pos_inherit').removeClass('pos_inherit');
    });

    $("#btnFk").on("click", function() {
        $('#btncontact').css('display', 'block');
        $('#btnFk').css('display', 'none');
        $("#feedback_content_box").slideDown(600);
        $("#feedback_content_box").animate({
                top: 0
            }
            , 600);
    });



    $("#submit").on("click", function() {

        var contact = $('#btncontact').val().trim();
        var app_version = $('#app_version').val().trim();
        var version_code = $('#version_code').val().trim();
        var content = $('textarea').val().trim();
        var app_key = "daff804151f6a52a0f5c9def617124c5";
        var url = '/feedback/create'
        if(!content || content == '反馈内容'){
            $("#content_tips").css({display:'block'});
            return false
        }

        $('#toggle').css('display', 'none');
        $('#content_tips').css('display', 'none');
        $("#feedback_content_box").slideUp(600);
        $("#feedback_content_box").animate({ top: 20 }, 600);


        if( !contact || contact == 'Email/QQ/微信/电话' ){
            contact = '匿名';
        }
        $.post(url,{contact:contact,app_version:app_version,version_code:version_code,content:content,app_key:app_key},function(msg){
            if(msg.result){
                $('#for_tips,textarea,#btnFk,#submit').css({display:'none'})
            }else{
                $('.feedback_tip').text('提交失败，请 <a href="/site/contact">吐槽</a>');
            }
            $('.feedback_tip').css({display:'block'})
        },'json')
    });
})
</script>


<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
var wxData = {
    "imgUrl": 'logo.png',//图片
    "link": 'https://dz.175joy.com',//分享链接
    "title" : '德友汇',//分享到微信的标题
    "title2": '德友汇',//分享到qq的标题
    "desc": ''
};
wx.config({
    debug: false,
    appId: 'wx65db44acf39a5516',
    timestamp: 1450872116,
    nonceStr: 'fSYKIVsUiWZKgnnp',
    signature: '4b2e87b482cc10b7135465728c74b1041208cd24',
    jsApiList: [
      	'onMenuShareTimeline',
      	'onMenuShareAppMessage',
      	'onMenuShareQQ',
      	'onMenuShareWeibo',
      	'onMenuShareQZone',
    ]
});

wx.ready(function () {
    /*分享到朋友圈*/
    wx.onMenuShareTimeline({
      	title: wxData['title'], // 分享标题
      	link: wxData['link'], // 分享链接
      	imgUrl: wxData['imgUrl'], // 分享图标
	    success: function () {
	     	// 用户确认分享后执行的回调函数
	  	},
	  	cancel: function () {
	     	// 用户取消分享后执行的回调函数
	  	}
    });
    /*分享给朋友*/
    wx.onMenuShareAppMessage({
      	title: wxData['title'], // 分享标题
      	desc: wxData['desc'], // 分享描述
      	link: wxData['link'], // 分享链接
      	imgUrl: wxData['imgUrl'], // 分享图标
      	type: '', // 分享类型,music、video或link，不填默认为link
      	dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
      	success: function () {
             // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    });
    /*分享到qq*/
    wx.onMenuShareQQ({
    	title: wxData['title2'], // 分享标题
      	desc: wxData['desc'], // 分享描述
      	link: wxData['link'], // 分享链接
      	imgUrl: wxData['imgUrl'], // 分享图标
      	success: function () {
         	// 用户确认分享后执行的回调函数
      	},
      	cancel: function () {
         	// 用户取消分享后执行的回调函数
      	}
    });
    /*分享到微博*/
    wx.onMenuShareWeibo({
    	title: wxData['title2'], // 分享标题
      	desc: wxData['desc'], // 分享描述
      	link: wxData['link'], // 分享链接
      	imgUrl: wxData['imgUrl'], // 分享图标
      	success: function () {
         	// 用户确认分享后执行的回调函数
      	},
      	cancel: function () {
          	// 用户取消分享后执行的回调函数
      	}
    });
    /*分享到空间*/
  	wx.onMenuShareQZone({
  		title: wxData['title2'], // 分享标题
      	desc: wxData['desc'], // 分享描述
      	link: wxData['link'], // 分享链接
      	imgUrl: wxData['imgUrl'], // 分享图标
	    success: function () {
	       	// 用户确认分享后执行的回调函数
	    },
	    cancel: function () {
	        // 用户取消分享后执行的回调函数
	    }
	});
  });

  $(document).ready(function(){
        
        $('a.v-banner-link').click(function(){
              if ( ga && $.isFunction(ga)){
                  ga( 'send', 'event', 'Pre-下载页推广', '来源应用: YgYx', '' );
                  console.log('banner-link: 1');
              }
          });
        $('a.v-banner-close').click(function(){
                $('div.app-banner').hide();
                return false;
          });
          });

</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-30968675-8', 'auto');
  ga('send', 'pageview');

</script>

<?php 
    $sys=$_SERVER['HTTP_USER_AGENT'];
    if (stripos($sys,"iPhone")>0) {
?>
    <script type="text/javascript">
    function getQueryString(name) {  
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");  
        var r = window.location.search.substr(1).match(reg);  
        if (r != null) return unescape(r[2]); return null;  
    }  
  
    var tid = getQueryString("tid"); 
    if (tid) {
        window.location.href="hkdyh://"+tid;
    };
</script>
<?php  }else {?>
 <script type="text/javascript">
    function getQueryString(name) {  
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");  
        var r = window.location.search.substr(1).match(reg);  
        if (r != null) return unescape(r[2]); return null;  
    }  
  
    var tid = getQueryString("tid"); 
    if (tid) {
        window.location.href="hkdyh://dyh.app/openTable?tableID="+tid;
    };
</script>
<?php }?>
