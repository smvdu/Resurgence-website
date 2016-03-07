function submit_fun() {
	//alert(document.getElementsByName("join_date")[0].value);2014-10-01
	if(document.getElementsByName("full_name")[0].value!="" && document.getElementsByName("college")[0].value!=""&&document.getElementsByName("email")[0].value!=""&&document.getElementsByName("phone_no")[0].value!=""&&document.getElementsByName("event")[0].value!="")
	{
		 var name = document.getElementsByName("full_name")[0].value;
		 var email = document.getElementsByName("email")[0].value;
		 var college =document.getElementsByName("college")[0].value;
                 var phone_no = document.getElementsByName("phone_no")[0].value;
	       var event = document.getElementsByName("event")[0].value;
        
        if(!validateEmail(email)){
            alert("Email not valid!!!");
		    return ;
        }
        
        if(!validatePhoneNo(phone_no)){
            alert("Phone No. not valid!!!");
		    return ;
        }
        
        
		var xmlhttp=false;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		if(xmlhttp)
		{
			
			xmlhttp.open("GET",'reg.php?name='+name+'&email='+email+'&college='+college+'&phone_no='+phone_no+'&event='+event);
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
					alert(""+xmlhttp.responseText);		
			}
			xmlhttp.send();		
		}				
	}
	else
	{
		alert("Some Fields are Empty");
		return ;
	}
}

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}



function validatePhoneNo(phone_no) { 
    var re = /^\d{10}$/; 
    return re.test(phone_no);
}
