<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>�@�z�����ɨt��</title>

<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>
<Left><H2  align="middle"  class="style1">�@�z�����ɨt��</H2>
<HR>
<table align=center  border=0 width="40%">
<tr>
<td>
<a href="#" onclick="window.open(' http://tw.yahoo.com ', 'Yahoo', config='height=500,width=500');"><img src="./backward.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open(' http://tw.yahoo.com ', 'Yahoo', config='height=500,width=500');">
<img src="./yestoday.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open(' http://tw.yahoo.com ', 'Yahoo', config='height=500,width=500');">
<img src="./today.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open(' http://tw.yahoo.com ', 'Yahoo', config='height=500,width=500');">
<img src="./tommorow.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open(' http://tw.yahoo.com ', 'Yahoo', config='height=500,width=500');">
<img src="./forward.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>

</tr>
</table>

<HR>
<?php
session_start();
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("��Ʈw�}�ҿ��~�I");
mysql_select_db($dbName,$link) or die( "�L�k�����Ʈw�I");
?>

<form name="form" method="post" action="assign_do_bed.php">

<?php
echo "<table border=1 width=100%>";
echo "<tr>";
$sql = "SELECT  car,color  FROM device ";
$result= mysql_query($sql);
$num = mysql_num_rows($result);
while ($rows=mysql_fetch_array($result)){
	echo " <td  width=10% align='center' >";
	$id="press-button" . $rows[1];
	echo  "<div id='$id'><label><input type=radio  name=device  value=$rows[0]><span>�@�z �v $rows[0]</span></label></div>";
  	echo "</td>";
}
echo "</tr>";
echo "</table>";

?>
<HR>
<table border=1 width="50%">
  <tr>
     <td  width="10%"><span class="style1">�ɸ����</span></td>
     <td  width="20%">
<font face="�з���" size="4">�q�G</font>

<?php

        $query_RsCourse = "SELECT name FROM bed where enable='0' ";
        $RsCourse = mysql_query($query_RsCourse) or die(mysql_error());
        $totalRows_RsCourse = mysql_num_rows($RsCourse);
        if($totalRows_RsCourse) {
        echo '<select name=bed1>';
   echo '<option value="-">'. '--' .'</option>';
      while ($row = mysql_fetch_array($RsCourse, MYSQL_ASSOC))
      {
            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
       }
            echo '</select>';
        }
        else
        {
        echo '�Ҧ��ɸ��w���t����'; // no rows in tbl_course
        }
        echo '</td>';

?>
<td  width="20%">
<font face="�з���" size="4">��G</font>
<?php

        $query_RsCourse = "SELECT name FROM bed where enable='0' ";
        $RsCourse = mysql_query($query_RsCourse) or die(mysql_error());
        $totalRows_RsCourse = mysql_num_rows($RsCourse);
        if($totalRows_RsCourse) {
        echo '<select name=bed2>';
   echo '<option value="-">'. '--' .'</option>';
            while ($row = mysql_fetch_array($RsCourse, MYSQL_ASSOC))
            {
            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
            }
            echo '</select>';
        }
        else
        {
        echo '�Ҧ��ɸ��w���t����'; // no rows in tbl_course
        }
        echo '</td>';
?>
    
</tr>
</table>

<?php

echo "<table border=1 width=100% align='center'>";

$j=1;
$result = mysql_query("select id,name,phone,enable,device from bed  ") ;
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
mysql_close($link);
?>
<input type="submit" name="Submit" value="���Z"><input type=reset value="����"></th>
</form>  
</body>
</html>
