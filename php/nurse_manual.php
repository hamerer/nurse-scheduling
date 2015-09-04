<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>護理站手動護士排班</title>

<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>
<form name="form" method="post" action="manual_do_nurse.php">
<Left><H2  align="middle"  class="style1">護理站手動護士排班</H2>
<HR>
<?php

session_start();
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");

echo "<table border=1 width=50%>";
echo "<tr>";

echo " <td  width=30% align='center' >";
$id="press-button" . 1;
echo  "<div id='$id'><label><input type=radio  name=device  value='0'><span>日班</span></label></div>";
echo "</td>";
echo " <td  width=30% align='center' >";
$id="press-button" . 2;
echo  "<div id='$id'><label><input type=radio  name=device  value='1'><span>夜班</span></label></div>";
echo "</td>";
echo " <td  width=30% align='center' >";
$id="press-button" . 4;
echo  "<div id='$id'><label><input type=radio  name=device  value='2'><span>小夜班</span></label></div>";
echo "</td>";

echo "</tr>";
echo "</table>";

?>

<table border=1 width="50%">

  <tr>
     <td  width="10%"><span class="style1">護理師選取</span></td>
     <td  width="20%">
<font face="標楷體" size="4">從：</font>

<?php


        $query_RsCourse = "SELECT nurse FROM nurse where enable='0' ";
        $RsCourse = mysql_query($query_RsCourse) or die(mysql_error());
        $totalRows_RsCourse = mysql_num_rows($RsCourse);
        if($totalRows_RsCourse) {
        echo '<select name=nurse1>';
   echo '<option value="-">'. '--' .'</option>';
      while ($row = mysql_fetch_array($RsCourse, MYSQL_ASSOC))
      {
            echo '<option value="'.$row['nurse'].'">'.$row['nurse'].'</option>';
       }
            echo '</select>';
        }
        else
        {
        echo '所有排班工作分配完畢'; // no rows in tbl_course
        }
        echo '</td>';

?>
<td  width="20%">
<font face="標楷體" size="4">到：</font>
<?php

        $query_RsCourse = "SELECT nurse FROM nurse where enable='0' ";
        $RsCourse = mysql_query($query_RsCourse) or die(mysql_error());
        $totalRows_RsCourse = mysql_num_rows($RsCourse);
        if($totalRows_RsCourse) {
        echo '<select name=nurse2>';
   echo '<option value="-">'. '--' .'</option>';
            while ($row = mysql_fetch_array($RsCourse, MYSQL_ASSOC))
            {
            echo '<option value="'.$row['nurse'].'">'.$row['nurse'].'</option>';
            }
            echo '</select>';
        }
        else
        {
        echo '所有排班工作已經分配完畢'; // no rows in tbl_course
        }
        echo '</td>';
?>
</tr>
</table>

<HR>
<?php

echo "<table border=1 width=100% align='left'>";
echo "<tr>";
echo "<td width=8% align=middle>  班   別 </td>";
echo "<td width=90% align=middle>  值班護士 </td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "日  班";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  ") ;
while ($row=mysql_fetch_array($result)) {
    	echo "<td width=8% align=middle>  $row[0]  </td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "小夜班";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM nurse  ") ;
while ($row=mysql_fetch_array($result)) {
    	echo "<td width=8% align=middle>  $row[0]  </td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "大夜班";
echo "<td>";
$result = mysql_query("SELECT name,nurse FROM nurse  ") ;
while ($row=mysql_fetch_array($result)) {
    	echo "<td width=8% align=middle>  $row[0]  </td>";
}
echo "</tr>";

echo "</table>";

?>

<?php
/*
echo "<table border=1 width=100% align='center'>";

$j=1;
$result = mysql_query("select id,name,password,enable,nurse from nurse  ") ;
while ($row=mysql_fetch_array($result)){
	if (($j % 8) == 1){
		echo "<tr>";     
	}
if ($row[3]) {
	$color_result = mysql_query("SELECT color FROM device WHERE car=$row[4] ") ;
	$crow=mysql_fetch_array($color_result);
	echo "<td width=10% align='center'>";
	$id="press-button" . $crow[0];
	echo  "<div id='$id'><label><input type=hidden   name=ints[]  value='' ><span>$row[1]</span></label></div>";
	echo " </td>";
} else {
	echo "<td width=10% align='center'> "; 
	echo  "<div id='ck-button'><label><input type=checkbox  name=ints[] value=$row[2]><span>$row[1]</span></label></div>";
	echo "</td>";
}
	$j++;
}

echo "</tr>";
echo "</table>";
*/
mysql_close($link);
?>

<input type="submit" name="Submit" value="排班"><input type=reset value="取消"></th>
</form>  
</body>
</html>
