#! /bin/sh

#head=$1
#tail=$2
#i=$head
#while [ $i -le $tail ]
#do
#	asterisk -rx "sip show peer $i" > /tmp/parse_result
#	result=`cat /tmp/parse_result | grep "Addr->IP" | sed 's/  Addr->IP     : //g'`
#	if [ "$result" = "(Unspecified) Port 0" ];then
##	echo -n 0
#	else
#	echo -n 1
#	fi
#	i=`expr $i + 1`
#done

asterisk -rx "sip show peer $1" > /tmp/parse_result
result=`cat /tmp/parse_result | grep "Addr->IP" | sed 's/  Addr->IP     : //g'`
if [ "result" = "(Unspecified) Port 0" ];then
r2="no"
else
r2="yes"
fi
