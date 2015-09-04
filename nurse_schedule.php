<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>護理站護士排班狀態</title>

<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>
<Left><H2  align="middle"  class="style1">護理站護士排班狀態</H2>
<HR>
<table align=center  border=0 width="40%">
<tr>
<td>
<a href="#" onclick="window.open('./yestoday.php', 'Yestoday', config='height=600,width=800');">
<img src="./yestoday.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open('./today.php', 'Today', config='height=600,width=800');">
<img src="./today.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open('./tommorow.php', 'Tommorow', config='height=600,width=800');">
<img src="./tommorow.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>

</tr>
</table>

<HR>
<?php

include('./schedule.php');

?>
</body>
</html>
