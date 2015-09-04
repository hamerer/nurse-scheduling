<html>
<?php
$myfile = fopen("/tmp/test1", "r") or die("Unable to open file!");
echo fgets($myfile);
$myfile1 = fopen("/tmp/test2", "r") or die("Unable to open file!");
echo fgets($myfile1)
?>

</html>
