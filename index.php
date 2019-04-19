<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>STA - SHOW THE ATOM</title>
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="utf-8">
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=PT+Sans|Titillium+Web');

		#title {
    		font-family: 'PT Sans', sans-serif;
		}
		#spanElement, #spanId, #spanNumatom, #spanDescription {
    		font-family: 'Titillium Web', sans-serif;
		}
		#submit_btn {

		}
		#_input_substance {
			margin: auto;
			width: 80%;
			background: #ffff;
			border: 3px solid #73AD21;
			padding: 10px;
		}
	</style>
</head>
<body>

	<h1 id="title">Show The Atom</h1>

	<form name="_input_substance" id="_input_substance" method="post" action="" class="was-validated">
		<span id="spanId">Id: </span><input type="name" name="id" id="id"><br><br><br>
		<span id="spanElement">Element: </span><input type="name" name="element" id="element" required/><br><br><br>
		<span id="spanNumatom">Numatom: </span><input type="name" name="numatom" id="numatom" required/><br><br><br>
		<span id="spanDescription">Description: </span><br><textarea required name="description" id="validationTextarea" class="form-control is-invalid"></textarea><br><br><br>
		<button type="submit" id="submit_btn" class="btn btn-success">Submit</button>
	</form><br>
	<script type="text/javascript">
		function submitform(){
			alert('Complete!');
			document._input_substance.action = 'http://e9c0adf2.ngrok.io/atom';
			document._input_substance.submit();

		}
		$("#submit_btn").click(function(){
			var id = document.getElementById("numatom").value;
			var numatom = document.getElementById("numatom").value;
			var element = document.getElementById("element").value;
			var description = document.getElementById("validationTextarea").value;
			if(id == '' || id == null || numatom == '' || numatom == null || element == '' || element == null || description == '' || description == null){
				alert('Fill the empty fields');
				return false;
			} else {
				console.log("Sending fields ...");
				console.log("Id:"+id);
				console.log("Numatom:"+numatom);
				console.log("Element:"+element);
				console.log("Description:"+description);
				submitform();
			}
			
		});
	</script>
</body>
</html>