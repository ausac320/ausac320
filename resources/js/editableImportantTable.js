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

function addImportantEditButtonToHomeAdmin(){
	var importantRow = document.createElement('div');
	importantRow.className = "row";
	var importantTitle = document.createElement('h3');
	importantTitle.className = "small-10 columns";
	importantTitle.innerHTML = "Deadlines and Important Dates:";
	importantTitle.style.textDecoration = "underline";
	importantTitle.style.padding = "0px";
	importantRow.appendChild(importantTitle);

	var editImportant = document.createElement('button');
	editImportant.className = "button round warning small-2 columns";
	editImportant.id = "importantEditButton";
	editImportant.innerHTML = "Edit Important Dates";
	editImportant.setAttribute("onclick", "editImportant()")
	importantRow.appendChild(editImportant);
	document.getElementById('importantDisplay').appendChild(importantRow);
	grabImportantTextData();
}

function grabImportantTextData(){
	$.ajax({
  	url: 'resources/data/importantDates.txt',
  	dataType: 'text',
	}).done(createImportantInfo);
}

function createImportantInfo(data){
	var totalRows = data.split("\n");
	var importantString = "";

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
	paragraph.className = "small-6 columns";
	formatRow.appendChild(paragraph);

	var location = document.getElementsByClassName('deadlines');
	location[0].appendChild(formatRow);	
}

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

function sendImportantStringToPHP(){
	stringToTransfer = document.getElementById('importantArea').innerHTML;

	$.ajax({
		type: "POST",
		url: "saveImportant.php",
		data: {string : JSON.stringify(stringToTransfer)},
		dataType: "json"
	});

	window.location.href=window.location.href;
}
