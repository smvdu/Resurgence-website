function first_enter(type)
{
	document.getElementById("first").style.display = "none";
	document.getElementById("second").style.display = "block";
	if(type=="inter")
	document.getElementById("selection").value="inter";
	else
	document.getElementById("selection").value="intra";
	document.getElementById("back_button").style.display="block";		
}

function back_operation()
{
	if(document.getElementById("selection2").value=="enter")
	{
			document.getElementById("first").style.display = "none";
			document.getElementById("second").style.display = "block";
			document.getElementById("third").style.display="none";
			document.getElementById("selection2").value="none";
	}
	else
	{
			document.getElementById("first").style.display = "block";
			document.getElementById("second").style.display = "none";
			document.getElementById("third").style.display="none";
			document.getElementById("back_button").style.display="none";
	}
}

function type(entry)
{
	var div=document.getElementById("third");
	document.getElementById("first").style.display = "none";
	document.getElementById("second").style.display = "none";
	document.getElementById("third").style.display="block";
	document.getElementById("selection2").value="enter";
	if(document.getElementById("selection").value=="inter")
	{	
		if(entry=="literary")
		{
			div.innerHTML="<ol><li class='button' href='#openModal'> Debate-Hindi (Single)</li><li>Debate–English (Single)</li><li>Extempore (G)</li><li>Poetry – Hindi\\ English (S) </li><li>Youth Parliament(G)</li><li>Essay Writing – Hindi\\English (S)</li><li>Travelogue</li><li>Creative Writing–Hindi\\English(G)</li><li>Quiz (G)</li></ol>";
		}
		else
		if(entry=="music")
		{
			div.innerHTML="<ol><li> Solo(S)</li><li>Suf Classical Singing</li><li>Folk Singing</li><li>Choir Singing</li><li>Retro Unplugged(S)</li><li>Instrumental (without using Traditional Instruments)</li></ol>";
		}
		else
		if(entry=="art")
		{
			div.innerHTML="<ol><li>Comic Strip(S)</li><li>Rangoli</li><li>Graffi Art (Wall Painting)</li><li>Road Painting</li><li>Poster Making</li><li>Sketching</li><li>Face Painting</li><li>Clay Model</li><li>Tattoo Making</li><li>Banner Making</li></ol>";
		}
		else
		if(entry=="theature")
		{
			div.innerHTML="<ol><li>Street Play</li><li>Skit</li><li>Legendary Drama</li><li>Nartya-Natika</li><li>Stand-up Comedy</li></ol>";
		}
		else
		if (entry=="dance") 
		{
			div.innerHTML="<ol><li>Solo(S)-Free Style</li><li>Group Dance-Bollywood</li><li>Classical Solo</li><li>Street Dance</li><li>Folk Dance</li><li>Face-off</li></ol>";
		}
		else
		if(entry=="photo")
		{
			div.innerHTML="<ol><li>SMVDU Cover Shot</li><li>Short Film Making</li><li>Ad Film Making</li><li>Photo presentation</li></ol>";
		}
		else
		if(entry=="special")
		{
			div.innerHTML="<ol><li>Flash Mob</li><li>On the Spot Hidden Talent</li><li>Fashion Show</li><li>Mila Kalpa</li></ol>";
		}
	}
	else
	{
		if(entry=="literary")
		{
			div.innerHTML="<ol><li>Debate</li><li>Quiz</li><li>Extempore</li></ol>";	
		}
		else
		if(entry=="music")
		{
			div.innerHTML="<ol><li>War of Bands</li><li>Light Indian Vocal</li></ol>";
		}
		else
		if(entry=="art")
		{
			div.innerHTML="<ol><li>Poster Making</li><li>Face Painting</li></ol>";
		}
		else
		if(entry=="theature")
		{
			div.innerHTML="<ol><li>One Act Play</li><li>Stand-Up Comedy</li><li>Street Play</li><li>Legendary Drama</li></ol>";
		}
		else
		if (entry=="dance") 
		{
			div.innerHTML="<ol><li>Solo Free Style</li><li>Classical Solo</li><li>Street Dance</li><li>Folk Dance</li></ol>";
		}
		else
		if(entry=="photo")
		{
			div.innerHTML="<ol><li>Short Film Making</li><li>Ad Film Making</li><li>SMVDU Cover Shot</li></ol>";
		}
		else
		if(entry=="special")
		{
			div.innerHTML="<ol><li>Fashion Show</li></ol>";
		}
	}
}