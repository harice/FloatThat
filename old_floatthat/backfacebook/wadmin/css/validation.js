function condel()
		{
		var get_res = confirm("Did you like to delete this Record?");

		   if (get_res == true)
			  {
			  return true;
			  }
			  else
			  {
			  return false;
			  }
		}
		
		function condc()
		{
		var get_res = confirm("Did you like to disable this Record?");

		   if (get_res == true)
			  {
			  return true;
			  }
			  else
			  {
			  return false;
			  }
		}
		
		function conac()
		{
		var get_res = confirm("Did you like to active Record?");

		   if (get_res == true)
			  {
			  return true;
			  }
			  else
			  {
			  return false;
			  }
		}
		
		
		function condelapp()
		{
		var get_res = confirm("Did you like to delete this record?");

		   if (get_res == true)
			  {
			  return true;
			  }
			  else
			  {
			  return false;
			  }
		}
		
		function validateform()
		{
			var frm=document.frm;
			
			
			
			
			if(frm.fname.value=="")
			{
				alert('Please write your first name');
				frm.fname.focus();
				return false;
			}
			else if(frm.lname.value=="")
			{
				alert('Please write your last name');
				frm.lname.focus();
				return false;
			}
			if(frm.address.value=="")
			{
				alert('Please write your address');
				frm.address.focus();
				return false;
			}
			
			
			if(frm.country.value=="")
			{
				alert('Please select your country');
				frm.country.focus();
				return false;
			}
			else if(frm.prefersect.value=="")
			{
				alert('Please select your preferred sector');
				frm.prefersect.focus();
				return false;
			}
			else if(frm.minsal.value=="")
			{
				alert('Please write your required minimum salary');
				frm.minsal.focus();
				return false;
			}
			else if(frm.minirat.value=="")
			{
				alert('Please write your required  hours rat');
				frm.minirat.focus();
				return false;
			}
			
			else if(frm.nationality.value=="")
			{
				alert('Please select your nationality');
				frm.nationality.focus();
				return false;
			}
			
		}
		
		
		function partd()
	{
	    var TargetURL= "html/dbbackup.html.php"
        window.open(TargetURL,'','width=350,height=330,scrollbars=no,resizable=no,left=300,top=200');
	}