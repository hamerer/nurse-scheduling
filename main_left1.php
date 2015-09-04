<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" href="main.css" type="text/css" media="all" />
<title>護士呼叫系統</title>
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
		<!--<img class="bg_img" width="100%" height="20%" alt="" src="./images/main2_08.jpg">!-->
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
    	<a href="javascript:show_child('schedule')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">護理站護士排班</a>
        <ul style="display:none">
<li>
<img border="0" src="./images/arrow.gif" ><a href='./nurse_schedule.php' target="left_frame">護士排班狀態</a>
            </li>
<li> 
<img border="0" src="./images/arrow.gif" ><a href='./manual.php' target="left_frame">手動護士排班</a>
            </li>


<li>
<img border="0" src="./images/arrow.gif" ><a href='./clear_nurse.php' target="left_frame">清除護士排班</a>
            </li>

        </ul>
</li>

<li id="auto">
    	<a href="javascript:show_child('auto')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">病房派班</a>
        <ul style="display:none">
		<li>
            	<img src="./images/arrow.gif"><a href='./today_schedule.php' target="left_frame">當天病房派班</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./stop_day.php' target="left_frame">當天病房停班</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./change_day.php' target="left_frame">當天病房換班</a>
            </li>
			<li>
            	<img src="./images/arrow.gif"><a href='./today_nurse_schedule.php' target="left_frame">當天病房護理師查詢</a>
            </li>
<li>
<img border="0" src="./images/arrow.gif" ><a href='./bed_system.php' target="left_frame">匯入匯出病房派班</a>
            </li>
        </ul>
</li>
<li id="nurse">
    	<a href="javascript:show_child('nurse')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">護士主檔</a>
        <ul style="display:none">
        	<li>
            	<img src="./images/arrow.gif"><a href='./nurse.php' target="left_frame">護理師資料</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./add_nurse.php' target="left_frame">新增護理師</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./del_nurse.php' target="left_frame">刪除護理師</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./nurse_modify.php' target="left_frame">修改護理師資料</</a>
            </li>

            <li>
            	<img src="./images/arrow.gif"><a href='./batch_nurse.php' target="left_frame">匯入護理師名單</</a>
            </li>

         

        </ul>
</li>

<li id="bed">
    	<a href="javascript:show_child('bed')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">病房管理</a>
        <ul style="display:none">
        	<li>
            	<img src="./images/arrow.gif"><a href='./all_bed.php' target="left_frame">病房病患資訊</a>
            </li>
			<li>
            	<img src="./images/arrow.gif"><a href='./nurse_call_status.php' target="left_frame">病房呼叫系統狀態</</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./batch.php' target="left_frame">新增病房床號</</a>
            </li>
       
        </ul>
</li>


<li id="car">
    	<a href="javascript:show_child('car')" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">工作車管理</a>
        <ul style="display:none">

<li>
<img border="0" src="./images/arrow.gif" ><a href='./device.php' target="left_frame">工作車狀態</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./add_device.php' target="left_frame">新增工作車</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./batch_device.php' target="left_frame">批次新增工作車</</a>
            </li>
        	<li>
            	<img src="./images/arrow.gif"><a href='./device_del.php' target="left_frame">刪除工作車</</a>
            </li>

        	<li>
            	<img src="./images/arrow.gif"><a href='./del_device.html' target="left_frame">刪除所有工作車</</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./modify_device.php' target="left_frame">修改工作車</a>
            </li>
        </ul>
</li>

    <li id="cdr">
    	<a href="javascript:show_child('cdr')" class="mainItem" target="left_frame"><img src="./images/down.png" width="20" height="23" border="0">呼叫記錄</a>
<ul style="display:none">
			
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./day_cdr.php' target="left_frame">護理站當日呼叫記錄</a>
            </li>
            <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./week_cdr.php' target="left_frame">護理站當週呼叫記錄</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./month_cdr.php' target="left_frame">護理站當月累計呼叫記錄</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./season_cdr.php' target="left_frame">護理站當季累計呼叫記錄</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./year_cdr.php' target="left_frame">護理站當年累計呼叫記錄</a>
            </li>
	    <li>
            	<img border="0" src="./images/arrow.gif" ><a href='./interval.php' target="left_frame">護理站指定時間累計呼叫記錄</a>
            </li>
         </ul>
</li>    

<li>
    	<a href="javascript:logout()" class="mainItem"><img src="./images/down.png" width="20" height="23" border="0">登出</a>
    </li>    
</ul>

</body>
</html>
