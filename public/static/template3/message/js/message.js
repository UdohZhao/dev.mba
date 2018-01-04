
$(document).ready(
	function GetRequest() { 
	var url =  window.location.search; //获取url中"?"符后的字串  
	console.log(url);
	var theRequest = new Object(); 
	if (url.indexOf("?") != -1) { 
		var str = url.substr(1); 
		strs = str.split("&"); 
		for(var i = 0; i < strs.length; i ++) { 
		theRequest[strs[i].split("=")[0]]=decodeURIComponent(strs[i].split("=")[1]); 
		} 
	} 
	console.log(theRequest);
 	$('.cname').html(theRequest.cname);
	return theRequest; 
})
