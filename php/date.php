<html>
<head>
<title>�̷Ӥ���d��</title>
</head>
<body>
<form name="form" method="post" action="date_cdr.php">
<?PHP
$today = getdate();
?>

<font face="�з���" size="4">
<H2>�̷Ӥ���d��</H2>

<font face="�з���" size="4">�q�G</font>
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
</select><font face="�з���" size="4">�~<select size="1" name="month1">

<?PHP
for ($k=1;$k<=12;$k++){
if ($k==$today["mon"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select>��<select size="1" name="day1">

<?PHP
for ($k=1;$k<=31;$k++){
if ($k==$today["mday"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select>��</font>


<font face="�з���" size="4">
<font face="�з���" size="4">��G</font>
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
</select><font face="�з���" size="4">�~<select size="1" name="month2">

<?PHP
for ($k=1;$k<=12;$k++){
if ($k==$today["mon"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select>��<select size="1" name="day2">

<?PHP
for ($k=1;$k<=31;$k++){
if ($k==$today["mday"]){
echo '<option value="'.$k.'" selected>'.$k.'</option>';
}else{
echo '<option value="'.$k.'">'.$k.'</option>';
}
}
?>
</select>��</font>

<br>
<font face="�з���" size="4">
<input type="submit" name="Submit" value="�d��">
<input type=reset value=����>
</form>

</body>
</html>
