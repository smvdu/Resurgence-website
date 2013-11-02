/*
* Forms v1.0 (jan 16, 2012)
* Copyright (c) group94 - http://www.group94.com
* Unauthorised use, copying and/or redistributing is strictly prohibited.
*/

////////////////////////////////////////////////////////////////////////// VALIDATE INPUT FIELDS
function validateField($field, $type, $errFunc, $errText){
	var ok = false
	if($type=="text")			ok = isValidText($field.value)
	if($type=="email")		ok = isValidEmail($field.value)
	if($type=="dropdown")	ok = isValidSelection($field)
	if($type=="checkbox")	ok = isChecked($field)
	
	if(!ok){
		if($type!="checkbox")	setFieldError($field)
		if($errFunc)	$errFunc($errText)
		
	}else{
		if($type!="checkbox")	removeFieldError($field)
		return true;
	}
	
	return false;
}

function setFieldError($field){
	addClass($field, "error")
}
function removeFieldError($field){
	removeClass($field, "error")
}


////////////////////////////////////////////////////////////////////////// VALIDATE INPUT
function isValidText($str){
	return $str.split(" ").join("") != "";
}
function isValidEmail($str){
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	return (reg.test($str));
}
function isValidSelection($field){
	return $("option[selected=true]", $field)[0].value != "default";
}
function isChecked($field){
	return $field.checked;
}


/////////////////////////////////////////////////////////////////////////// GET INPUT VALUE TO SEND
function getFieldValue($field){
	if($field.type=="checkbox")	return $field.checked;
	else									return $field.value;
}


////////////////////////////////////////////////////////////////////////// INPUT RESTRICTIONS
function numbersOnly($field, excludes){		//onkeyup="numbersOnly(this, ['+','-'])"
	var str = "[^0-9"
	if(excludes){
		for(var i=0; i<excludes.length; i++){ str += "|\\"+excludes[i] }
	}
	str += "]+"
	var reg = new RegExp(str,"");
	$field.value = $field.value.replace(reg,"");
}

function limitChars($field, $length){			//onkeyup="limitChars(this, 200)"
	if($field.value.length > $length)	$field.value = $field.value.substr(0, $length)
}