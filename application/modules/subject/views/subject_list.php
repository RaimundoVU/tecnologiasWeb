<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to module users</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1 class="font-weight-bold">Asignaturas</h1>
	<div>
		<button class="btn btn-success float-right mr-2 mb-2" data-toggle="modal" data-target="#addSubject">Agregar</button>
	</div>

<div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="addSubjectLabel">Agregar Asignatura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form>
			<div class="form-group">
				<label for="exampleInputEmail1">Codigo de la asignatura</label>
				<input type="text" class="form-control" id="codeInput" aria-describedby="emailHelp" placeholder="Ingrese un codigo">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Nombre de la asignatura</label>
				<input type="text" class="form-control" id="nameInput" placeholder="Ingrese un nombre">
			</div>
			
			<div class="form-group">
			<label for="exampleInputPassword1">Docente</label>
				<select class="custom-select" id="teacherInput">
					<option selected>Escoja un docente</option>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
				</select>
				</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


	<div id="body">
	<table class="table table-white">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Codigo </th>
	  <th scope="col">Nombre </th>
	  <th scope="col">Semestre</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
  <? ?>
  <?$i=0; foreach($subjects as $row):?>
	<tr>
	<th scope="row"><? echo $i+1?></th>
	<td><? echo $row->codigo_asignatura?></td>
	<td><? echo $row->nombre?></td>
	<td>----</td>
	<td><button class="btn btn-warning" id="seeSubject">Ver</button> <button class="btn btn-primary">Asignar Docente</button> <button class="btn btn-danger">Eliminar</button></td>
	</tr>
	<?$i++;endforeach;?>
	<tr>
      <th scope="row">1</th>
      <td>0002</td>
	  <td>Tecnologias Webs</td>
	  <td>2019-2</td>
      <td><button class="btn btn-warning" id="seeSubject">Ver</button> <button class="btn btn-primary">Asignar Docente</button> <button class="btn btn-danger">Eliminar</button></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>0004</td>
	  <td>Maquinas Abstractas</td>
	  <td>2019-2</td>
      <td><button class="btn btn-warning" id="seeSubject">Ver</button> <button class="btn btn-primary">Asignar Docente</button> <button class="btn btn-danger">Eliminar</button></td>
    </tr>
  </tbody>
</table>
	</div>

</div>

</body>
</html>