<?

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/picture_do.log';

// Set to 1 to turn on the log file
$parm_debug_on = 0;

//GLOBAL $stdin, $stdout, $stdlog, $result, $parm_debug_on, $parm_test_mode;

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


if ($_FILES["file"]["error"] > 0){
	fputs($stdlog,  "Error: " . $_FILES["file"]["error"] . "\n");
} else { 
fputs($stdlog,  "檔案名稱: " . $_FILES["file"]["name"] ."\n");
fputs($stdlog,  "檔案類型: " . $_FILES["file"]["type"] . "\n");
fputs($stdlog,  "檔案大小: " . ($_FILES["file"]["size"] / 1024) ."\n");
fputs($stdlog,  "暫存名稱: " . $_FILES["file"]["tmp_name"] . "\n");

move_uploaded_file($_FILES["file"]["tmp_name"],"./uploads/".$_FILES["file"]["name"]);
}
$file = "./uploads/" . $_FILES["file"]["name"];
$image = "./images/main2_08.jpg" ;
exec("/usr/bin/sudo /bin/mv -f $file $image");

        if($parm_debug_on) {
                fputs($stdlog, "image file :  $file \n");
        } 

header("Location: ./bed_status.php");
exit;

?>
