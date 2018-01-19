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

function grabScheduleData(){
	$.ajax({
  	url: 'resources/data/testSchedule.csv',
  	dataType: 'text',
  	cache: false
	}).done(createScheduleTable);
}

function createScheduleTable(data){
	var allRows = data.split("\n");

	tableDiv = document.createElement("div");
	tableDiv.className = "row";
	headingBox = document.createElement("div");
	headingBox.className = "row";
	title = document.createElement("h4");
	title.className = "small-9 columns";
	title.innerHTML = "Schedule";
	headingBox.appendChild(title);
	editButton = document.createElement("button");
	editButton.id = "scheduleEditButton";
	editButton.className = "button round warning small-2 columns";
	//editButton.setAttribute("onclick", "makeEdit()");
	editButton.innerHTML = "Edit Submissions";
	headingBox.appendChild(editButton);
	tableDiv.appendChild(headingBox);
	//----------------------------------------------------

	tableBox = document.createElement("div");
	tableBox.className = "row";
	table = document.createElement('table');
	table.id = "scheduleTable";
	table.setAttribute("style", "width:100%");
	tabInvisHeads = document.createElement('tr');
	tabInvisHeads.className = "hidden";
	for(var i=0; i<5; i++){
		head = document.createElement('th');
		head.className = "format";
		tabInvisHeads.appendChild(head);
		switch(i){
				case 0:
					head.innerHTML = "Name";
					head.setAttribute("style", "width:15%");
					break;
				case 1:
					head.innerHTML = "Professor";
					head.setAttribute("style", "width:15%");
					break;
				case 2:
					head.innerHTML = "Class";
					head.setAttribute("style", "width:8%");
					break;
				case 3:
					head.innerHTML = "Title";
					head.setAttribute("style", "width:50%");
					break;
				case 4:
					head.innerHTML = "Times";
					head.setAttribute("style", "width:12%");
					break;
		}
	}
	table.appendChild(tabInvisHeads);

	//When the program create a .csv file at the end it adds in an extra line for the 
	//carriage return so we have to have -1 here so it doesn't show it, however the 
	//incoming file needs to have that extra line or the last line will be lost on export
	for(var x=0; x<allRows.length - 1; x++){
		tabRow = document.createElement('tr');
		rowCells = allRows[x].split(',');

		if(rowCells.length == 1){
			innerEle = document.createElement('td');
			innerEle.className = "alert callout makeEdit format";
			innerEle.setAttribute("contenteditable", "false");
			innerEle.setAttribute("colspan", "5");
			if(rowCells[0].charAt(0) == '"'){
				innerEle.innerHTML = rowCells[0].slice(1, -1);
			}
			else{
				innerEle.innerHTML = rowCells[0];
			}	
		}
		else if(rowCells.length == 2){
			
		}

		for(var z=0; z<5; z++)
			innerEle = document.createElement('td');
			innerEle.className = "makeEdit format";
			innerEle.setAttribute("contenteditable", "false");

			switch(z){
				case 0:
					if(rowCells[0].charAt(0) == '"'){
						innerEle.innerHTML = rowCells[0].slice(1, -1);
					}
					else{
						innerEle.innerHTML = rowCells[0];
					}
					break;
				case 1:
					
					break;
				case 2:
					
					break;
				case 3:
					
					break;
				case 4:
					
					break;
				case 5:
					
					break;					
			}
			tabRow.appendChild(innerEle);
		}

		table.appendChild(tabRow);

	}

	tableBox.appendChild(table);
	tableDiv.appendChild(tableBox);
	document.getElementById('importantScheduleHolder').appendChild(tableDiv);	

}





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
			if(rowCells[i].charAt(0) == '"'){
				//removes quotes
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