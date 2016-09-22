function SelectOption(OptionListName, ListVal)
{
	for (i=0; i < OptionListName.length; i++)
	{
		if (OptionListName.options[i].value == ListVal)
		{
			OptionListName.selectedIndex = i;
			break;
		}
	}
}		


var checkflag = "false";
function check(field) {
if (checkflag == "false") {
  for (i = 0; i < field.length; i++) {
  field[i].checked = true;}
  checkflag = "true";
  return "Uncheck all"; }
else {
  for (i = 0; i < field.length; i++) {
  field[i].checked = false; }
  checkflag = "false";
  return "Check all"; }
}


function delete_confirm(id)
{
  if(confirm("Are you sure you want to delete this record?"))
    return true;
  else
    return false;
}


