<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<title></title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	#inputDate {
		width: 200px;
		margin-bottom: 15px;
	}

	</style>
</head>

<div>
	<div class="d-inline-block">
		<input id="inputNumber" class="form-control" type="number">
	</div>
	<div class="d-inline-block">
		<button class="btn btn-primary" onclick="getTable4()">Buscar</button>
	</div>
</div>
	<table class="table table-white">
  <thead >
    <tr>
      <th scope="col">Nombre del Curso</th>
      <th scope="col">Semestre</th>
      <th scope="col">Año</th>
      <th scope="col">Alumnos</th>
    </tr>
  </thead>
  <tbody id="tbody">
  </tbody>
</table>

	
<script type="text/javascript">
function getTable4() {
		let number = $("#inputNumber").val();
		$('#title-report').html("Asignaturas incritas");
		$.post(
             base_url + "reports/getSubjectsByNumber", {
				number: number,
			},
            function(data) {
				var json = JSON.parse(data);
				var res='';
				for(subject in json)
				{
					res+="<tr><td>" + json[subject].nombre+"</td>"+
					"<td>" + json[subject].semestre+"</td>"+
					"<td>" + json[subject].anho+"</td>"+
					"<td>" + json[subject].cantidad+"</td></tr>";
				}
                $("#tbody").html(res)
              
            });
	}
	
</script>
</body>
</html>
