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
		<input id="inputDate" class="form-control" type="date">
	</div>
	<div class="d-inline-block">
		<button class="btn btn-primary">Buscar</button>
	</div>
</div>

 <table class="table table-white">
  <thead >
    <tr>
      <th scope="col">Apellido Paterno</th>
      <th scope="col">Apellido Materno</th>
      <th scope="col">Nombres</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
	<td>Perez</td>
	<td>Gonzalez</td>
	<td>Juan Ignacio</td>
	<td>jp@correo.com</td>
  </tbody>
</table>
	
<script type="text/javascript">

	
</script>
</body>
</html>
