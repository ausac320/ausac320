var counter = 1;
var limit = 3;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('TIME');
          newdiv.innerHTML = "Entry " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";
          document.body.appendChild(newdiv);
          counter++;
     }
}

function myFunction(){
	var x = document.createElement("INPUT");
	x.setAttribute("type", "text");
	x.setAttribute("value", "test");	
	document.body.appendChild(x);
}