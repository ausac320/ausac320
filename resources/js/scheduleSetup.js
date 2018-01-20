/**
	scheduleSetup.js

	This small set of code is the handler for the test button which when pressed will execute the schedule building 
	algorithm.	
*/

$(document).ready(function(){
	$('.testButton').click(function(){
		$.ajax({			
			url: 'scheduleAlgor.php',
			type: "POST",
			data: {action: 'test'},
			success: function(output){
						alert(output);
					}
		});
	});
});

//if($_SERVER['REQUEST_METHOD'] == "POST"){
//	echo "You are successful";
//}
//__halt_compiler();