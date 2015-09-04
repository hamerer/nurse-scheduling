<?
/*** process asterisk cdr file (Master.csv) insert usage
 * values into a mysql database which is created for use
 * with the Asterisk_addons cdr_addon_mysql.so
 * The script will only insert NEW records so it is safe
 * to run on the same log over-and-over such as in the
 * case where logs have not been rotated.
 *
 * Author: John Lange (john.lange@open-it.ca)
 * Date: May 4, 2005. Updated July 21, 2005
 *
 * Here is what the script does:
 *
 * 1) Find the last log entry in the database cdr table.
 * 2) scan the asterisk logs until the dates are larger than the last log entry (so we don't duplicate entries)
 * 3) parse each row from the text log and insert it into the database.
 * 
 */

$locale_db_host  = 'localhost';
$locale_db_name  = 'asterisk';
$locale_db_login = 'root';
$locale_db_pass  = 'comproadmin';

if($argc == 2) {
    $logfile = $argv[1];
} else {
    print("Usage ".$argv[0]." <filename>");
    print("Where filename is the path to the Asterisk csv file to import (Master.csv)");
    print("This script is safe to run multiple times on a growing log file as it only imports records that are newer than the database");
    exit(0);
}

// connect to db
$linkmb = mysql_connect($locale_db_host, $locale_db_login, $locale_db_pass)
       or die("Could not connect : " . mysql_error());
//echo "Connected successfully";
mysql_select_db($locale_db_name, $linkmb) or die("Could not select database $locale_db_name");

/** 1) Find the last log entry **/
// look in cdr table to see when the last entry was made.
// this establishes the starting point for the asterisk data.
$sql="SELECT UNIX_TIMESTAMP(calldate) as calldate".
    "  FROM cdr".
    " ORDER BY calldate DESC".
    " LIMIT 1";

if(!($result = mysql_query($sql, $linkmb))) {
    print("Invalid query: " . mysql_error()."");
    print("SQL: $sql");
    die();
}
$result_array = mysql_fetch_array($result);
//$lasttimestamp = date("Y-m-d H:i:s", $result_array['voip_stamp']);
$lasttimestamp = $result_array['calldate'];

//** 2) Find new records in the asterisk log file. **

$rows = 0;
$handle = fopen($logfile, "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    // NOTE: the fields in Master.csv can vary. This should work by default on all installations but you may have to edit the next line to match your configuration
    list($accountcode,$src, $dst, $dcontext, $clid, $channel, $dstchannel, $lastapp, $lastdata, $start, $answer, $end, $duration,
     $billsec, $disposition, $amaflags ) = $data;
    
    // 3) parse each row and add to the database
    if(strtotime($end) > $lasttimestamp) { // we found a new record so add it to the DB
        $sql = "INSERT INTO cdr (calldate, clid, src, dst, dcontext, channel, dstchannel, lastapp, lastdata, duration, billsec, disposition, amaflags, accountcode)
                   VALUES('$end', '".mysql_real_escape_string($clid)."', '$src', '$dst', '$dcontext', '$channel', '$dstchannel', '$lastapp', '$lastdata', '$duration', '$billsec',
                    '$disposition', '$amaflags', '$accountcode')";
        if(!($result2 = mysql_query($sql, $linkmb))) {
            print("Invalid query: " . mysql_error()."");
            print("SQL: $sql");
            die();
        }
        $rows++;
    }
}
fclose($handle);

print("$rows imported");
?>