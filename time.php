<?php
echo date("Ymd",strtotime("now")), "\n"; 
echo date("Ymd",strtotime("-1 week Monday")), "\n"; 
echo date("Ymd",strtotime("-1 week Sunday")), "\n"; 
echo date("Ymd",strtotime("+0 week Monday")), "\n"; 
echo date("Ymd",strtotime("+0 week Sunday")), "\n"; 


//date('n') �ĤL?�� 
//date("w") ���P�P�L 
//date("t") �����? 

echo '<br>�W�P:<br>'; 
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1-7,date("Y"))),"\n"; 
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7-7,date("Y"))),"\n"; 
echo '<br>���P:<br>'; 
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),"\n"; 
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))),"\n"; 

echo '<br>�W��:<br>'; 
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m")-1,1,date("Y"))),"\n"; 
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m") ,0,date("Y"))),"\n"; 
echo '<br>����:<br>'; 
echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),1,date("Y"))),"\n"; 
echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("t"),date("Y"))),"\n"; 

$getMonthDays = date("t",mktime(0, 0 , 0,date('n')+(date('n')-1)%3,1,date("Y")));//���u�ץ��̦Z�@���? 
echo '<br>���u��:<br>'; 
echo date('Y-m-d H:i:s', mktime(0, 0, 0,date('n')-(date('n')-1)%3,1,date('Y'))),"\n"; 
echo date('Y-m-d H:i:s', mktime(23,59,59,date('n')+(date('n')-1)%3,$getMonthDays,date('Y'))),"\n"; 
?>
