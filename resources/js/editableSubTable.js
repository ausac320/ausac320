function grabData(){
	$.ajax({
  	url: '/resources/data/testData.csv',
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
	table.setAttribute("style", "width:100%")
	tabRow1 = document.createElement('tr');
	tabRow1.className = "success callout ";
	var rowCells = allRows[0].split(',');
	for(var i=0; i<rowCells.length; i++){
		head = document.createElement('th');
		head.innerHTML = rowCells[i];
		head.className = "format";
		tabRow1.appendChild(head);
		switch(i){
				case 0:
					head.setAttribute("style", "width:20%");
					break;
				case 1:
					head.setAttribute("style", "width:12%");
					break;
				case 2:
					head.setAttribute("style", "width:8%");
					break;
				case 3:
					head.setAttribute("style", "width:10%");
					break;
				case 4:
					head.setAttribute("style", "width:40%");
					break;
				case 5:
					head.setAttribute("style", "width:10%");
					break;
			}
	}
	table.appendChild(tabRow1);

	//Added -1 to allRows.length because with the .split("\n") there is a 
	//hidden row at the bottom that it grabs and ends up creating an extra
	//'tr'
	for(var x=1; x<allRows.length - 1; x++){
		tabRow2 = document.createElement('tr');
		rowCells = allRows[x].split(',');

		//using - 1 on .length so that we can make it so that the last column
		//for the abstract just displays yes or no not the whole abstract.
		for(var i=0; i<rowCells.length - 1; i++){
			innerEle = document.createElement('td');
			innerEle.className = "makeEdit format";
			innerEle.setAttribute("contenteditable", "false");
			innerEle.innerHTML = rowCells[i];
			tabRow2.appendChild(innerEle);
		}
		//Abstract Display Yes/no
		innerEle = document.createElement('td');
		innerEle.className = "format";
		if(rowCells[i].length > 1){
			innerEle.innerHTML = "Yes";
		}
		else{
			innerEle.innerHTML = "No";
		}
		tabRow2.appendChild(innerEle);
		//------------------------
		table.appendChild(tabRow2);
		
		innerRow = document.createElement('tr');

		innerEle = document.createElement('td');
		innerEle.className = "changeDisplay";
		innerEle.setAttribute("colspan", "6");
		innerEle.setAttribute("style", " display: none");
		innerEle.innerHTML = "Abstract: " + rowCells[i];
		innerRow.appendChild(innerEle);

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
	buttonID.className = "button round small-2 columns"

	//window.location.href=window.location.href
	//or onClick="window.location.reload()"
	buttonID.setAttribute("onclick", "window.location.href=window.location.href");
	var edit = document.getElementsByClassName('makeEdit');
	for(var x=0; x<edit.length; x++){
		edit[x].setAttribute("contenteditable", "true");
		edit[x].style.border = "1px solid #1779ba";
		edit[x].style.backgroundColor = "#d7ecfa";
	}
	var abstractDisplay = document.getElementsByClassName('changeDisplay');
	for(var i=0; i<edit.length; i++){
		abstractDisplay[i].setAttribute("contenteditable", "true");
		abstractDisplay[i].style.display = "";
		abstractDisplay[i].style.border = "1px solid #1779ba";
		abstractDisplay[i].style.backgroundColor = "#d7ecfa";
	}	
}