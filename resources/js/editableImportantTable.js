/**
 * editableImportantTable.js
 *
 * This file contains all the functionality to be able to grab the previously saved
 * text for the important display field and then create the field and populate it.
 * It also has the functionality behind the edit button and the calls to the php function
 * for saving.
 *
 * Methods:
 * addImportantEditButtonToHomeAdmin() - add edit button for admin
 * grabImportantTextData() - grab data for text field
 * createImportantInfo() - create important text field
 * editImportant() - functionality behind edit button
 * sendImportantStringToPHP() - sends text field to php function to save
 *
 * Bugs:
 * Editable text field produces errors when trying to remove the \n at the end of a line or 
 * if you add a new line to the text field.
 *
 * Status:
 * Editable text for deadline is setup and outputs the appropriate file but causes 
 * issues using said file to reloop through, so does not display changes currently. 
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
 * addImportantEditButtonToHomeAdmin()
 * 
 * Creates the edit button only when the account is a user.
 *
 * It will also call the grabImportantTextData method to start
 * grabbing data for contact display.
 */

function addImportantEditButtonToHomeAdmin(){
	var importantRow = document.createElement('div');
	importantRow.className = "row";

	//Title
	var importantTitle = document.createElement('h3');
	importantTitle.className = "small-10 columns";
	importantTitle.innerHTML = "Deadlines and Important Dates:";
	importantTitle.style.textDecoration = "underline";
	importantTitle.style.padding = "0px";
	importantRow.appendChild(importantTitle);

	//button
	var editImportant = document.createElement('button');
	editImportant.className = "button round warning small-2 columns";
	editImportant.id = "importantEditButton";
	editImportant.innerHTML = "Edit Important Dates";
	editImportant.setAttribute("onclick", "editImportant()")
	importantRow.appendChild(editImportant);
	document.getElementById('importantDisplay').appendChild(importantRow);
	grabImportantTextData();
}

/**
 * grabImportantTextData()
 * 
 * Grabs the text data from a .txt file and sends it to the create function.
 */

function grabImportantTextData(){
	$.ajax({
  	url: 'resources/data/importantDates.txt',
  	dataType: 'text',
	}).done(createImportantInfo);
}

/**
 * createImportantInfo()
 * 
 * Creates the html that actually displays the text.
 *
 * It creates as well as formats all of the <P> section for the text
 * and adds in html linebreaks for all the .txt line feeds.
 *
 * @params {text} - data - the previously saved text for important dates
 */

function createImportantInfo(data){
	var totalRows = data.split("\n"); //create array of rows
	var importantString = ""; //final string to display

	var formatRow = document.createElement('div');
	formatRow.className = "row";
	var paragraph = document.createElement('p');
	paragraph.id = "importantArea";
	paragraph.className = "small-6 columns"; 

	for(var x=0; x<totalRows.length; x++){
		importantString = importantString + totalRows[x] + "<br>";
	}

	paragraph.innerHTML = importantString;
	formatRow.appendChild(paragraph);
	var paragraph = document.createElement('p');
	paragraph.className = "small-6 columns";//add hidden column for formating so editable text field
											//doesn't take up half the page
	formatRow.appendChild(paragraph);

	//There is only 1 element in class 'deadlines' so we know index is 0
	var location = document.getElementsByClassName('deadlines');
	location[0].appendChild(formatRow);	
}

/**
 * editImportant()
 * 
 * Functionality of edit button.
 *
 * Creates new appearance for edit button as well as new functionality for
 * it through css and html manipulation
 */

function editImportant(){
	var buttonID = document.getElementById('importantEditButton');
	buttonID.innerHTML = "Save Changes";
	buttonID.className = "button round small-2 columns";
	buttonID.setAttribute("onclick", "sendImportantStringToPHP()")
	var importantEdit = document.getElementById('importantArea');
	importantEdit.setAttribute("contenteditable", "true");
	importantEdit.style.border = "1px solid #1779ba";
	importantEdit.style.backgroundColor = "#d7ecfa";
}

/**
 * sendImportantStringToPHP()
 * 
 * Grabs txt in important display and sends it to php function.
 */

function sendImportantStringToPHP(){
	stringToTransfer = document.getElementById('importantArea').innerHTML;

	$.ajax({
		type: "POST",
		url: "saveImportant.php",
		data: {string : JSON.stringify(stringToTransfer)},
		dataType: "json"
	});

	window.location.href=window.location.href; //reload page once php request is done
}
