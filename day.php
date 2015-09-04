<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>My Homepage</title>

<script language="javascript">
$(document).ready(function(){
                height = $(window).height();
                width = $(window).width();
                $(".left").css("height",height);
                $(".right").css("height",height);
                left =  parseInt($(".left").css("width")) + 3;
                $(".right").css("left",left);
})

$(window).resize(function(){
                        height = $(window).height();
                        width = $(window).width();
                        $(".left").css("height",height);
                        $(".right").css("height",height);
                        left =  parseInt($(".left").css("width")) + 3;
                        $(".right").css("left",left);
                });

</script>

<link href="tabs.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");



?>

<ol id="toc">
    <li class="current"><a href="day.php">日班</a></li>
    <li><a href="night.php">小夜班</a></li>
    <li><a href="mid_night.php">大夜班</a></li>
</ol>

<div class="content">
<iframe width="100%" height="100%" name="right_frame" frameborder="0" src="./assign_day_bed.php" ></iframe>
</div>

</body>
</html>
