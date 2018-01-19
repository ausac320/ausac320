//Head Of File

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

function grabData(){
	$.ajax({
  	url: 'testsave.csv',
  	dataType: 'text',
	}).done(createSubTable);
}

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
					head.setAttribute("style", "width:20%");
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
					head.setAttribute("style", "width:40%");
					break;
				case 5:
					head.innerHTML = "Abstract";
					head.setAttribute("style", "width:10%");
					break;
		}
	}
	table.appendChild(tabRow1);

	//Added -1 to allRows.length because with the .split("\n") there is a 
	//hidden row at the bottom that it grabs and ends up creating an extra
	//'tr'
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
			if(rowCells[i].charAt(0) == '"'){
				innerEle.innerHTML = rowCells[i].slice(1, -1);
			}
			else{
				innerEle.innerHTML = rowCells[i];
			}
			tabRow2.appendChild(innerEle);
		}
		//Abstract Display Yes/no
		innerEle = document.createElement('td');
		innerEle.className = "format";
		//Empty last still have ""\ from the csv file
		//use i since i iterates to abstract and then stops in for loop
		if(rowCells[i].length > 3){
			innerEle.innerHTML = "Yes";
		}
		else{
			innerEle.innerHTML = "No";
		}
		tabRow2.appendChild(innerEle);
		//------------------------
		//Creates hidden prof so that we can save the values for csv write to
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
	}

	tableBox.appendChild(table);
	tableDiv.appendChild(tableBox);
	document.getElementById('submissionsDisplayBox').appendChild(tableDiv);	
}

function makeEdit(){
	var buttonID = document.getElementById('editButton');
	var currentText = buttonID.innerHTML;
	buttonID.innerHTML = "Save Changes";
	buttonID.className = "button round small-2 columns";

	//window.location.href=window.location.href
	//or onClick="window.location.reload()"
	buttonID.setAttribute("onclick", "tableToCSV()");
	var edit = document.getElementsByClassName('makeEdit');
	for(var x=0; x<edit.length; x++){
		edit[x].setAttribute("contenteditable", "true");
		edit[x].style.border = "1px solid #1779ba";
		edit[x].style.backgroundColor = "#d7ecfa";
	}
	var abstractDisplay = document.getElementsByClassName('changeDisplay');
	for(var i=0; i<abstractDisplay.length; i++){
		abstractDisplay[i].setAttribute("contenteditable", "true");
		abstractDisplay[i].style.display = "";
		abstractDisplay[i].style.border = "1px solid #1779ba";
		abstractDisplay[i].style.backgroundColor = "#d7ecfa";
	}
	var abstractTitle = document.getElementsByClassName('abstractTitle');
	for(var y=0; y<abstractTitle.length; y++){
		abstractTitle[y].style.display = "";	
	}
}

function tableToCSV(){
	var finalCSV = [];
	var totalRows = document.querySelectorAll("table tr");
	var tableRow = [];
	var profName;

	for(var i = 1; i < totalRows.length; i++){
		
		var tableColms = totalRows[i].querySelectorAll("td");

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
			//slide removes the new line at the end of prof name so it doesn't
			//get written in.
			profName = tableColms[tableColms.length -1].innerHTML.slice(0, -1);;
		}

		//i starts at 1 to avoid header row and we only want it so save 
		//every other row starting at 2
		if(i%2==0){
			finalCSV.push(tableRow);
			var tableRow = [];	
		}
	}
	sendArrayToPHP(finalCSV);
	window.location.href=window.location.href;
}

function sendArrayToPHP(data){

	$.ajax({
		type: "POST",
		url: "createCSV.php",
		data: {array : JSON.stringify(data)},
		dataType: "json",
	});
}
	
