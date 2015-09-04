<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" href="main.css" type="text/css" media="all" />
<title>�@�h�I�s�t��</title>
<style>
ul{
	font-size: 100%;
    padding: 0px;
    margin: 0px;
}

ul li a{
	font-weight:bold;
	color:#3B5999;
	text-decoration:none;
	vertical-align:bottom;
}

ul li a:hover{
	background-color:#CDD8E6;
}

ul li{
	list-style: none;
    padding 5px;
    padding-left: 10px;
	margin-bottom:2px;
    white-space: nowrap;
    line-height: 20px;
}


.mainItem {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #333333;
	text-decoration: none;
	font-weight: bold;
}

.bgdiv {
	float:left;
}

</style>
<script language="javascript" src="../jack/js/jquery.js"></script>
<script language="javascript">

$(document).ready(function(){
	
	var name = getCookie("user");
	
	
	if(name != "admin"){
		$("#config").css("display","none");
	}
	
	
	get_time();
	setInterval(get_time,1000);
})

function show_child(obj){
	obj = "#"+obj;
	if($(obj).children("ul").css("display") == "block"){
		$(obj).children("ul").css("display","none");
		return;
	}else{
		$(obj).children("ul").css("display","block");
		
	}
}

function get_time(){
	var myDate = new Date();
	
	myDate.getYear();       
	myDate.getFullYear();   
	myDate.getMonth();     
	myDate.getDate();       
	myDate.getDay();        
	myDate.getTime();       
	myDate.getHours();      
	myDate.getMinutes();    
	myDate.getSeconds();    
	myDate.getMilliseconds();   
	
	
	var mytime_d=myDate.toLocaleDateString();
	var mytime_t=myDate.toLocaleTimeString();
	$("#time_date").html(mytime_d);
	$("#time_time").html(mytime_t);
}

function setCookie(name, value) 
{ 
    var argv = setCookie.arguments; 
    var argc = setCookie.arguments.length; 
    var expires = (argc > 2) ? argv[2] : null; 
    if(expires!=null) 
    { 
        var LargeExpDate = new Date (); 
        LargeExpDate.setTime(LargeExpDate.getTime() + (expires*1000*3600*24));         
    } 
    document.cookie = name + "=" + escape (value)+((expires == null) ? "" : ("; expires=" +LargeExpDate.toGMTString())); 
}

function getCookie(Name) 
{ 
    var search = Name + "=" 
    if(document.cookie.length > 0) 
    { 
        offset = document.cookie.indexOf(search) 
        if(offset != -1) 
        { 
            offset += search.length 
            end = document.cookie.indexOf(";", offset) 
            if(end == -1) end = document.cookie.length 
            return unescape(document.cookie.substring(offset, end)) 
        } 
        else return "" 
    } 
} 


function logout(){
	var expdate = new Date(); 
    expdate.setTime(expdate.getTime() - (86400 * 1000 * 1)); 
    setCookie("user", "", expdate);  
	parent.location.href = "./index.html";
}




</script>




</head>

<body style="background-color:#F0F0F0">

<div style="width:100%;">
    <div style=" float:left; margin-left:0px;">
		<img class="bg_img" width="100%" height="20%" alt="" src="./images/main2_08.jpg">
    </div>
</div>    

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div style="margin-left:20px; ma">
	<img class="bg_img" src="./images/date.png" width="31" height="29">
    <span id="time_date" style="width:70%; font-size:16px; text-align:left; vertical-align:bottom"></span>

<br>
    
    <img class="bg_img" src="./images/time.png" width="31" height="29">
    <span id="time_time" style="width:70%; font-size:16px; text-align:left; vertical-align:bottom"></span>
    </div>
    
</div>

<br>
<br>

<ul style="margin-left:20px;">
<li id="schedule">
    	<a href="javascript:show_child('schedule')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�@�z���@�h�ƯZ</a>
        <ul style="display:none">
<li>
<img border="0" src="./images/arrow.gif" ><a href='./nurse_schedule.php' target="left_frame">�@�h�ƯZ���A</a>
            </li>

<li>
<img border="0" src="./images/arrow.gif" ><a href='./nurse_input.php' target="left_frame">�t�ζפJ�@�h�ƯZ</a>
            </li>
<li>
<img border="0" src="./images/arrow.gif" ><a href='./nurse_manual.php' target="left_frame">����@�h�ƯZ</a>
            </li>
        </ul>
</li>

<li id="assign">
    	<a href="javascript:show_child('assign')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�@�z���f�ɬ��Z</a>
        <ul style="display:none">
<li>
<img border="0" src="./images/arrow.gif" ><a href='./bed_status.php' target="left_frame">��Z�f�ɬ��Z���A(�ϫ�)</a>
            </li>
<li>
<img border="0" src="./images/arrow.gif" ><a href='./bed.php' target="left_frame">��Z�f�ɬ��Z���A(��櫬)</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./nurse_status.php' target="left_frame">��Z�@�h���Z�t�ɪ��A</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./assign_bed.php' target="left_frame">�f�ɬ��Z</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./stop_bed.php' target="left_frame">�f�ɰ��Z</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./change_bed.php' target="left_frame">�f�ɴ��Z</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./clear_bed.html' target="left_frame">��Z�M���¬��Z</a>
            </li>

        </ul>
