const COLS_TOTAL = 6;
const COL_NAME = 0;
const COL_GXP = 4;
const COL_GS = 5;
const COL_STATUS = 6;

var aTable;

function ocrSendRequest(imgURL) {
	return new Promise(function(resolve, reject){
		var formData = new FormData();
		// formData.append("file", $('input[type="file"]')[i].files[0]);
		formData.append("url", imgURL);
		formData.append("language", "eng");
		formData.append("apikey", "99a1f273d488957");
		formData.append("isOverlayRequired", false);
		formData.append("isTable", true);

		query = [
			'url=' + imgURL,
			'apikey=99a1f273d488957',
			'language=eng',
			'isOverlayRequired=false',
			'isTable=true'
		];
		console.log(formData);
		$.ajax({
			url: 'https://api.ocr.space/parse/imageurl?' + query.join('&'),
			dataType: 'json',
			contentType: false,
			processData: false,
			type: 'GET',
			success: function (ocrParsedResult) {
				console.log('OCR Response', ocrParsedResult);
				resolve(ocrParsedResult);
			},
			error: function(error) {
				console.log('OCR Response Error', error);
				reject(error);
			}
		});
		/*
		var formData = {
			url: imgURL,
			language: 'eng',
			apikey: "99a1f273d488957",
			isOverlayRequired: false,
			isTable: true
		};
		*/
		/*
		$.ajax({
			url: 'https://api.ocr.space/parse/image',
			data: formData,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function (ocrParsedResult) {
				console.log('OCR Response', ocrParsedResult);
				resolve(ocrParsedResult);
			},
			error: function(error) {
				console.log('OCR Response Error', error);
				reject(error);
			}
		});
		*/
	});
}

function isNum(s) {
	return /\d+/.test(s.replace(/\./g, '').replace(/\,/g, ''));
}

function convert2Num(s) {
	return parseInt(s.replace(/\./g, '').replace(/\,/g, ''));
}

function number_format(number, decimals, dec_point, thousands_sep) {
	var i, j, kw, kd, km;

	// input sanitation & defaults
	if( isNaN(decimals = Math.abs(decimals)) ){
		decimals = 2;
	}
	if( dec_point == undefined ){
		dec_point = ",";
	}
	if( thousands_sep == undefined ){
		thousands_sep = ".";
	}

	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

	if( (j = i.length) > 3 ){
		j = j % 3;
	} else{
		j = 0;
	}

	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
	kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");

	return km + kw + kd;
}

function parseRow(rowTxt) {
	let row = rowTxt.split("\t");
	row = row.map(function(e) { return e.trim(); });

	let status = 'OK', errMsg = [];

	// remove last empty element
	if (row[row.length - 1] == "") {
		// row.pop();
		// row.unshift("");
		// status = 'WARNING';
		// errMsg = 'Check number of columns for this line';
	}

	if (row.length < COLS_TOTAL) {
		status = 'ERROR';
		errMsg.push('Check number of columns for this line');
		while (row.length < COLS_TOTAL) {
			row.unshift("");
		}
	}

	if (isNum(row[COL_GS])) {
		row[COL_GS] = convert2Num(row[COL_GS]);
	} else {
		status = 'ERROR';
		errMsg.push('Check `Guild score` column');
	}

	if (isNum(row[COL_GXP])) {
		row[COL_GXP] = convert2Num(row[COL_GXP]);
	} else {
		status = 'ERROR';
		errMsg.push('Check `Guild XP` column');
	}
	return {status, errMsg, data: row};
}

function parseResponseText(txt) {
	let aTable = [];
	let rows = txt.replace(/\t\r/g, '').replace(/\r/g, '').split("\n");
	rows.forEach(function(row, i) {
		row = row.trim();
		if (row) {
			let _row = parseRow(row);
			// console.log('row', row, i, _row);
			aTable.push(_row);
		}
	});
	return aTable;
}

function renderTable(rowset) {
	$('#table-stats').html(tmpl('x-table-stats', {rowset: rowset}));
	$('#table-stats table > tbody > tr > td').click(function(e) {
		e.preventDefault();
		let row = $(this).parent().data('row');
		let col = $(this).data('col');
		if ($('input', this).length) {
			return;
		}
		if (col == COL_STATUS) {
			validateRow(row);
			return;
		}
		selectCell(row, col);
	});
}

function validateRow(row) {
	let _row = aTable[row].data;
	if (!_row[COL_NAME]) {

	}
}

function $cell(row, col) {
	let td = `#table-stats table > tbody > tr[data-row="${row}"] > td[data-col="${col}"]`;
	return $(td);
}

function selectCell(row, col) {
	let td = `#table-stats table > tbody > tr[data-row="${row}"] > td[data-col="${col}"]`;
	let value = $cell(row, col).html();
	let w = $cell(row, col).width();
	$cell(row, col).html(`<input type="text" value="${value}" style="width: ${w}px;"/>`);
	setEventHandlers($('input', $cell(row, col).get(0)).get(0), row, col, value);
	$('input', $cell(row, col).get(0)).focus();
}

function setEventHandlers(input, row, col, orig_value) {
	$(input).keyup(function(e) {
		e.preventDefault();
		if (e.keyCode == 13) {
			this.blur();
		} else if (e.keyCode == 27) {
			onUpdateCell(row, col, orig_value);
		}
	});
	$(input).blur(function(){
		onUpdateCell(row, col, this.value);
	});
}

function onUpdateCell(row, col, value) {
	let _value = value;
	if (isNum(value) && (col == COL_GS || col == COL_GXP)) {
		value = convert2Num(value);
		_value = number_format(value, 0, '', ',');
		$cell(row, col).addClass('text-right');
	}
	aTable[row].data[col] = value;
	$cell(row, col).html(_value);
	$('.on-save').hide();
}

function renderNumericCell(row, col) {
	let value = aTable[row].data[col];
	let _class, _value;
	if (isNaN(value)) {
		_class = "";
		_value = value;
	} else {
		_class = 'text-right';
		_value = number_format(value, 0, '', ',');
	}
	return `<td class="${_class}" data-col="${col}">${_value}</td>`;
}
