
<html>
<head>
<title>��Z�@�z�����ɨt��</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>

<HR>
<?php

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/assign_day_bed.log';

// Set to 1 to turn on the log file
$parm_debug_on = 0;

$stdin = fopen('php://stdin', 'r');
$stdout = fopen('php://stdout', 'w');

if ($parm_debug_on) {
        $stdlog = fopen($parm_error_log, 'w');
        fputs($stdlog, "---Start---\n");
}

while(!feof($stdin)) {
        $temp = fgets($stdin);
        if ($parm_debug_on)
                fputs($stdlog, $temp);

        $temp = str_replace("\n", "", $temp);

        $s = explode(":", $temp);
        $agivar[$s[0]] = trim($s[1]);
        if (($temp == "") || ($temp == "\n")) {
                break;
       }
}

session_start();
date_default_timezone_set('Asia/Chongqing');
$now = date("Y-m-d");
$now_like = date("Y-m-d") . "%";
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("��Ʈw�}�ҿ��~�I");
mysql_select_db($dbName,$link) or die( "�L�k�����Ʈw�I");
?>


<img src="images/room1012.jpg" WIDTH="1000"><br>

<table border=0 >

<tr colspan=2>���Z�@�z�v���w<br></tr>
<tr>
<?php
$result = mysql_query("SELECT day_nurse FROM bed WHERE bed='15' ") ;
while ($row=mysql_fetch_array($result)) {
    	echo "$row[0]";
    
}
//}
echo "</tr>";
echo "</table>";

?>

<br>

<table border=0 >
<tr colspan=2>�]�Z�@�z�v���w<BR></tr>
<tr>
<?php
$result = mysql_query("SELECT night_nurse FROM bed WHERE bed='15' ") ;
while ($row=mysql_fetch_array($result)) {
    	echo "$row[0]";
    
}
//}
echo "</tr>";
echo "</table>";
echo "</tr>";
echo "</table>";

?>

<br>

<table border=0 >
<tr colspan=2>�j�]�Z�@�z�v���w<BR></tr>
<tr>
<?php
$result = mysql_query("SELECT mid_nurse FROM bed WHERE bed='15' ") ;
while ($row=mysql_fetch_array($result)) {
    	echo "$row[0]";
    
}
//}
echo "</tr>";
echo "</table>";
echo "</tr>";
echo "</table>";

?>
<HR>
 
</body>
</html>


