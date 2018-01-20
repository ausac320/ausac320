/**
 * editableContactTable.js
 *
 * This file contains all the functionality to be able to grab the previously saved
 * text for the contact display field and then create the field and populate it.
 * It also has the functionality behind the edit button and the calls to the php function
 * for saving.
 *
 * Methods:
 * addContactEditButtonToHomeAdmin() - add edit button for admin
 * grabContactTextData() - grab data for text field
 * createContactInfo() - create contact text field
 * editContact() - functionality behind edit button
 * sendStringToPHP() - sends text field to php function to save
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
 * addContactEditButtonToHomeAdmin()
 * 
 * Creates the edit button only when the account is a user.
 * It will also call the grabContactTextData method to start
 * grabbing data for contact display. Only add edit button
 * to home page to eleminate clutter.
 */

function addContactEditButtonToHomeAdmin(){
	var contactRow = document.createElement('div');
	contactRow.className = "row";

	//Title
	var contactTitle = document.createElement('h3');
	contactTitle.className = "small-10 columns";
	contactTitle.innerHTML = "Contact Information";
	contactTitle.style.textDecoration = "underline";
	contactRow.appendChild(contactTitle);

	//Button
	var editContact = document.createElement('button');
	editContact.className = "button round warning small-2 columns";
	editContact.id = "contactEditButton";
	editContact.innerHTML = "Edit";
	editContact.setAttribute("onclick", "editContact()")
	contactRow.appendChild(editContact);
	document.getElementById('contact').appendChild(contactRow);
	grabContactTextData();
}

/**
 * grabContactTextData()
 * 
 * Grabs the text data from a .txt file and sends it to the create function.
 */

function grabContactTextData(){
	$.ajax({
  	url: 'resources/data/contact.txt',
  	dataType: 'text',
	}).done(createContactInfo);
}

/**
 * createContactInfo()
 * 
 * Creates the html that actually displays the text.
 * It creates as well as formats all of the <P> section for the text
 * and adds in html linebreaks for all the .txt line feeds.
 *
 * @params {text} - data - the previously saved text for important dates
 */

function createContactInfo(data){
	var allRows = data.split("\n");//create array of rows
	var contactString = "";//final string to display

	var paragraph = document.createElement('p');
	paragraph.id = "contactArea";

	for(var i=0; i<allRows.length; i++){
		contactString = contactString + allRows[i] + "<br>";
	}

	paragraph.innerHTML = contactString;

	//There is only 1 element in class 'contactInfo' so we know index is 0
	var location = document.getElementsByClassName('contactInfo');
	location[0].appendChild(paragraph);	
}

/**
 * editContact()
 * 
 * Functionality of edit button.
 * Creates new appearance for edit button as well as new functionality for
 * it through css and html manipulation.
 */

function editContact(){
	var buttonID = document.getElementById('contactEditButton');
	buttonID.innerHTML = "Save";
	buttonID.className = "button round small-2 columns";
	buttonID.setAttribute("onclick", "sendStringToPHP()")
	var contactEdit = document.getElementById('contactArea');
	contactEdit.setAttribute("contenteditable", "true");
	contactEdit.style.border = "1px solid #1779ba";
	contactEdit.style.backgroundColor = "#1779ba";
}

/**
 * sendStringToPHP()
 * 
 * Grabs txt in contact display and sends it to php function.
 */

function sendStringToPHP(){
	transferString = document.getElementById('contactArea').innerHTML;

	$.ajax({
		type: "POST",
		url: "saveContact.php",
		data: {string : JSON.stringify(transferString)},
		dataType: "json"
	});

	window.location.href=window.location.href;//reload page once php request is done
}
