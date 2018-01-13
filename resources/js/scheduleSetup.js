/**
	scheduleSetup.js
	This is where the logic will be implemented for setting up the schedule.

	
*/


//This is the logic for dynamically creating the new time input for the break time. 
var counter = 1;
var limit = 3;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('INPUT');
          newdiv.innerHTML = "Entry " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";
          document.body.appendChild(newdiv);
          counter++;
     }
}

/**
function myFunction(){
	var x = document.createElement("INPUT");
	x.setAttribute("type", "text");
	x.setAttribute("value", "test");	
	document.body.appendChild(x);
}
*/
