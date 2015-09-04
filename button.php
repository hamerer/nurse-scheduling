<html>
<head>
<title>TEST</title>
<body>

<SCRIPT LANGUAGE="JavaScript">
<!-- 	
// by Nannette Thacker
// http://www.shiningstar.net
// This script checks and unchecks boxes on a form
// Checks and unchecks unlimited number in the group...
// Pass the Checkbox group name...
// call buttons as so:
// <input type=button name="CheckAll"   value="Check All"
	//onClick="checkAll(document.myform.list)">
// <input type=button name="UnCheckAll" value="Uncheck All"
	//onClick="uncheckAll(document.myform.list)">
// -->

<!-- Begin
function checkAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
//  End -->
</script>

<div class="bg_button22" onmouseout="this.className=\'bg_button22\';" onmouseover="this.className=\'bg_button22-act\';">' .tep_draw_button_top() . '<a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-triangle-1-e"></span><span class="ui-button-text"><input type="checkbox" name="checkgroup[]" id="checkgroup" value="'.$listing['products_id'].'"/><label>'.  TEXT_COMPARE_CHECKBOX  .'</label></span></a>' . tep_draw_button_bottom().'</div>


<form name="myform" action="checkboxes.asp" method="post">
<b>Your Favorite Scripts & Languages</b><br>
<input type="checkbox" name="list" value="1">Java<br>
<input type="checkbox" name="list" value="2">Javascript<br>
<input type="checkbox" name="list" value="3">Active Server Pages<br>
<input type="checkbox" name="list" value="4">HTML<br>
<input type="checkbox" name="list" value="5">SQL<br>

<input type="button" name="CheckAll" value="Check All"
onClick="checkAll(document.myform.list)">
<input type="button" name="UnCheckAll" value="Uncheck All"
onClick="uncheckAll(document.myform.list)">
<br>
</form>
	 
</body>
</html>
