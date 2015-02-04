function first_enter(type)
{
	document.getElementById("first").style.display = "none";
	document.getElementById("second").style.display = "block";
	if(type=="inter")
	document.getElementById("selection").value="inter";
	else
	document.getElementById("selection").value="intra";
	document.getElementById("back_button").style.display="block";	
	document.getElementById("event_description").style.display="none";	
}

function back_operation()
{
	if(document.getElementById("selection2").value=="enter")
	{
			document.getElementById("first").style.display = "none";
			document.getElementById("second").style.display = "block";
			document.getElementById("third").style.display="none";
			document.getElementById("selection2").value="none";
			document.getElementById("event_description").style.display="none";
	}
	else
	{
			document.getElementById("first").style.display = "block";
			document.getElementById("second").style.display = "none";
			document.getElementById("third").style.display="none";
			document.getElementById("back_button").style.display="none";
			document.getElementById("event_description").style.display="none";	
	}
}

function type(entry)
{
	var div=document.getElementById("event_list");
	document.getElementById("first").style.display = "none";
	document.getElementById("second").style.display = "none";
	document.getElementById("third").style.display="block";
	document.getElementById("event_description").style.display="block";	
	document.getElementById("event_list").style.display="block";	
	document.getElementById("selection2").value="enter";
	document.getElementById("back_button1").style.display="block";
	var text="";
	document.getElementById("event_selection").value=entry;
	if(document.getElementById("selection").value=="inter")
	{	
		if(entry=="literary")
		{
			text="<ol><li onClick='list_hover(this)'>Debate-Hindi (Single)</li><li onClick='list_hover(this)'>Debate–English (Single)</li><li onClick='list_hover(this)'>Extempore (Group)</li><li onClick='list_hover(this)'>Poetry – Hindi\\ English (Single) </li><li onClick='list_hover(this)'>Youth Parliament(Group)</li><li onClick='list_hover(this)'>Essay Writing – Hindi\\English (Single)</li><li onClick='list_hover(this)'>Travelogue</li><li onClick='list_hover(this)'>Creative Writing–Hindi\\English(Group)</li><li onClick='list_hover(this)'>Quiz (Group)</li></ol>";
		}
		else
		if(entry=="music")
		{
			text="<ol><li onClick='list_hover(this)'>Solo(Single)</li><li onClick='list_hover(this)'>Suf Classical Singing</li><li onClick='list_hover(this)'>Folk Singing</li><li onClick='list_hover(this)'>Choir Singing</li><li onClick='list_hover(this)'>Retro Unplugged(Single)</li><li onClick='list_hover(this)'>Instrumental (without using Traditional Instruments)</li></ol>";
		}
		else
		if(entry=="art")
		{
			text="<ol><li onClick='list_hover(this)'>Comic Strip(Single)</li><li onClick='list_hover(this)'>Rangoli</li><li onClick='list_hover(this)'>Graffi Art (Wall Painting)</li><li onClick='list_hover(this)'>Road Painting</li><li onClick='list_hover(this)'>Poster Making</li><li onClick='list_hover(this)'>Sketching</li><li onClick='list_hover(this)'>Face Painting</li><li onClick='list_hover(this)'>Clay Model</li><li onClick='list_hover(this)'>Tattoo Making</li><li onClick='list_hover(this)'>Banner Making</li></ol>";
		}
		else
		if(entry=="theature")
		{
			text="<ol><li onClick='list_hover(this)'>Street Play</li><li onClick='list_hover(this)'>Skit</li><li onClick='list_hover(this)'>Legendary Drama</li><li onClick='list_hover(this)'>Nartya-Natika</li><li onClick='list_hover(this)'>Stand-up Comedy</li></ol>";
		}
		else
		if (entry=="dance") 
		{
			text="<ol><li onClick='list_hover(this)'>Solo(Single)-Free Style</li><li onClick='list_hover(this)'>Group Dance-Bollywood</li><li onClick='list_hover(this)'>Classical Solo</li><li onClick='list_hover(this)'>Street Dance</li><li onClick='list_hover(this)'>Folk Dance</li><li onClick='list_hover(this)'>Face-off</li></ol>";
		}
		else
		if(entry=="photo")
		{
			text="<ol><li onClick='list_hover(this)'>SMVDU Cover Shot</li><li onClick='list_hover(this)'>Short Film Making</li><li onClick='list_hover(this)'>Ad Film Making</li><li onClick='list_hover(this)'>Photo presentation</li></ol>";
		}
		else
		if(entry=="special")
		{
			text="<ol><li onClick='list_hover(this)'>Flash Mob</li><li onClick='list_hover(this)'>On the Spot Hidden Talent</li><li onClick='list_hover(this)'>Fashion Show</li><li onClick='list_hover(this)'>Mila Kalpa</li></ol>";
		}
	}
	else
	{
		if(entry=="literary")
		{
			text="<ol><li onClick='list_hover(this)'>Debate</li><li onClick='list_hover(this)'>Quiz</li><li onClick='list_hover(this)'>Extempore</li></ol>";	
		}
		else
		if(entry=="music")
		{
			text="<ol><li onClick='list_hover(this)'>War of Bands</li><li onClick='list_hover(this)'>Light Indian Vocal</li></ol>";
		}
		else
		if(entry=="art")
		{
			text="<ol><li onClick='list_hover(this)'>Poster Making</li><li onClick='list_hover(this)'>Face Painting</li></ol>";
		}
		else
		if(entry=="theature")
		{
			text="<ol><li onClick='list_hover(this)'>One Act Play</li><li onClick='list_hover(this)'>Stand-Up Comedy</li><li onClick='list_hover(this)'>Street Play</li><li onClick='list_hover(this)'>Legendary Drama</li></ol>";
		}
		else
		if (entry=="dance") 
		{
			text="<ol><li onClick='list_hover(this)'>Solo Free Style</li><li onClick='list_hover(this)'>Classical Solo</li><li onClick='list_hover(this)'>Street Dance</li><li onClick='list_hover(this)'>Folk Dance</li></ol>";
		}
		else
		if(entry=="photo")
		{
			text="<ol><li onClick='list_hover(this)'>Short Film Making</li><li onClick='list_hover(this)'>Ad Film Making</li><li onClick='list_hover(this)'>SMVDU Cover Shot</li></ol>";
		}
		else
		if(entry=="special")
		{
			text="<ol><li onClick='list_hover(this)'>Fashion Show</li></ol>";
		}
	}
	div.innerHTML=text;
}

function display_event(type,event_type,event1)
{
	document.getElementById("event_list").style.display="block";
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
		var text="";
		xmlhttp.open("GET",'event.xml?val='+Math.random());
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					text=xmlhttp.responseXML;
					var rol=text.getElementsByTagName(type);
					var ev_ty=rol[0].getElementsByTagName(event_type);
					var role = ev_ty[0].getElementsByTagName("Event");
					for(var j=0;j<role.length;j++)
					{						
						var name = role[j].attributes.name.value;
						if(name==event1)
						{
							document.getElementById("event_description").innerHTML=role[j].childNodes[1].nodeValue;
						}
					}
				}	
		}
		xmlhttp.send();
	}
}


function list_hover(obj)
{
	var event_name=obj.innerHTML.trim();
	var event_type=document.getElementById("event_selection").value;
	var type=document.getElementById("selection").value;
	if(type="inter")
		type="inter_house";
	else
		type="inter_university";
	display_event(type,event_type,event_name);
}