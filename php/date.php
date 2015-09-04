<html>
<head>
<title>依照日期查詢</title>
</head>
<body>
<form name="form" method="post" action="date_cdr.php">
<?PHP
$today = getdate();
?>

<font face="標楷體" size="4">
<H2>依照日期查詢</H2>

<font face="標楷體" size="4">從：</font>
<select size="1" name="year1">
<?PHP
for ($k=2006;$k<=$today["year"];$k++){
if ($k==$today["year"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select><font face="標楷體" size="4">年<select size="1" name="month1">

<?PHP
for ($k=1;$k<=12;$k++){
if ($k==$today["mon"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select>月<select size="1" name="day1">

<?PHP
for ($k=1;$k<=31;$k++){
if ($k==$today["mday"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select>日</font>


<font face="標楷體" size="4">
<font face="標楷體" size="4">到：</font>
<select size="1" name="year2">
<?PHP
for ($k=2006;$k<=$today["year"];$k++){
if ($k==$today["year"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select><font face="標楷體" size="4">年<select size="1" name="month2">

<?PHP
for ($k=1;$k<=12;$k++){
if ($k==$today["mon"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select>月<select size="1" name="day2">

<?PHP
for ($k=1;$k<=31;$k++){
if ($k==$today["mday"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select>日</font>

<br>
<font face="標楷體" size="4">
<input type="submit" name="Submit" value="查詢">
<input type=reset value=取消>
</form>

</body>
</html>
