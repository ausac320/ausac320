/**
 * editableSubTable.js
 *
 * This file contains all the functionality to be able to grab the previously saved submissions
 * for a given professor and turn it into a table that has the ability to be changed to become 
 * editable via button click as well as the ability to save all the data in the edited table back
 * to the file it got it from.
 *
 * Methods:
 * grabSubmissionData() - grab data for submissions table
 * createSubTable() - create submissions table
 * makeEdit() - functionality behind edit button
 * tableToCSV() - turns a table html element into a double nested array for .csv formatting
 * sendArrayToPHP() - sends double nested array to php function to save
 *
 * Bugs:
 * - 
 *
 * Status:
 * Implemented but has few noted high priority bugs to fix before shipping
 */

// Static method that when a field is contenteditable it will constantly
// save the innerHTML to whatever the new innerHTML is on certain keystrokes
// such as keyup, paste, input, etc.

$('body').on('focus', '[contenteditable]', function() {
    var $this = $(this);
    $this.data('before', $this.html());//old data
    return $this;
}).on('blur keyup paste input', '[contenteditable]', function() {
    var $this = $(this);
    if ($this.data('before') !== $this.html()) {//did innerhtml data change?
        $this.data('before', $this.html());
        $this.trigger('change');//if so then change
    }
    return $this;
});

/**
 * grabSubmissionData()
 * 
 * Grabs the text data from a .csv file and sends it to the create function.
 */

function grabSubmissionData(){
	$.ajax({
  	url: 'resources/submissionFolder/Mike Myers.csv',
  	dataType: 'text',
  	cache: false
	}).done(createSubTable);
}

/**
 * createSubTable()
 * 
 * Creates the html that actually displays the submissions table
 *
 * It creates as well as formats all of the <table> section that we create 
 * where every row of the table is equal to a row in the .csv file and also
 * implements headers and hidden data storing. 
 *
 * @params {text} - data - the previously saved student submissions by a teacher
 */

function createSubTable(data){
	var allRows = data.split("\n");

	tableDiv = document.createElement("div");
	tableDiv.className = "row";
	headingBox = document.createElement("div");
	headingBox.className = "row";
	title = document.createElement("h2");
	title.className = "small-9 columns";
	title.innerHTML = "Submissions";
	headingBox.appendChild(title);
	editButton = document.createElement("button");
	editButton.id = "editButton";
	editButton.className = "button round warning small-2 columns";
	editButton.setAttribute("onclick", "makeEdit()");
	editButton.innerHTML = "Edit Submissions";
	headingBox.appendChild(editButton);
	tableDiv.appendChild(headingBox);

	/**----------------------------------*/
	//Headers
	tableBox = document.createElement("div");
	tableBox.className = "row";
	table = document.createElement('table');
	table.id = "subTable";
	table.setAttribute("style", "width:100%");
	tabRow1 = document.createElement('tr');
	tabRow1.className = "success callout ";
	for(var i=0; i<6; i++){
		head = document.createElement('th');
		head.className = "format";
		tabRow1.appendChild(head);
		switch(i){
				case 0:
					head.innerHTML = "Name";
					head.setAttribute("style", "width:15%");
					break;
				case 1:
					head.innerHTML = "Class";
					head.setAttribute("style", "width:12%");
					break;
				case 2:
					head.innerHTML = "Type";
					head.setAttribute("style", "width:8%");
					break;
				case 3:
					head.innerHTML = "O.U.R.";
					head.setAttribute("style", "width:10%");
					break;
				case 4:
					head.innerHTML = "Title";
					head.setAttribute("style", "width:45%");
					break;
				case 5:
					head.innerHTML = "Abstract";
					head.setAttribute("style", "width:10%");
					break;
		}
	}
	table.appendChild(tabRow1);

	//When the program create a .csv file at the end it adds in an extra line for the 
	//carriage return so we have to have -1 here so it doesn't show it, however the 
	//incoming file needs to have that extra line or the last line will be lost on export
	for(var x=0; x<allRows.length - 1; x++){
		tabRow2 = document.createElement('tr');
		rowCells = allRows[x].split(',');

		//using - 2 on .length so that we can avoid grabbing the professors info
		//as well as avoid the abstract since we have special case code for it
		//underneath
		for(var i=0; i<rowCells.length - 2; i++){
			innerEle = document.createElement('td');
			innerEle.className = "makeEdit format";
			innerEle.setAttribute("contenteditable", "false");
			if(rowCells[i].charAt(0) == '"'){//remove quotations if it has them from string
				innerEle.innerHTML = rowCells[i].slice(1, -1);
			}
			else{
				innerEle.innerHTML = rowCells[i];
			}
			tabRow2.appendChild(innerEle);
		}
		//Abstract Display Yes/no-----
		innerEle = document.createElement('td');
		innerEle.className = "format";

		//Empty last still have ""\ from the csv file
		//use i since i iterates to abstract and then stops, in for loop
		if(rowCells[i].length > 3){
			innerEle.innerHTML = "Yes";
		}
		else{
			innerEle.innerHTML = "No";
		}
		tabRow2.appendChild(innerEle);
		//------------------------

		//Creates hidden prof so that we can save the values for when we write to csv later
		innerEle = document.createElement('td');
		innerEle.className = "hidden";
		if(rowCells[rowCells.length -1].charAt(0) == '"'){
			innerEle.innerHTML = rowCells[rowCells.length - 1].slice(1, -1);
		}
		else{
			innerEle.innerHTML = rowCells[rowCells.length - 1];
		}
		tabRow2.appendChild(innerEle);
		//----------------------------------

		table.appendChild(tabRow2);
		
		/** Create invisible abstract display row */
		innerRow = document.createElement('tr');

		//Abstract Title
		innerEle = document.createElement('td');
		innerEle.className = "abstractTitle";
		innerEle.setAttribute("colspan", "1");
		innerEle.setAttribute("style", " display: none");
		innerEle.innerHTML = "Abstract:";
		innerRow.appendChild(innerEle);

		//Abstract 
		innerEle = document.createElement('td');
		innerEle.className = "changeDisplay";
		innerEle.setAttribute("colspan", "5");
		innerEle.setAttribute("style", " display: none");
		if(rowCells[i].charAt(0) == '"'){
			innerEle.innerHTML = rowCells[i].slice(1, -1);
		}
		else{
			innerEle.innerHTML = rowCells[i];
		}
		innerRow.appendChild(innerEle);
		//------------------------

		table.appendChild(innerRow);
	}//for loop

	tableBox.appendChild(table);
	tableDiv.appendChild(tableBox);
	document.getElementById('submissionsDisplayBox').appendChild(tableDiv);	
}//createSubTable

