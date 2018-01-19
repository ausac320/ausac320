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
  	//url: 'resources/data/schedule.csv',
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
	title = document.createElement("h3");
	title.className = "small-9 columns";
	title.innerHTML = "Schedule";
	headingBox.appendChild(title);
	editButton = document.createElement("button");
	editButton.id = "scheduleEditButton";
	editButton.className = "button round warning small-2 columns";
	editButton.setAttribute("onclick", "makeEdit()");
	editButton.innerHTML = "Edit Schedule";
	headingBox.appendChild(editButton);
	tableDiv.appendChild(headingBox);
	//----------------------------------------------------

	tableBox = document.createElement("div");
	tableBox.className = "row";
	tableBox.id = "finalSchedule";
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

		//the slices have to be (1, -2) the first time a file get's passed in
		//if it wasn't created using fputcsv as the formatting will be off. 
		//the slices to change are the only slice in the if == 1 and change the 
		//second slice in the elseif
		if(rowCells.length == 1){
			innerEle = document.createElement('td');
			innerEle.className = "success callout makeEdit format";
			innerEle.setAttribute("contenteditable", "false");
			innerEle.setAttribute("colspan", "5");
			if(rowCells[0].charAt(0) == '"'){
				//innerEle.innerHTML = rowCells[0].slice(1, -2);
				innerEle.innerHTML = rowCells[0].slice(1, -1);
			}
			else{
				innerEle.innerHTML = rowCells[0];
			}
			tabRow.appendChild(innerEle);	
		}
		else if(rowCells.length == 2){
			innerEle = document.createElement('td');
			innerEle.className = "warning callout makeEdit format";
			innerEle.setAttribute("contenteditable", "false");
			innerEle.setAttribute("colspan", "3");
			if(rowCells[0].charAt(0) == '"'){
				innerEle.innerHTML = rowCells[0].slice(1, -1);
			}
			else{
				innerEle.innerHTML = rowCells[0];
			}
			tabRow.appendChild(innerEle);
			innerEle = document.createElement('td');
			innerEle.className = "warning callout makeEdit format";
			innerEle.setAttribute("contenteditable", "false");
			innerEle.setAttribute("colspan", "2");
			if(rowCells[1].charAt(0) == '"'){
				//innerEle.innerHTML = rowCells[1].slice(1, -2);
				innerEle.innerHTML = rowCells[1].slice(1, -1);
			}
			else{
				innerEle.innerHTML = rowCells[1];
			}
			tabRow.appendChild(innerEle);
		}
		else{//This is the situation that it is the first time the graph has been sent to the 
			 //display so it needs to account for all the extra data 
			if(rowCells.length > 5){
				for(var z=0; z<5; z++){
					innerEle = document.createElement('td');
					innerEle.className = "makeEdit format";
					innerEle.setAttribute("contenteditable", "false");

					switch(z){
						case 0://Student Name
							if(rowCells[0].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[0].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[0];
							}
							break;
						case 1://Professor Name
							if(rowCells[6].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[6].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[6];
							}
							break;
						case 2://Class
							if(rowCells[1].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[1].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[1];
							}
							break;
						case 3://Title 
							if(rowCells[4].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[4].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[4];
							}
							break;
						case 4://Times
							if(rowCells[7].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[7].slice(1, -2);
							}
							else{
								innerEle.innerHTML = rowCells[7];
							}
							break;
					}
				tabRow.appendChild(innerEle);
				}
			}//if statement
			//This is the situation where the graph has already been created and all that is 
			//left is the neccasary data to make the graph. 
			else{
				for(var z=0; z<5; z++){
					innerEle = document.createElement('td');
					innerEle.className = "makeEdit format";
					innerEle.setAttribute("contenteditable", "false");

					switch(z){
						case 0://Student Name
							if(rowCells[0].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[0].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[0];
							}
							break;
						case 1://Professor Name
							if(rowCells[1].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[1].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[1];
							}
							break;
						case 2://Class
							if(rowCells[2].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[2].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[2];
							}
							break;
						case 3://Title 
							if(rowCells[3].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[3].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[3];
							}
							break;
						case 4://Times
							if(rowCells[4].charAt(0) == '"'){
								innerEle.innerHTML = rowCells[4].slice(1, -1);
							}
							else{
								innerEle.innerHTML = rowCells[4];
							}
							break;
					}
				tabRow.appendChild(innerEle);
				}
			}	
		}

		table.appendChild(tabRow);

	}

	tableBox.appendChild(table);
	tableDiv.appendChild(tableBox);
	document.getElementById('importantScheduleHolder').appendChild(tableDiv);	

}

function makeEdit(){
	var buttonID = document.getElementById('scheduleEditButton');
	buttonID.innerHTML = "Save Changes";
	buttonID.className = "button round small-2 columns";
	buttonID.setAttribute("onclick", "tableToCSV()");
	var edit = document.getElementsByClassName('makeEdit');
	for(var x=0; x<edit.length; x++){
		edit[x].setAttribute("contenteditable", "true");
		edit[x].style.border = "1px solid #1779ba";
		edit[x].style.backgroundColor = "#d7ecfa";
	}
}


function tableToCSV(){
	var finalCSV = [];
	var totalRows = document.querySelectorAll("table tr");

	for(var i = 1; i < totalRows.length; i++){
		var tableRow = [];
		var tableColms = totalRows[i].querySelectorAll("td");

		for(var x = 0; x < tableColms.length; x++){
			tableRow.push(tableColms[x].innerHTML);
		}
		finalCSV.push(tableRow);

	}
	sendArrayToPHP(finalCSV);
	window.location.href=window.location.href;
}

function sendArrayToPHP(data){
	$.ajax({
		type: "POST",
		url: "createScheduleCSV.php",
		data: {array : JSON.stringify(data)},
		dataType: "json",
	});
}