function validEmail()
{
	var form=document.getElementById("loginForm");
	var email=document.getElementById("exampleInputEmail1").value;
	var regexpEmail=document.getElementById("regexpEmail");
	var pattern=/^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
	if(email.match(pattern))
	{
		regexpEmail.innerHTML="Email Valid";
		regexpEmail.style.color="#00ff00";
	}else{
		regexpEmail.innerHTML="Email non Valid";
		regexpEmail.style.color="#ff0000";
	}
	if(email == "")
	{
		regexpEmail.innerHTML="";
	}
	
}