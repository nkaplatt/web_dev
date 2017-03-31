
function edit_form_filled() {
	file_type_not_allowed();
  if ($('#name').val().length > 0 &&
        $('#year').val().length > 0 &&
				$('#operator').val().length > 0 &&
				$('#manufactorer').val().length > 0 &&
				$('#image').val().length > 0 &&
        $('#capacity').val().length > 0) {
        $("input[type=submit]").prop("disabled", false);
    }
    else {
        $("input[type=submit]").prop("disabled", true);
    }
}

function file_type_not_allowed() {
	var ext = $('#image').val().split('.').pop().toLowerCase();
	if(($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) && ext != '') {
		alert("Cant upload file with extension " + ext + " must be .jpg .png or .jpeg");
	}
}

function showTable(str) {
		if (str == "") {
				document.getElementById("displaytable").innerHTML = "";
				return;
		} else {
				if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
				} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
								document.getElementById("displaytable").innerHTML = this.responseText;
						}
				};
				str = encodeURIComponent(str);
				xmlhttp.open("GET","table.php?table="+str, true);
				xmlhttp.send();
		}
}

function showRange() {
	var upper = $('#upperrange').val();;
	var lower = $('#lowerrange').val();
	if(lower == '') {
		lower = 0;
	}
	if(upper == '') {
		upper = 500000;
	}

	if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
	} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					document.getElementById("displaytable").innerHTML = this.responseText;
			}
	};
	xmlhttp.open("GET","range.php?lower="+lower+"&upper="+upper, true);
	xmlhttp.send();

}

function delete_ship(name) {
  $.ajax({
    type: 'POST',
    url: 'delete.php?delete='+name,
    success: function(data) {
			window.location = 'index.php'
    }
  });
}
