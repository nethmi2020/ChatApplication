<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Chat</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body onload="LoadData()">

<div class="container mt-5">
    <h1 class="text-center">Simple chat system</h1>
	<!-- action="<?php echo base_url('/msg/store')?> -->
    <form    method="POST" name="frm1" id="frm" >
        <div class="form-group">
            <label for="usr">Name:</label>
            <input type="text" class="form-control"  name="name">
        </div>
        <div class="form-group">
            <label for="comment">Message</label>
            <textarea name="msg"  rows="5" class="form-control" ></textarea>
        </div>
        <input type="submit" value="Send" class="btn btn-primary" id="butsave">
    </form>
</div>

<div class="container mt-5 bg-dark text-light p-5">
    <h2>Messages</h2>
    <table class="table table-dark table-striped" id="MyTable">
        <tbody id="record">

        </tbody>
    </table>
</div>

</body>
</html>

<script>
	var myVar = setInterval(LoadData, 3000);

http_request = new XMLHttpRequest();

function LoadData(){
$('#MyTable tbody').empty();
$.ajax({
url: 'http://localhost:8012/ci3/chatapplication/MSg/process',
dataType: 'json',
success: function(data) {
    for (var i=0; i<data.length; i++) {
        var row = $('<tr><td><b>' + data[i].sender_name + ':</b></br>' + data[i].sender_message + '</td></tr>');
        $('#record').append(row);
    }
},
error: function(jqXHR, textStatus, errorThrown){
    alert('Error: ' + textStatus + ' - ' + errorThrown);
}
});
}


// $(document).ready(function(){
// 	$('#butsave').on('click', function(e){
// 		e.preventDefault();
// 		// $("#butsave").attr("disabled", "disabled");
// 		var name= document.forms["frm1"]["name"].value;
// 		var msg=document.forms["frm1"]["msg"].value;
// 		$.ajax({
// 				url: 'http://localhost:8012/ci3/chatapplication/msg/store',
// 				type: "POST",
// 				data: {
// 					name: name,
// 					msg: msg,			
// 				},
// 				dataType:'json',
// 				cache: false,
// 				success: function(dataResult){
// 					var dataResult = JSON.parse(dataResult);
// 					if(dataResult.statusCode==200){
// 						$("#butsave").removeAttr("disabled");
// 						document.forms["frm1"]["name"].value = "";
// 						document.forms["frm1"]["msg"].value = "";
// 						LoadData(); 						
// 					}
// 					else if(dataResult.statusCode==201){
// 					   alert("Error occured !");
// 					}
					
// 				}
// 			});

// 	})
// })



//Post data to the server
$(document).ready(function() {
	$('#butsave').on('click', function(e) {
		// $("#butsave").attr("disabled", "disabled");
		e.preventDefault();
		var name = document.forms["frm1"]["name"].value;
		var msg = document.forms["frm1"]["msg"].value;
	
		if(name!="" && msg!=""){
			
			$.ajax({
				url: 'http://localhost:8012/ci3/chatapplication/msg/store',
				type: "POST",
				data: {
					name: name,
					msg: msg,			
				},
				dataType:'json',
				cache: false,
				success: function(dataResult){
					$("#frm").trigger("reset");
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
					
						LoadData(); 						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});


	
</script>