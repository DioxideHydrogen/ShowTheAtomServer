<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>STA - SHOW THE ATOM</title>
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<meta charset="utf-8">
	<style type="text/css">
		#formId{
			position: relative;
			bottom: 1000px;
		}
	</style>
</head>
<body>
	<?php
		$db = mysqli_connect('localhost','root','','sta');
		if($db){
			$status = "[+]";
		} else {
			echo PHP_EOL;
			echo mysqli_connect_errno();
			$status = "[-]";
		}
		$sql = "SELECT * FROM organicssubstances";
		$con = $db->query($sql) or die($db->error);
		while ($dado = $con->fetch_array()) {
			$array = [
				"id" => $dado['id'] + 1
			];
		}
		$array = (int) $array['id'];
	?>
	<h1 id="title"><?php echo $status; ?>Universal Substances Data Base</h1>

	<form name="_input_substance" id="_input_substance" method="post" action="">
		<span id="formId">
		<span id="formId">Id: </span><input type="number" name="id" id="id" value="<?php echo htmlspecialchars($array); ?>" /><br></span>
		<!-- value="<?php echo htmlspecialchars($array); ?>" -->
		<span>Substance: </span><input type="name" name="substance" id="substance" required/><br><br><br>
		<span>Formula: </span><input type="name" name="formula" id="formula" required/><br><br><br>
		<span>Email: </span><input type="email" name="email" id="email" value="anonymous@mail.com" /><br><br><br>
		<button type="submit" id="submit_btn">Submit</button>
	</form><br>
	<script type="text/javascript">
		function submitform(){
			alert('Complete!');
			document._input_substance.action = 'http://127.0.0.1:3000/substances';
			document._input_substance.submit();

		}
		$("#submit_btn").click(function(){
			var id = document.getElementById("id").value;
			var substance = document.getElementById("substance").value;
			var formula = document.getElementById("formula").value;
			var email = document.getElementById("email").value;
			if(id == '' || id == null || substance == '' || substance == null || formula == '' || formula == null || email == '' || email == null){
				email = "anonymous@mail.com"
				alert('Fill the empty fields');
				return false;
			} else {
				console.log("Sending fields ...");
				console.log("Id:"+id);
				console.log(typeof(id));
				console.log("Substance:"+substance);
				console.log("Formula:"+formula);
				console.log("email:"+email);
				submitform();
			}
			
		});
	</script>
</body>
</html>