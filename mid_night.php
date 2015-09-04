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
<ol id="toc">
    <li><a href="day.php">¤é¯Z</a></li>
    <li><a href="night.php">¤p©]¯Z</a></li>
    <li class="current"><a href="mid_night.php">¤j©]¯Z</a></li>
</ol>

<div class="content">
<iframe width="100%" height="100%" name="right_frame" frameborder="0" src="./assign_mid_bed.php" ></iframe>
</div>

</body>
</html>
