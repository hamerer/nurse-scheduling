<html>
<head>
<meta http-equiv="Content-Type" content="text/html">
<title></title>
</head>

<body>
<br>
<form action="batch_do.php" method="post" enctype="multipart/form-data" >
檔案名稱：<input type=file name="file" id="file">
<input type=submit name="submit" value="上傳">
</form>

</script>
檔案內容格式：  分機號碼,密碼,共振電話號碼,撥號權限
<br>
分機號碼為三碼或四瑪，密碼為0~9的八位數
<br>
撥號權限有prepaid(全部可撥)、mobile(可撥手機與市話)、fix(只能撥手機)、default(只能內撥)
<br>
例：201,12345678,0936920361,default
<br>

</body>
</html>
