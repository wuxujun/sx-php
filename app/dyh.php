<!DOCTYPE html>
<html> 

<head>
    <meta charset="utf-8">
    <title>加入德友会 </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="游戏">
    <meta name="author" content="Muhammad Usman">
</head>
<body>
<p>友情提示:</p>
<?php 
    $sys=$_SERVER['HTTP_USER_AGENT'];
    if (stripos($sys,"iPhone")>0) {
        echo "<div>iPhone手机请使用自带Safari打开</div>";
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
<?php  }else if(stripos($sys,"Android")>0){
    echo "Android手机请使用浏览打开.";
    ?>
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
<?php 
}
?>
<br>
<br>
<div>德友会</div>
<br>
<a href="itms-services://?action=download-manifest&url=https://app.175joy.com/dyh.plist">iPhone版</a>
<br><br>
<a href="https://app.175joy.com/TexasPoker-release-signed.apk">Android版下载</a>
<br>
</body>
</html>
