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
	var editContact = document.createElement('button');
	editContact.className = "button round ";
	editContact.innerHTML = "Edit Contact Info";
	document.getElementById('contact').appendChild(editContact);
	//grabTextData();
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
	addButtonToHomeAdmin();
	document.getElementById('contact').appendChild(paragraph);
}

function editContact(){
	var buttonID = document.getElementById('editButton');
}

