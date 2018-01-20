//File Head

$('body').on('focus', '[contenteditable]', function() {
    var $this = $(this);
    $this.data('before', $this.html());
    return $this;
}).on('blur keyup paste input', '[contenteditable]', function() {
    var $this = $(this);
    if ($this.data('before') !== $this.html()) {
        $this.data('before', $this.html());
        $this.trigger('change');
    }
    return $this;
});

//To limit clutter, only add edit button to home
function addContactEditButtonToHomeAdmin(){
	var contactRow = document.createElement('div');
	contactRow.className = "row";
	var contactTitle = document.createElement('h3');
	contactTitle.className = "small-10 columns";
	contactTitle.innerHTML = "Contact Information";
	contactTitle.style.textDecoration = "underline";
	contactRow.appendChild(contactTitle);

	var editContact = document.createElement('button');
	editContact.className = "button round warning small-2 columns";
	editContact.id = "contactEditButton";
	editContact.innerHTML = "Edit";
	editContact.setAttribute("onclick", "editContact()")
	contactRow.appendChild(editContact);
	document.getElementById('contact').appendChild(contactRow);
	grabContactTextData();
}

function grabContactTextData(){
	$.ajax({
  	url: 'resources/data/contact.txt',
  	dataType: 'text',
	}).done(createContactInfo);
}

function createContactInfo(data){
	var allRows = data.split("\n");
	var contactString = "";

	var paragraph = document.createElement('p');
	paragraph.id = "contactArea";

	for(var i=0; i<allRows.length; i++){
		contactString = contactString + allRows[i] + "<br>";
	}

	paragraph.innerHTML = contactString;
	var location = document.getElementsByClassName('contactInfo');
	location[0].appendChild(paragraph);	
}

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

function sendStringToPHP(){
	transferString = document.getElementById('contactArea').innerHTML;

	$.ajax({
		type: "POST",
		url: "saveContact.php",
		data: {string : JSON.stringify(transferString)},
		dataType: "json"
	});

	window.location.href=window.location.href;
}
