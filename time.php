<?php
echo date("Ymd",strtotime("now")), "\n"; 
echo date("Ymd",strtotime("-1 week Monday")), "\n"; 
echo date("Ymd",strtotime("-1 week Sunday")), "\n"; 
echo date("Ymd",strtotime("+0 week Monday")), "\n"; 
echo date("Ymd",strtotime("+0 week Sunday")), "\n"; 


//date('n') 第几?月 
//date("w") 本周周几 
//date("t") 本月天? 

echo '<br>上周:<br>'; 
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1-7,date("Y"))),"\n"; 
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7-7,date("Y"))),"\n"; 
echo '<br>本周:<br>'; 
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),"\n"; 
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))),"\n"; 

echo '<br>上月:<br>'; 
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m")-1,1,date("Y"))),"\n"; 
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m") ,0,date("Y"))),"\n"; 
echo '<br>本月:<br>'; 
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),1,date("Y"))),"\n"; 
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("t"),date("Y"))),"\n"; 

$getMonthDays = date("t",mktime(0, 0 , 0,date('n')+(date('n')-1)%3,1,date("Y")));//本季度未最后一月天? 
echo '<br>本季度:<br>'; 
echo date('Y-m-d H:i:s', mktime(0, 0, 0,date('n')-(date('n')-1)%3,1,date('Y'))),"\n"; 
echo date('Y-m-d H:i:s', mktime(23,59,59,date('n')+(date('n')-1)%3,$getMonthDays,date('Y'))),"\n"; 
?>
