<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
.correct {
 background-color: #ee8;
}
</style>
</head>
<body>
<table><tr><td class="filled rd2">Team 1</td></tr>
<tr><td class="filled rd2">Team 2</td></tr>

<tr><td id="myteam">Team 1</td></tr></table>
<script type="text/javascript">
(function(){
  for(var i = 0, w = document.getElementById('myteam'), a; (a = document.getElementsByTagName("td")[i]); ++i){
    if(/\brd2\b/.test(a.className) && a.firstChild.nodeValue == w.firstChild.nodeValue){
      a.className += ' correct';
    }
  }
})();
</script>
</body>
</html>
