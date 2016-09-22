function next()
{
	var obj=document.getElementById('current');
	var total=parseInt(document.getElementById('total').value);
	
	if(parseInt(obj.value)<total)
	{
		document.getElementById('tbl'+obj.value).style.display='none';
		document.getElementById('tbl'+ eval(eval(obj.value) + 1)).style.display='block';
		document.getElementById('current').value=eval(eval(obj.value)) + 1;		
	}
	
}
function prve()
{
	var obj=document.getElementById('current');
	var total=parseInt(document.getElementById('total').value);
	if(parseInt(obj.value)>1)
	{
		document.getElementById('tbl'+obj.value).style.display='none';
		document.getElementById('tbl'+ eval(eval(obj.value) - 1)).style.display='block';
		document.getElementById('current').value=eval(eval(obj.value)) - 1;		
	}
	
}

function checkIsImage(obj)
{
	var val=obj.value.split('.');
	var reg=RegExp(/^((j|J)(P|p)(G|g))|((G|g)(I|i)(F|f))|((B|b)(M|m)(P|p))|((J|j)(P|p)(E|e)(G|g))|((P|p)(N|n)(G|g))$/);
	if(val[val.length-1].match(reg)==null)
	{
		document.getElementById(obj.id).value="";
		alert('You can select only jpg, jpeg, bmp, gif or png files. The file you selected may not be uploaded');		
	}
}