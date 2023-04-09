function validateStaff() //validate staff registration
{	
	var type = document.forms["register"]["Admin"].value;
	if (type == "Y") 
	{
		var passcode = "mvsu1950";
		
		var answer = prompt("Enter the passcode");
		
		if(answer != passcode)
		{
			window.location.href = "../registerM.php?error=Incorrect passcode";
			return false;
		}
	}
}