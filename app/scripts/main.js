var setObj;
var xmlResponseText;
window.onload=function(e){
	setTimeout(enableEvent, 2000);
	if(screen.availWidth<900||screen.width<900)
	{
		document.getElementById("event_list").setAttribute("style", " float: none;width: 100%;height: auto;overflow-y:visible;");
	}
	document.getElementById("selection").value="intra";
	document.getElementById("third").style.display="none";	
	document.getElementById("event_description").style.display="none";
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
		xmlhttp.open("GET",'event.xml?math=3');
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					xmlResponseText=xmlhttp.responseXML;
				}	
		}
		xmlhttp.send();
	}
}

function display_stop(){
   document.getElementById("whole_event").style.display="none";
}

function timerStart()
{
	setTimeout(enableEvent, 2000);
}

function enableEvent() {
   document.getElementById("whole_event").style.display="block";
}


function back_operation()
{
	if(document.getElementById("selection2").value=="enter")
	{
			document.getElementById("second").style.display = "block";
			document.getElementById("third").style.display="none";
			document.getElementById("selection2").value="none";
			document.getElementById("event_description").style.display="none";
			document.getElementById("back_button1").style.display="none";
	}
}

function type(entry)
{
	var div=document.getElementById("event_list");
	document.getElementById("second").style.display = "none";
	document.getElementById("third").style.display="block";
	document.getElementById("event_description").style.display="block";	
	document.getElementById("event_list").style.display="block";	
	document.getElementById("selection2").value="enter";
	document.getElementById("back_button1").style.display="block";
	var text="";
	document.getElementById("event_selection").value=entry;
		{
		if(entry=="literary")
		{
			text="<ol><li onClick='list_hover(this)'>Debate</li><li onClick='list_hover(this)'>Quiz</li><li onClick='list_hover(this)'>Group Extempore</li></ol>";	
		}
		else
		if(entry=="music")
		{
			text="<ol><li onClick='list_hover(this)'>War of Bands</li><li onClick='list_hover(this)'>Dreamovation</li></ol>";
		}
		else
		if(entry=="art")
		{
			text="<ol><li onClick='list_hover(this)'>Poster Making</li><li onClick='list_hover(this)'>Face Painting</li></ol>";
		}
		else
		if(entry=="theature")
		{
			text="<ol><li onClick='list_hover(this)'>Skit</li><li onClick='list_hover(this)'>Legendary Drama</li></ol>";
		}
		else
		if (entry=="dance") 
		{
			text="<ol><li onClick='list_hover(this)'>Desi Beat.</li><li onClick='list_hover(this)'>Classical Solo</li><li onClick='list_hover(this)'>Street Dance</li><li onClick='list_hover(this)'>Folk Dance</li></ol>";
		}
		else
		if(entry=="photo")
		{
			text="<ol><li onClick='list_hover(this)'>Short Film Making</li><li onClick='list_hover(this)'>Ad Film Making</li></ol>";
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
	var rol=xmlResponseText.getElementsByTagName(type);
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

function display_default_uni(event_name)
{
	var type=document.getElementById("selection").value;
	if(type=="intra")
		type="inter_university";
	else
		return;
	var allLi=document.getElementById("event_list").getElementsByTagName("li");	
	allLi[0].style.color="black";
	allLi[0].style.fontWeight="bold";
	var event_type=document.getElementById("event_selection").value;
	display_event(type,event_type,event_name);
}
function display_default(event_name)
{
	var type=document.getElementById("selection").value;
	if(type=="inter")
		type="inter_house";
	else
		return;
	var allLi=document.getElementById("event_list").getElementsByTagName("li");	
	allLi[0].style.color="black";
	allLi[0].style.fontWeight="bold";
	var event_type=document.getElementById("event_selection").value;
	display_event(type,event_type,event_name);
}

function list_hover(obj)
{
	var event_name=obj.innerHTML.trim();
	var event_type=document.getElementById("event_selection").value;
	var type=document.getElementById("selection").value;
	if(type=="inter")
		type="inter_house";
	else
		type="inter_university";
	var allLi=document.getElementById("event_list").getElementsByTagName("li");
	for(var i=0;i<allLi.length;i++)
	{
		allLi[i].style.color="white";
		allLi[i].style.fontWeight="normal";		
	}
	obj.style.color="black";
	obj.style.fontWeight="bold";
	event.stopPropagation();
	display_event(type,event_type,event_name);
}