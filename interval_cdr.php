<html><head>
<title>¬d¸ßµ²ªG</title>
</head><body>
<?
$number=$_REQUEST["number"];
?>

</body></html>

<?php   
 $dbhost = 'localhost';   
 $dbuser = 'root';   
 $dbpass = 'comproadmin';   
 $dbname = 'asterisk11';   
 $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
  
  mysql_query("SET NAMES 'utf8'");
  mysql_select_db($dbname);   
  $sql = "select * from bed where id = ".$number;
  $result = mysql_query($sql) or die('MySQL query error');
  
  while($row = mysql_fetch_array($result))
  {
   echo $row['name']." ";
   echo $row['day_nurse']."<br>";   
  }
?>
