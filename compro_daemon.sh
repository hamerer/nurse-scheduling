#!/bin/sh

i=1
while [ $i -lt 5 ]
do
asterisk -rx "sip show peer 600$i" > /tmp/parse_result
result=`cat /tmp/parse_result | grep "Addr->IP" | sed 's/  Addr->IP     : //g'`
if [ "$result" = "(Unspecified) Port 0" ];then
echo "Offline" > /tmp/test$i
else
echo "Online" > /tmp/test$i
fi
i=`expr $i + 1`
done



