/**
	scheduleSetup.js
	This is where the logic will be implemented for setting up the schedule.

	
*/


//This is the logic for dynamically creating the new time input for the break time. 
$(document).ready(function()){

$("#add").click(function (e){

$("#items").append('<div><input type="button" value="add breakTime" id="add"><input type="submit" value="submit">'
     +'<input type="button" value ="delete" id="delete"  /></div>');
});

$('#delete').click(function(e){
     $(this).parent('div').remove();
});



});









/**
var counter = 1;
var limit = 3;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var input = document.createElement('INPUT');
          input.type = "text";
          container.appendChild(input);
          container.apepndChild(document.createElement("br"));
          counter++;
     }
}


function myFunction(){
	var x = document.createElement("INPUT");
	x.setAttribute("type", "text");
	x.setAttribute("value", "test");	
	document.body.appendChild(x);
}

*/