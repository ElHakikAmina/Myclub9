function passwordValid()
{
	var form = document.getElementById("loginForm");
	var password = document.getElementById("exampleInputPassword1").value;
	var regexPassword = document.getElementById("regexPassword");
	var pattern=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
	if(password.length<8)
	{
		regexPassword.style.color="#ff0000";
		regexPassword.innerHTML="the password must be at least 8 ";
	}
	if(password.length==0)
	{
		regexPassword.innerHTML="";
	}
	else if(password.length>=8)
	{
		regexPassword.innerHTML="";
	}
	if(password.match(pattern))
	{
		regexPassword.style.color="#00ff00";
		regexPassword.innerHTML+="<br>Password Valid";
	}else{
		regexPassword.style.color="#ff0000";
		regexPassword.innerHTML+="<br>Password must contain letters upper and lower and a number";
	}
	if(password == "")
	{
		regexPassword.innerHTML="";
	}
}
