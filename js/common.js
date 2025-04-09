function noNaN(a){return (isNaN( a ) || a=="") ? 0 : a;}

function checkExp(dateObj)
{
	dateString='01/'+dateObj.value;
	var dateParts = dateString.split("/");
	var expDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]); // month is 0-based
	
	toDay=new Date();
	var timeDiff = (expDate.getTime() - toDay.getTime());
	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	//alert(diffDays);
	if(diffDays<=0)
		{
			alert('Medicine Expired');
			return false
	}
		
	if(diffDays>1 && diffDays<181)
		alert('Medicine will expire within 3 months');
	return true;

}
function isInt(value) {
	  return !isNaN(value) && 
	         parseInt(Number(value)) == value && 
	         !isNaN(parseInt(value, 10));
	}
function isCurrency(obj)
{
	
	var regex  = /^-?\d+\.?\d{0,2}/;
	var numStr = obj.value;
	if (regex.test(numStr))
	   return true
	else
		{
	return false;	   
	$('#'+obj+'').focus();
		}
	
}
function ValidateDate (dateObj)  
{  
var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;  
// Match the date format through regular expression  
if(dateObj.value.match(dateformat))  
{ 	var opera1 = dateObj.value.split('/');  var opera2 = dateObj.value.split('-');  lopera1 = opera1.length; lopera2 = opera2.length;  
// Extract the string into month, date and year  
if (lopera1>1)  {  var pdate = dateObj.value.split('/');  }  
else if (lopera2>1)  {  var pdate = dateObj.value.split('-');  }  
var dd = parseInt(pdate[0]);  var mm  = parseInt(pdate[1]);  var yy = parseInt(pdate[2]);  
// Create list of days of a month [assume there is no leap year by default]  
var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];  
if (mm==1 || mm>2)  
{  
	if (dd>ListofDays[mm-1])  
	{  
	alert('Invalid date format!');  
	return false;  
	}  
}  
if (mm==2)  
{  
var lyear = false;  
if ( (!(yy % 4) && yy % 100) || !(yy % 400))   
{  
lyear = true;  
}  
if ((lyear==false) && (dd>=29))  
{  
alert('Invalid date format!');  
return false;  
}  
if ((lyear==true) && (dd>29))  
{  
alert('Invalid date format!');  
return false;  
}  
}  
}  
else  
{  
alert("Invalid date format!");  
$('#'+dateObj+'').focus();  
return false;  
}  
}  