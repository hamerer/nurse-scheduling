<html>
<head>
<meta http-equiv="Content-Type" content="text/html">
<title></title>
</head>

<body>
<br>
<form action="nurse_do_file.php" method="post" enctype="multipart/form-data" >
檔案名稱：<input type=file name="file" id="file">
<input type=submit name="submit" value="上傳">
</form>

</script>
檔案內容格式： 護理站號碼，護理師帳號，護理師名稱，班別，日期
<br>
護理站號碼為五碼，護理師帳號為三碼
<br>
班別：日班為day，小夜班為night，大夜班為mid_night
<br>
日期格式為20NN-XX-YY，XX為月份，YY為日期
<br>
<br>

例：11101,101,徐佳青,day,2014-09-07
<br>
例：11201,201,楊惠君,night,2014-11-26
<br>
例：11202,301,劉宜芳,mid_night,2014-02-26
<br>

</body>
</html>
