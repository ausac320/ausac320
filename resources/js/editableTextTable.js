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
function addButtonToHomeAdmin(){
	var contactRow = document.createElement('div');
	contactRow.className = "row";
	var contactTitle = document.createElement('h3');
	contactTitle.className = "small-10 columns";
	contactTitle.innerHTML = "Contact Information";
	contactTitle.style.textDecoration = "underline";
	contactRow.appendChild(contactTitle);

	var editContact = document.createElement('button');
	editContact.className = "button round warning small-2 columns";
	editContact.innerHTML = "Edit";
	contactRow.appendChild(editContact);
	document.getElementById('contact').appendChild(contactRow);
	grabTextData();
}

function grabTextData(){
	$.ajax({
  	url: 'resources/data/test.txt',
  	dataType: 'text',
	}).done(createContactInfo);
}

function createContactInfo(data){
	var allRows = data.split("\n");
	var contactString = "";

	var paragraph = document.createElement('p');

	for(var i=0; i<allRows.length; i++){
		contactString = contactString + allRows[i] + "<br>";
	}

	paragraph.innerHTML = contactString;
	var location = document.getElementsByClassName('contactInfo');
	location[0].appendChild(paragraph);
	
}

function editContact(){
	var buttonID = document.getElementById('editButton');
	buttonID.innerHTML = "Save Changes";
	buttonID.className = "button round";
}

