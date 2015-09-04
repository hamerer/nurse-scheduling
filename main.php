<Html>
<head>
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" href="main.css" type="text/css" media="all" />
<title>Å@¤h©I¥s¨t²Î</title>
<style>
.left {
    bottom: 0;
    left: 0;
    position: absolute;
    width: 225px;
    z-index: 7;
	display:block;
	border-right:#000 solid 1px;
	height:100%;
	top:0px;
}

.right {
	top:0px;
    bottom: 0;
    position: absolute;
    right: 0;
    z-index: 7;
	left: 225px;
	height:100%;
}


</style>

<script language="javascript" src="../jack/js/jquery.js"></script>
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


</head>

<body>
<div class="left">
<iframe width="99.99%" height="100%" name="right_frame" frameborder="0" src="./main_left1.php" ></iframe>
</div>
<div class="right" style="background-color:#fff">
<iframe width="99.99%" height="100%" name="left_frame" frameborder="0" src="./nurse_schedule.php"></iframe>
</div>
</body>
</body>

</html>