/**
 * makeEdit()
 * 
 * Functionality of edit button.
 *
 * Creates new appearance for edit button as well as new functionality for
 * it through css and html manipulation. It will also make all of the content
 * in the makeEdit classes change to show that they are editable and allow for 
 * for editing. It will also display previously hidden fields for the abstract. 
 */

function makeEdit(){
	var buttonID = document.getElementById('editButton');
	buttonID.innerHTML = "Save Changes";
	buttonID.className = "button round small-2 columns";

	buttonID.setAttribute("onclick", "tableToCSV()");
	//make appropriate content editable
	var edit = document.getElementsByClassName('makeEdit');
	for(var x=0; x<edit.length; x++){
		edit[x].setAttribute("contenteditable", "true");
		edit[x].style.border = "1px solid #1779ba";
		edit[x].style.backgroundColor = "#d7ecfa";
	}
	//show hidden row
	var abstractDisplay = document.getElementsByClassName('changeDisplay');
	for(var i=0; i<abstractDisplay.length; i++){
		abstractDisplay[i].setAttribute("contenteditable", "true");
		abstractDisplay[i].style.display = "";
		abstractDisplay[i].style.border = "1px solid #1779ba";
		abstractDisplay[i].style.backgroundColor = "#d7ecfa";
	}
	//don't make abstract title editable
	var abstractTitle = document.getElementsByClassName('abstractTitle');
	for(var y=0; y<abstractTitle.length; y++){
		abstractTitle[y].style.display = "";	
	}
}

/**
 * tableToCSV()
 * 
 * Turns a table html element into a double nested array for csv format.
 *
 * Has limitations on what it will grab as well since their are certain
 * row aspects that get saved that we do not need such as if a abstract
 * is present or not. 
 */

function tableToCSV(){
	var finalCSV = [];
	var totalRows = document.querySelectorAll("table tr");
	var tableRow = [];
	var profName;//prof needs to be at end of each rows data

	for(var i = 1; i < totalRows.length; i++){
		
		var tableColms = totalRows[i].querySelectorAll("td");

		//length == 2 means that it is a hidden row 
		//Only grabs the actual abstract, not the word abstract
		if(tableColms.length==2){
			tableRow.push(tableColms[1].innerHTML);
			tableRow.push(profName);
		}
		else{
			//length - 2 is to remove the abstract yes/no so it 
			//doesn't get added to submission and the professors name
			for(var x = 0; x < tableColms.length - 2; x++){
				tableRow.push(tableColms[x].innerHTML);
			}

			profName = tableColms[tableColms.length -1].innerHTML;
		}

		//i starts at 1 to avoid header row and we only want it so save 
		//every other row starting at 2
		if(i%2==0){
			finalCSV.push(tableRow);
			var tableRow = [];	
		}
	}
	sendArrayToPHP(finalCSV);
	window.location.href=window.location.href;//reloads the page
}

/**
 * sendArrayToPHP()
 * 
 * Takes an array of the information from the submissions page and sends it 
 * to a php function to save it. 
 *
 * @params {array} - data - double nested array that contains all of the submission data 
 */

function sendArrayToPHP(data){
	$.ajax({
		type: "POST",
		url: "createCSV.php",
		data: {array : JSON.stringify(data)},
		dataType: "json",
	});
}
