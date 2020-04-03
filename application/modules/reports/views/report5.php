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

<div style="text-align: center">
	Este informe le dará a conocer todos los docentes que hayan sido icorporados antes de la fecha ingresada
</div>

<div style="margin-top: 10px">
	<div class="d-inline-block">
		<input id="inputDate" class="form-control" type="date">
	</div>
	<div class="d-inline-block">
		<button class="btn btn-primary" onclick="searchTeachers()">Buscar</button>
	</div>
</div>


  <div id="tableBody">

  </div>

</table>
	
<script type="text/javascript">
var base_url = '<? echo base_url() ?>'
	function searchTeachers() {
		var date = $("#inputDate").val();
		console.log(date);
		$.post(
            base_url + "reports/getTeachersByDate", {
                date: date
            },
            function(data) {
				var res = '<table class="table table-white"><thead ><tr>'+
				'<th scope="col">Apellido Paterno</th>'+
				'<th scope="col">Apellido Materno</th>'+
				'<th scope="col">Nombres</th>'+
				'<th scope="col">Email</th>'+
				'<th scope="col">Fecha de Ingreso</th>'+
				'</tr></thead>';

				var json = JSON.parse(data);
				for(teacher in json) {
					res+= "<tbody><td>" + json[teacher].apellido_paterno + "</td>" +
					"<td>" + json[teacher].apellido_materno + "</td>" +
					"<td>" + json[teacher].nombres + "</td>" +
					"<td>" + json[teacher].email + "</td>"+
					"<td>" + json[teacher].fechaIngreso + "</td></tbody >";
				}
				$("#tableBody").html(res);
            });
	}
	
</script>
</body>
</html>