</li>

<li id="nurse">
    	<a href="javascript:show_child('nurse')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�@�h�D��</a>
        <ul style="display:none">
        	<li>
            	<img src="./images/arrow.gif"><a href='./nurse.php' target="left_frame">�@�z�v���</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./add_nurse.php' target="left_frame">�s�W�@�z�v</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./del_nurse.php' target="left_frame">�R���@�z�v</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./nurse_modify.php' target="left_frame">�ק��@�z�v���</</a>
            </li>

            <li>
            	<img src="./images/arrow.gif"><a href='./batch_nurse.php' target="left_frame">�פJ�@�z�v�W��</</a>
            </li>

            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./color_nurse.php' target="left_frame">�]�w�@�z�v�C��</a>
            </li>

            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./batch_color.php' target="left_frame">�פJ�@�z�v�C��</a>
            </li>

        </ul>
</li>

<li id="bed">
    	<a href="javascript:show_child('bed')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�f�ɺ޲z</a>
        <ul style="display:none">
        	<li>
            	<img src="./images/arrow.gif"><a href='./batch.php' target="left_frame">�妸�s�W�ɸ�</</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./del.html' target="left_frame">�R���Ҧ��ɸ�</</a>
            </li>

        </ul>
</li>

<li id="device">
    	<a href="javascript:show_child('device')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�q�T�˸m�޲z</a>
        <ul style="display:none">
<li>
<img border="0" src="./images/arrow.gif" ><a href='./device.php' target="left_frame">�q�T�˸m���A</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./batch_device.php' target="left_frame">�妸�s�W�q�T�˸m</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./del_device.html' target="left_frame">�R���Ҧ��q�T�˸m</</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./modify_device.php' target="left_frame">�ק�q�T�˸m</a>
            </li>
            <li>
            <img border="0" src="./images/arrow.gif" ><a href='./support.php' target="left_frame">�ƴ��@�h�q�T�覡</a>
            </li>
        </ul>
</li>

<li id="picture">
    	<a href="javascript:show_child('picture')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�ܧ��@�z���ϥ�</a>
        <ul style="display:none">
<li>
<img border="0" src="./images/arrow.gif" ><a href='./picture.php' target="left_frame">�פJ�@�z���ϥ�</a>
            </li>
        </ul>
</li>

<li id="monitor">
    	<a href="javascript:show_child('monitor')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�t�κʱ�</a>
        <ul style="display:none">

	<li>
            	<img border="0" src="./images/arrow.gif" ><a href='./cpu/index.html' target="left_frame">����CPU���A��</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./ram/index.html' target="left_frame">�����O���骬�A��</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./mrtg/index.html' target="left_frame">���������y�q��</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./temp/index.html' target="left_frame">�����ūת��A��</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./fan/index.html' target="left_frame">�����������A��</a>
            </li>

                     </ul>
</li>

    <li id="cdr">
    	<a href="javascript:show_child('cdr')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�q�ܰO��</a>
        <ul style="display:none">
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./day_cdr.php' target="left_frame">�@�z�����q�ܰO��</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./week_cdr.php' target="left_frame">�@�z����g�q�ܰO��</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./month_cdr.php' target="left_frame">�@�z�����֭p�q�ܰO��</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./season_cdr.php' target="left_frame">�@�z����u�֭p�q�ܰO��</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./year_cdr.php' target="left_frame">�@�z����~�֭p�q�ܰO��</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./date.php' target="left_frame">�@�z�����w�ɶ��֭p�q�ܰO��</a>
            </li>
         </ul>
</li>    

    <li id="normal_call">
    	<a href="javascript:show_child('normal_call')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�@��I�s���R</a>
        <ul style="display:none">
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./nday_cdr.php' target="left_frame">�@��I�s�����R</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./nweek_cdr.php' target="left_frame">�@��I�s��g���R</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./nmonth_cdr.php' target="left_frame">�@��I�s�����R</a>
            </li>
            	<img border="0" src="./images/arrow.gif" ><a href='./nseason_cdr.php' target="left_frame">�@��I�s��u���R</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./nyear_cdr.php' target="left_frame">�@��I�s��~���R</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./date.php' target="left_frame">�@��I�s��ƱƦ�]</a>
            </li> 
	 <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./date.php' target="left_frame">�@��I�s�@�h�Ʀ�]</a>
            </li> 
</ul>
</li>

    <li id="e_call">
    	<a href="javascript:show_child('e_call')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">���I�s���R</a>
        <ul style="display:none">
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./eday_cdr.php' target="left_frame">���I�s�����R</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./day_cdr.php' target="left_frame">���I�s��g���R</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./month_cdr.php' target="left_frame">���I�s�����R</a>
            </li>
	 <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./month_cdr.php' target="left_frame">���I�s��u���R</a>
            </li>

	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./year_cdr.php' target="left_frame">���I�s��~���R</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./date.php' target="left_frame">���I�s��ƱƦ�]</a>
            </li> 
	 <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./date.php' target="left_frame">���I�s�@�h�Ʀ�]</a>
            </li> 
</ul>
</li>
    
<li>
    	<a href="javascript:logout()" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">�n�X</a>
    </li>    
</ul>

</body>
</html>
