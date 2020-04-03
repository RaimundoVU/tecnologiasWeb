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
	Este informe le dará a conocer todos los docentes y asignaturas con notas al dia.
</div>

<div style="margin-top: 10px">
	<div class="d-inline-block">
		<input id="inputDate" class="form-control" type="date">
	</div>
	<div class="d-inline-block">
		<button class="btn btn-primary" onclick="searchTeachersDate()">Buscar</button>
	</div>
</div>


  <div id="tableBody">

  </div>

</table>

	
<script type="text/javascript">
var base_url = '<? echo base_url() ?>'
	function searchTeachersDate() {
		var date = $("#inputDate").val();
		console.log(date);
		$.post(
            base_url + "reports/getTeachersDate", {
                date: date
            },
            function(data) {
				var res = '<table class="table table-white"><thead ><tr>'+
				'<th scope="col">ID</th>'+
				'<th scope="col">Apellidos</th>'+
				'<th scope="col">Nombres</th>'+
				'<th scope="col">Email</th>'+
				'<th scope="col">Nombre Asig.</th>'+
				'<th scope="col">Semestre</th>'+
				'</tr></thead>';

				var json = JSON.parse(data);
				for(teacher in json) {
					res+= "<tbody><td>" + json[teacher].id + "</td>" +
					"<td>" + json[teacher].apellido_paterno +" "+json[teacher].apellido_materno+ "</td>" +
					"<td>" + json[teacher].nombres + "</td>" +
					"<td>" + json[teacher].email + "</td>"+
					"<td>" + json[teacher].nombre + "</td>"+
					"<td>" + json[teacher].anho +"-" +json[teacher].semestre + "</td></tbody >";
				}
				$("#tableBody").html(res);
            });
	}
	
</script>
</body>
</html>
