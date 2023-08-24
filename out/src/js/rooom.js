function rooomShow() {
   	var image = document.getElementById("zoom1");
   	var width= JSON.parse(JSON.stringify(image.lastElementChild.offsetWidth))+"px";
   	var height = JSON.parse(JSON.stringify(image.lastElementChild.offsetWidth))+"px";;
   	document.getElementById("r3dImage").setAttribute( "onClick",  "rooomHide()" ); 
   	document.getElementById("r3dstore").innerHTML =image.innerHTML;
  
   	//document.getElementById("r3dstore").setAttribute( "onClick",  document.getElementById("morePics_1").getAttribute('click')); 
   	
	image.innerHTML = document.getElementById("r3dframe").innerHTML;
	image.lastElementChild.style.width=width;
	image.lastElementChild.style.height=height;
     }
function rooomHide() {
   	var image = document.getElementById("zoom1");
   	var width= JSON.parse(JSON.stringify(image.lastElementChild.offsetWidth))+"px";
   	var height = JSON.parse(JSON.stringify(image.lastElementChild.offsetWidth))+"px";;
   	
   	document.getElementById("r3dImage").setAttribute( "onClick",  "rooomShow()" ); 
 
   	image.innerHTML =document.getElementById("r3dstore").innerHTML;
	image.lastElementChild.style.width=width;
	image.lastElementChild.style.height=height;
     } 
  
